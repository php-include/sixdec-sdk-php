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

namespace Sixdec\SDK;

/**
 * @author hehui<hehui@eelly.net>
 */
class AbstractDTO implements \JsonSerializable
{
    final public function __construct()
    {
    }

    /**
     * 数组转对象
     *
     * @param array $array
     */
    public static function hydractor(array $array)
    {
        $class = static::class;
        $object = new $class();
        foreach ($array as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * {@inheritdoc}
     *
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        return $this;
    }
}
