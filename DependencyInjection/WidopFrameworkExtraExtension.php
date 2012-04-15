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
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

/**
 * Bundle configuration extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class WidopFrameworkExtraExtension extends Extension
{
    /**
     * Loads the bundle configuration.
     *
     * @param array            $configs   The configuration.
     * @param ContainerBuilder $container The container builder.
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $annotationsToLoad = array();

        if ($config['xml_http_request']['annotations'] === true) {
            $annotationsToLoad[] = 'xml_http_request.yml';
        }

        if ($config['json_template']['annotations'] === true) {
            $annotationsToLoad[] = 'json_template.yml';
        }

        if (!empty($annotationsToLoad)) {
            $loader->load('configuration.yml');

            foreach ($annotationsToLoad as $annotationToLoad) {
                $loader->load($annotationToLoad);
            }
        }
    }
}
