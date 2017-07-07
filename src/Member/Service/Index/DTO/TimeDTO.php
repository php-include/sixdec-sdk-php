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

use sixdec\SDK\AbstractDTO;

/**
 * @author hehui<hehui@eelly.net>
 */
class TimeDTO extends AbstractDTO
{
    /**
     * 名称.
     *
     * @var string
     */
    public $name;

    /**
     * 时间.
     *
     * @var string
     */
    public $time;
}
