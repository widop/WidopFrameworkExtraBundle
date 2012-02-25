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

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * JSON template listener.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class JsonTemplateListener
{
    /**
     * Creates a JSON Response and converts the controller result
     * to a JSON object.
     *
     * @param GetResponseForControllerResultEvent $event The event.
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $annotations = $event->getRequest()->attributes->get('widop_framework_extra');

        if (in_array('json_template', array_keys($annotations))) {
            $parameters = $event->getControllerResult();

            $response = new Response();
            $response->headers->set('Content-type', 'application/json');
            $response->setContent(json_encode($parameters));

            $event->setResponse($response);
        }
    }
}
