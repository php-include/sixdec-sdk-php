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

namespace Sixdec\SDK\Test;

use Sixdec\SDK\SixdecClient;
use Sixdec\SDK\Member\Service\Index\DTO\TimeDTO;
use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\TestCase;

class SixdecClientTest extends TestCase
{
    /**
     * @var string
     */
    private $testFile;

    /**
     * @var SixdecClient
     */
    private $eellyClient;

    public function setUp(): void
    {
        $this->testFile = __DIR__.'/resources/test.jpg';
        $options = [
            'clientId'                => 'myawesomeapp',
            'clientSecret'            => 'abc123',
            'redirectUri'             => '',
            'urlAuthorize'            => 'http://api.eelly.dev',
            'urlAccessToken'          => 'http://api.eelly.dev/oauth/authorizationServer/accessToken',
            'urlResourceOwnerDetails' => 'http://api.eelly.dev',
        ];
        $this->eellyClient = SixdecClient::init($options);
    }

    public function testInit(): void
    {
        $this->assertInstanceOf(SixdecClient::class, $this->eellyClient);
    }

    public function testGetAccessToken(): void
    {
        $accessToken = $this->eellyClient->getAccessToken('client_credentials');
        $this->assertInstanceOf(AccessToken::class, $accessToken);
    }

    public function testRequest(): void
    {
        $return = SixdecClient::request('member/index', 'cacheTime', 'mytest');
        $this->assertInstanceOf(TimeDTO::class, $return);
        $this->eellyClient->setTraceId('5944e409b481de6f9472b0b5');
        $return = SixdecClient::request('member/index', 'cacheTime', 'mytest');
    }
}
