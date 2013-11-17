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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;
use Widop\FrameworkExtraBundle\EventListener\ConfigurationListener;
use Widop\FrameworkExtraBundle\EventListener\XmlHttpRequestListener;

/**
 * Xml http request listener test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlHttpRequestListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\FrameworkExtraBundle\EventListener\XmlHttpRequestListener */
    private $xmlHttpRequestListener;

    /** @var \Symfony\Component\HttpFoundation\Request */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->xmlHttpRequestListener = new XmlHttpRequestListener();
        $this->request = new Request();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
        unset($this->xmlHttpRequestListener);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testXmlHttpRequestEnabled()
    {
        $this->request->attributes->set(
            ConfigurationListener::ALIAS_NAME,
            array(XmlHttpRequest::ALIAS_NAME => new XmlHttpRequest(array()))
        );

        $this->xmlHttpRequestListener->handle($this->createFilterControllerEvent());
    }

    public function testXmlHttpRequestDisabled()
    {
        $this->xmlHttpRequestListener->handle($this->createFilterControllerEvent());
    }

    public function testSubscribedEvents()
    {
        $this->assertSame(array('kernel.controller' => 'handle'), XmlHttpRequestListener::getSubscribedEvents());
    }

    /**
     * Creates a filter controller event.
     *
     * @param mixed $controller The controller.
     *
     * @return \Symfony\Component\HttpKernel\Event\FilterControllerEvent The filter controller event.
     */
    private function createFilterControllerEvent()
    {
        return new FilterControllerEvent(
            $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', array('', '')),
            function () {},
            $this->request,
            HttpKernelInterface::MASTER_REQUEST
        );
    }
}
