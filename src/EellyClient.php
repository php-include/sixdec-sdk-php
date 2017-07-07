<?php

declare(strict_types=1);
/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace sixdec\SDK;

use Eelly\OAuth2\Client\Provider\EellyProvider;
use GuzzleHttp\Psr7\MultipartStream;
use Psr\Http\Message\UploadedFileInterface;

class EellyClient
{
    private const URI = [
        'logger' => 'http://api.eelly.dev',
        'member' => 'http://api.eelly.dev',
        'oauth'  => 'http://api.eelly.dev',
    ];

    /**
     * @var string
     */
    public static $traceId;

    private static $services = [];

    /**
     * @var EellyProvider
     */
    private $provider;

    /**
     * @var EellyClient
     */
    private static $self;

    /**
     * @param array $options
     */
    final private function __construct(array $options)
    {
        $this->provider = new EellyProvider($options);
    }

    /**
     * @param array $options
     *
     * @return self
     */
    public static function init(array $options): self
    {
        if (null === self::$self) {
            self::$self = new self($options);
        }

        return self::$self;
    }

    /**
     * @return \Eelly\OAuth2\Client\Provider\EellyProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $traceId
     */
    public function setTraceId(string $traceId): void
    {
        self::$traceId = $traceId;
    }

    /**
     * @param mixed $grant
     *
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function getAccessToken($grant, array $options = [])
    {
        // TODO cache
        return $this->provider->getAccessToken($grant, $options);
    }

    /**
     * @param string $uri
     * @param string $method
     * @param mixed  ...$args
     *
     * @return mixed
     */
    public static function request(string $uri, string $method, ...$args)
    {
        if (null === self::$self) {
            throw new \ErrorException('uninitial eelly client');
        }
        $client = self::$self;
        $accessToken = $client->getAccessToken('client_credentials');

        list($serviceName) = explode('/', $uri);
        $uri = self::URI[$serviceName].'/'.$uri.'/'.$method;
        $stream = new MultipartStream($client->paramsToMultipart($args));
        $provider = $client->getProvider();
        $options = [
            'body' => $stream,
        ];
        if (!empty(self::$traceId)) {
            $options['headers'] = [
                'traceId' => self::$traceId,
            ];
        }
        $request = $provider->getAuthenticatedRequest(EellyProvider::METHOD_POST, $uri, $accessToken->getToken(), $options);

        $response = $provider->getResponse($request);
        $class = $response->getHeader('ReturnType');
        if (!empty($class)) {
            $returnType = $class[0];
            if (class_exists($returnType)) {
                $array = json_decode((string) $response->getBody(), true);
                $object = $returnType::hydractor($array);
            } elseif ('array' == $returnType) {
                $object = json_decode((string) $response->getBody(), true);
            } else {
                $object = (string) $response->getBody();
                settype($object, $returnType);
            }
        } else {
            $object = (string) $response->getBody();
        }

        return $object;
    }

    protected function paramsToMultipart($params, $prefix = null)
    {
        $multipart = [];
        foreach ($params as $key => $value) {
            $p = null == $prefix ? $key : $prefix.'['.$key.']';
            if ($value instanceof UploadedFileInterface) {
                $multipart[] = [
                    'name'     => $p,
                    'contents' => $value->getStream(),
                ];
            } elseif (is_array($value)) {
                $parentMultipart = $this->paramsToMultipart($value, $p);
                foreach ($parentMultipart as $part) {
                    $multipart[] = $part;
                }
            } else {
                $multipart[] = [
                    'name'     => $p,
                    'contents' => $value,
                ];
            }
        }

        return $multipart;
    }
}
