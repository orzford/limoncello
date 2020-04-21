<?php declare (strict_types=1);

namespace App\Routes;

use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;

/**
 * @package App
 */
class ApiRoutes implements RoutesConfiguratorInterface
{
    /**
     * API URI prefix
     */
    const API_URI_PREFIX = '/api/v1';

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
