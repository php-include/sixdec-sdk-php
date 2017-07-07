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

namespace sixdec\SDK\Member\Service;

use sixdec\SDK\Member\Service\Index\DTO\FastDFSDTO;
use sixdec\SDK\Member\Service\Index\DTO\TimeDTO;
use Psr\Http\Message\UploadedFileInterface;

interface IndexInterface
{
    /**
     * <h1>缓存注解示例.</h1>.
     *
     * <p>缓存注解缓存注解缓存注解缓存注解缓存注解
     * 缓存注解缓存注解缓存注解缓存注解.</p>
     *
     * @param string $name 名称
     * @returnExample({name: "eelly", time: "2017-06-01 10:10:10"})
     *
     * @return TimeDTO
     */
    public function cacheTime(string $name): TimeDTO;

    /**
     * 上传文件示例.
     *
     * @param string                $name
     * @param UploadedFileInterface $file
     *
     * @return FastDFSDTO
     */
    public function uploadFileToFastDFS(string $name, UploadedFileInterface $file): ?FastDFSDTO;

    /**
     * @return int
     */
    public function returnInt(): int;

    /**
     * @return string
     */
    public function returnString(): string;

    /**
     * @return array
     */
    public function returnArray(): array;

    /**
     * @return bool
     */
    public function returnBool(): bool;

    /**
     * @return float
     */
    public function returnfloat(): float;

    public function returnNull(): void;
}
