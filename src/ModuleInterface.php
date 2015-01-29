<?php

namespace Interop\Framework;

use Interop\Container\ContainerInterface;

/**
 * Use this interface as a base building-block to build framework-agnostic modules.
 */
interface ModuleInterface
{
    /**
     * Returns the name of the module.
     *
     * @return string
     */
    function getName();

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @param ContainerInterface $rootContainer
     * @return ContainerInterface|null
     */
    function getContainer(ContainerInterface $rootContainer);

    /**
     * You can provide init scripts here.
     */
    function init();
}
