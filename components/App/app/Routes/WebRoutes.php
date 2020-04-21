<?php declare (strict_types=1);

namespace App\Routes;

use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;

/**
 * @package App
 */
class WebRoutes implements RoutesConfiguratorInterface
{
    /**
     * Web URI prefix
     */
    const WEB_GROUP_PREFIX = '/';

    /**
     * @inheritDoc
     */
    public static function configureRoutes(GroupInterface $routes): void
    {
    }

    /**
     * This middleware will be executed on every request even when no matching route is found.
     *
     * @inheritDoc
     */
    public static function getMiddleware(): array
    {
        return [];
    }
}
