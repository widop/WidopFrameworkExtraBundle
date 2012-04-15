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

use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Widop\FrameworkExtraBundle\Configuration\AbstractConfiguration;

/**
 * Listens the kernel controller event in order to find configurations.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConfigurationListener
{
    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    protected $reader;

    /**
     * Constructor.
     *
     * @param Reader $reader A Reader instance
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Adds an attribute to the request that enables the enabled configuration behaviors.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        $object = new \ReflectionObject($controller[0]);
        $method = $object->getMethod($controller[1]);

        $configurations = $this->reader->getMethodAnnotations($method);
        $widopConfigurations = array();

        foreach ($configurations as $configuration) {
            if ($configuration instanceof AbstractConfiguration) {
                $widopConfigurations[$configuration->getAliasName()] = $configuration;
            }
        }

        $event->getRequest()->attributes->set('widop_framework_extra', $widopConfigurations);
    }
}
