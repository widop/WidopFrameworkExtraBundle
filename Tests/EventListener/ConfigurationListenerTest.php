<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\Tests\EventListener;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Widop\FrameworkExtraBundle\EventListener\ConfigurationListener;
use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;
use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;
use Widop\FrameworkExtraBundle\Tests\EventListener\Fixtures\ConfigurationFixture;

/**
 * Configuration listener test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConfigurationListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\FrameworkExtraBundle\EventListener\ConfigurationListener */
    private $configurationListener;

    /** @var \Symfony\Component\HttpFoundation\Request */
    private $request;

    /** @var \Widop\FrameworkExtraBundle\Tests\EventListener\Fixtures\ConfigurationFixture */
    private $fixture;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->configurationListener = new ConfigurationListener(new AnnotationReader());
        $this->request = new Request();
        $this->fixture = new ConfigurationFixture();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->fixture);
        unset($this->request);
        unset($this->configurationListener);
    }

    public function testJsonTemplateConfiguration()
    {
        $this->configurationListener->handle(
            $this->createFilterControllerEvent(array($this->fixture, 'jsonTemplate'))
        );

        $annotations = $this->request->attributes->get(ConfigurationListener::ALIAS_NAME, array());

        $this->assertCount(1, $annotations);
        $this->assertArrayHasKey(JsonTemplate::ALIAS_NAME, $annotations);
        $this->assertInstanceOf(
            'Widop\FrameworkExtraBundle\Configuration\JsonTemplate',
            $annotations[JsonTemplate::ALIAS_NAME]
        );
    }

    public function testXmlHttpRequestConfiguration()
    {
        $this->configurationListener->handle(
            $this->createFilterControllerEvent(array($this->fixture, 'xmlHttpRequest'))
        );

        $annotations = $this->request->attributes->get(ConfigurationListener::ALIAS_NAME, array());

        $this->assertCount(1, $annotations);
        $this->assertArrayHasKey(XmlHttpRequest::ALIAS_NAME, $annotations);
        $this->assertInstanceOf(
            'Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest',
            $annotations[XmlHttpRequest::ALIAS_NAME]
        );
    }

    public function testInvalidControllerCallable()
    {
        $this->configurationListener->handle($this->createFilterControllerEvent(function () {}));

        $this->assertEmpty($this->request->attributes->get(ConfigurationListener::ALIAS_NAME, array()));
    }

    public function testSubscribedEvents()
    {
        $this->assertSame(array('kernel.controller' => 'handle'), ConfigurationListener::getSubscribedEvents());
    }

    /**
     * Creates a filter controller event.
     *
     * @param mixed $controller The controller.
     *
     * @return \Symfony\Component\HttpKernel\Event\FilterControllerEvent The filter controller event.
     */
    private function createFilterControllerEvent($controller)
    {
        return new FilterControllerEvent(
            $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', array('', '')),
            $controller,
            $this->request,
            HttpKernelInterface::MASTER_REQUEST
        );
    }
}
