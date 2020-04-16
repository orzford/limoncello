<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface as CCI;
use Limoncello\Contracts\Provider\ProvidesRouteConfiguratorsInterface as RCI;

/**
 * @package App
 */
class AzureProvider implements CCI, RCI
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            AzureContainerConfigurator::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getRouteConfigurators(): array
    {
        return [
            AzureRoutesConfigurator::class,
        ];
    }
}
