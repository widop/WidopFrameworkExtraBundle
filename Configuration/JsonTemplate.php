<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\Configuration;

/**
 * JSON template annotation.
 *
 * @Annotation
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonTemplate extends AbstractConfiguration
{
    /** @const string */
    const ALIAS_NAME = 'json_template';

    /**
     * {@inheritdoc}
     */
    public function getAliasName()
    {
        return self::ALIAS_NAME;
    }
}
