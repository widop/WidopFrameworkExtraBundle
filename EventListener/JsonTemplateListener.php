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
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;

/**
 * JSON template listener.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonTemplateListener implements EventSubscriberInterface
{
    /**
     * Handles a JSON response according to the request attributes.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event The event.
     */
    public function handle(GetResponseForControllerResultEvent $event)
    {
        $annotations = $event->getRequest()->attributes->get(ConfigurationListener::ALIAS_NAME, array());

        if (isset($annotations[JsonTemplate::ALIAS_NAME])) {
            $event->setResponse(new JsonResponse($event->getControllerResult()));
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::VIEW => 'handle',
        );
    }
}
