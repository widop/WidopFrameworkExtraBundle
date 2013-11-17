<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Widop\FrameworkExtraBundle\DependencyInjection\WidopFrameworkExtraExtension;

/**
 * Wid'op framework extra extension test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractWidopFrameworkExtraExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Symfony\Component\DependencyInjection\ContainerBuilder */
    private $container;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->container->registerExtension(new WidopFrameworkExtraExtension());
        $this->container->set('annotation_reader', $this->getMock('Doctrine\Common\Annotations\AnnotationReader'));
    }

    /**
     * {@ineritdoc}
     */
    protected function tearDown()
    {
        unset($this->container);
    }

    /**
     * Loads a configuration.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container     The container builder.
     * @param string                                                  $configuration The configuration name.
     */
    abstract protected function loadConfiguration(ContainerBuilder $container, $configuration);

    public function testJsonTemplateEnabled()
    {
        $this->loadConfiguration($this->container, 'json_template');
        $this->container->compile();

        $this->assertTrue($this->container->has('widop_framework_extra.configuration.listener'));
        $this->assertTrue($this->container->has('widop_framework_extra.json_template.listener'));
    }

    public function testJsonTemplateDisabled()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertFalse($this->container->has('widop_framework_extra.configuration.listener'));
        $this->assertFalse($this->container->has('widop_framework_extra.json_template.listener'));
    }

    public function testXmlHttpRequestEnabled()
    {
        $this->loadConfiguration($this->container, 'xml_http_request');
        $this->container->compile();

        $this->assertTrue($this->container->has('widop_framework_extra.configuration.listener'));
        $this->assertTrue($this->container->has('widop_framework_extra.xml_http_request.listener'));
    }

    public function testXmlHttpRequestDisabled()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertFalse($this->container->has('widop_framework_extra.configuration.listener'));
        $this->assertFalse($this->container->has('widop_framework_extra.xml_http_request.listener'));
    }
}
