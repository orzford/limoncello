<?php declare (strict_types=1);

namespace App\Routes;

use App\Web\Controllers\TestController;
use App\Web\Middleware\CatchAllResponseMiddleware;
use App\Web\Middleware\CustomErrorResponsesMiddleware;
use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;
use Limoncello\Contracts\Routing\RouteInterface;

/**
 * @package App
 */
class WebRoutes implements RoutesConfiguratorInterface
{
    /**
     * Web URI prefix
     */
    const WEB_URI_PREFIX = '/';

    /**
     * @inheritDoc
     */
    public static function configureRoutes(GroupInterface $routes): void
    {
        $routes
            // HTML pages group
            // This group uses exception handler to provide error information in HTML format with Whoops.
            ->group(self::WEB_URI_PREFIX, function (GroupInterface $routes): void {

                $routes
                    ->addContainerConfigurators([])
                    ->addMiddleware([
                        CustomErrorResponsesMiddleware::CALLABLE_HANDLER,
                    ]);

                $routes
                    ->get(
                        '/',
                        TestController::CALLABLE_SHOW_HOME,
                        [RouteInterface::PARAM_NAME => TestController::ROUTE_NAME_HOME]
                    );

            });
    }

    /**
     * This middleware will be executed on every request even when no matching route is found.
     *
     * @inheritDoc
     */
    public static function getMiddleware(): array
    {
        return [
            CatchAllResponseMiddleware::class,
        ];
    }
}
