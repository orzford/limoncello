<?php declare (strict_types=1);

namespace Orzford\Limoncello\Route\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;

/**
 * @package App
 */
class RouteKeyIndexProvider implements ProvidesContainerConfiguratorsInterface
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            RouteKeyIndexContainerConfigurator::class,
        ];
    }
}
