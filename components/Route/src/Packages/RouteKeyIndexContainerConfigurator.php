<?php declare (strict_types=1);

namespace Orzford\Limoncello\Route\Packages;

use Limoncello\Contracts\Container\ContainerInterface as LimoncelloContainerInterface;
use Limoncello\Flute\Package\FluteContainerConfigurator;
use Orzford\Limoncello\Route\Contracts\RouteKeyIndexInterface;
use Orzford\Limoncello\Route\RouteKeyIndex;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class RouteKeyIndexContainerConfigurator extends FluteContainerConfigurator
{
    /**
     * @inheritDoc
     */
    public static function configureContainer(LimoncelloContainerInterface $container): void
    {
        parent::configureContainer($container);

        $container[RouteKeyIndexInterface::class] = function (PsrContainerInterface $container): RouteKeyIndexInterface {
            return new RouteKeyIndex($container);
        };
    }
}
