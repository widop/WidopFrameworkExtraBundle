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

use Doctrine\Common\Annotations\Annotation;

/**
 * Configuration.
 *
 * All configurations must extend this class.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractConfiguration extends Annotation
{
    /**
     * Gets the annotation alias.
     *
     * @return string
     */
    abstract public function getAliasName();
}