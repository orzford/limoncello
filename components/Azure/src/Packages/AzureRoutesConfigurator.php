<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;

/**
 * @package App
 */
class AzureRoutesConfigurator implements RoutesConfiguratorInterface
{
    /**
     * Route group prefix
     */
    const GROUP_PREFIX = '/azure';

    /**
     * Azure tok .
     */
    const TOKEN_URI = 'token';

    /**
     * @inheritDoc
     */
    public static function configureRoutes(GroupInterface $routes): void
    {
        $routes->group(static::GROUP_PREFIX, function (GroupInterface $routes): void {
            $routes->post(static::TOKEN_URI, AzureController::TOKEN_HANDLER);
        });
    }

    /**
     * @inheritDoc
     */
    public static function getMiddleware(): array
    {
        return [];
    }

}
