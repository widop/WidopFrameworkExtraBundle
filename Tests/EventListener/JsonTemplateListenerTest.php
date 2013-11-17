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
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;
use Widop\FrameworkExtraBundle\EventListener\ConfigurationListener;
use Widop\FrameworkExtraBundle\EventListener\JsonTemplateListener;

/**
 * Json template listener test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonTemplateListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\FrameworkExtraBundle\EventListener\JsonTemplateListener */
    private $jsonTemplateListener;

    /** @var \Symfony\Component\HttpFoundation\Request */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->jsonTemplateListener = new JsonTemplateListener();
        $this->request = new Request();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
        unset($this->jsonTemplateListener);
    }

    public function testJsonTemplateEnabled()
    {
        $this->request->attributes->set(
            ConfigurationListener::ALIAS_NAME,
            array(JsonTemplate::ALIAS_NAME => new JsonTemplate(array()))
        );

        $controllerResult = array('foo');
        $event = $this->createGetResponseForControllerResultEvent($controllerResult);

        $this->jsonTemplateListener->handle($event);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $event->getResponse());
        $this->assertSame(json_encode($controllerResult), $event->getResponse()->getContent());
    }

    public function testJsonTemplateDisabled()
    {
        $event = $this->createGetResponseForControllerResultEvent(array('foo'));
        $this->jsonTemplateListener->handle($event);

        $this->assertNull($event->getResponse());
    }

    public function testSubscribedEvents()
    {
        $this->assertSame(array('kernel.view' => 'handle'), JsonTemplateListener::getSubscribedEvents());
    }

    /**
     * Creates a get response for controller result event.
     *
     * @param array $controllerResult The controller result.
     *
     * @return \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent The get response for controller
     *                                                                                 result event.
     */
    private function createGetResponseForControllerResultEvent(array $controllerResult)
    {
        return new GetResponseForControllerResultEvent(
            $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', array('', '')),
            $this->request,
            HttpKernelInterface::MASTER_REQUEST,
            $controllerResult
        );
    }
}
