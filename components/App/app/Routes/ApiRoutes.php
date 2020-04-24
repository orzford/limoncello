<?php declare (strict_types=1);

namespace App\Routes;

use App\Json\Controllers\TestsController;
use App\Json\Schema\TestSchema;
use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;
use Limoncello\Flute\Http\Traits\FluteRoutesTrait;
use Limoncello\Flute\Package\FluteContainerConfigurator;

/**
 * @package App
 */
class ApiRoutes implements RoutesConfiguratorInterface
{
    use FluteRoutesTrait;

    /**
     * API URI prefix
     */
    const API_URI_PREFIX = '/api/v1';

    /**
     * @inheritDoc
     */
    public static function configureRoutes(GroupInterface $routes): void
    {
        $routes
            // JSON API group
            // This group uses custom exception handler to provide error information in JSON API format.
            ->group(self::API_URI_PREFIX, function (GroupInterface $routes): void {
                $routes->addContainerConfigurators([
                    FluteContainerConfigurator::CONFIGURE_EXCEPTION_HANDLER,
                ]);

                self::apiController($routes, TestSchema::TYPE, TestsController::class);
            });
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
