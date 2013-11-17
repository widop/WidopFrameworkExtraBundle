<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * Bundle configuration extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class WidopFrameworkExtraExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $resources = array();

        if ($config['xml_http_request']) {
            $resources[] = 'xml_http_request';
        }

        if ($config['json_template']) {
            $resources[] = 'json_template';
        }

        if (!empty($resources)) {
            $resources[] = 'configuration';
        }

        foreach ($resources as $resource) {
            $loader->load($resource.'.xml');
        }
    }
}
