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

namespace Sixdec\SDK\Logger\Service;

/**
 * @author hehui<hehui@eelly.net>
 */
interface ApiLoggerInterface
{
    /**
     * @param string $traceId  跟踪id
     * @param array  $request  请求信息
     * @param array  $response 返回信息
     * @param array  $extras   扩展的信息
     */
    public function log(string $traceId, array $request = [], array $response = [], array $extras = []): void;
}
