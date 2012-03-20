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
 * XML HTTP request annotation.
 *
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @Annotation
 */
class XmlHttpRequest extends AbstractConfiguration
{
    /**
     * {@inheritdoc}
     */
    public function getAliasName()
    {
        return 'xml_http_request';
    }
}
