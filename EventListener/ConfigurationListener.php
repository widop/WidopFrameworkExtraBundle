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
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Widop\FrameworkExtraBundle\Configuration\AbstractConfiguration;

/**
 * Listens the kernel controller event in order to find configurations.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ConfigurationListener implements EventSubscriberInterface
{
    /** @const string */
    const ALIAS_NAME = 'widop_framework_extra';

    /** @var \Doctrine\Common\Annotations\Reader */
    protected $reader;

    /**
     * Creates a configuration listener.
     *
     * @param \Doctrine\Common\Annotations\Reader $reader The annotation reader.
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Handles a kernel controller event by adding a request attribute
     * that enables the appropriate configuration behaviors.
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event The event.
     */
    public function handle(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $object = new \ReflectionClass(ClassUtils::getClass($controller[0]));
        $method = $object->getMethod($controller[1]);

        $configurations = $this->reader->getMethodAnnotations($method);
        $widopConfigurations = array();

        foreach ($configurations as $configuration) {
            if ($configuration instanceof AbstractConfiguration) {
                $widopConfigurations[$configuration->getAliasName()] = $configuration;
            }
        }

        $event->getRequest()->attributes->set(self::ALIAS_NAME, $widopConfigurations);
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
