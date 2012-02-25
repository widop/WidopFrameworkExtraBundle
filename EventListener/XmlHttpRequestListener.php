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

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * XML HTTP request listener.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class XmlHttpRequestListener
{
    /**
     * Checks if the request is an XML HTTP request.
     * If it is not, an AccessDeniedException is thrown.
     *
     * @param GetResponseForControllerResultEvent $event The event.
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $annotations = $event->getRequest()->attributes->get('widop_framework_extra');

        if (in_array('xml_http_request', array_keys($annotations))) {
            if (!$event->getRequest()->isXmlHttpRequest()) {
                throw new AccessDeniedException();
            }
        }
    }
}
