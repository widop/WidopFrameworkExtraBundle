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

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Bundle configuration builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('widop_framework_extra');

        $rootNode
            ->children()
                ->arrayNode('xml_http_request')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('annotations')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('json_template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('annotations')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
