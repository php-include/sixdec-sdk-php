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

namespace sixdec\SDK\Member\Service\Index\DTO;

use GuzzleHttp\Psr7\UploadedFile;

/**
 * 封装给客户端使用的上传文件DTO.
 *
 * @author hehui<hehui@eelly.net>
 */
class UploadFileDTO extends UploadedFile
{
    public function __construct($streamOrFile)
    {
        parent::__construct($streamOrFile, 0, UPLOAD_ERR_OK);
    }
}
