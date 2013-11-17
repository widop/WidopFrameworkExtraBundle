<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\FrameworkExtraBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;

/**
 * XML HTTP request listener.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlHttpRequestListener implements EventSubscriberInterface
{
    /**
     * Handles a kernel controller event by Checking if the request is an XML HTTP one
     * according to the request attributes.
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event The event.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If the request is not an XML HTTP one.
     */
    public function handle(FilterControllerEvent $event)
    {
        $annotations = $event->getRequest()->attributes->get(ConfigurationListener::ALIAS_NAME, array());

        if (isset($annotations[XmlHttpRequest::ALIAS_NAME]) && !$event->getRequest()->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'handle',
        );
    }
}
