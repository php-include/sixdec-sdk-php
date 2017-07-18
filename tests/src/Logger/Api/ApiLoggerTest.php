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

namespace Sixdec\SDK\Logger\Api;

use Sixdec\SDK\SixdecClient;
use PHPUnit\Framework\TestCase;

/**
 * @author hehui<hehui@eelly.net>
 */
class ApiLoggerTest extends TestCase
{
    private $logger;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $options = [
            'clientId'                => 'myawesomeapp',
            'clientSecret'            => 'abc123',
            'redirectUri'             => '',
            'urlAuthorize'            => 'http://api.eelly.dev',
            'urlAccessToken'          => 'http://api.eelly.dev/oauth/authorizationServer/accessToken',
            'urlResourceOwnerDetails' => 'http://api.eelly.dev',
        ];
        SixdecClient::init($options);
        $this->logger = new ApiLogger();
    }

    public function testLog(): void
    {
        $this->logger->log('400000000000000000000001', ['test' => 123, 'arr' => ['a' => 1, 'b' => 2]]);
    }
}
