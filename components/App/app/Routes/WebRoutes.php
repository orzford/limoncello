<?php declare (strict_types=1);

namespace App\Routes;

use App\Container\RequestStorageConfigurator;
use App\Web\Middleware\CatchAllResponseMiddleware;
use App\Web\Middleware\RememberRequestMiddleware;
use Limoncello\Application\Packages\Application\WhoopsContainerConfigurator;
use Limoncello\Application\Packages\Csrf\CsrfContainerConfigurator;
use Limoncello\Application\Packages\Csrf\CsrfMiddleware;
use Limoncello\Application\Packages\Session\SessionContainerConfigurator;
use Limoncello\Application\Packages\Session\SessionMiddleware;
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
                    ->addContainerConfigurators([
                        WhoopsContainerConfigurator::CONFIGURE_EXCEPTION_HANDLER,
                        CsrfContainerConfigurator::CONFIGURATOR,
                        SessionContainerConfigurator::CONFIGURATOR,
                        RequestStorageConfigurator::CONFIGURATOR,
                    ])
                    ->addMiddleware([
                        CatchAllResponseMiddleware::CALLABLE_HANDLER,
                        //                        CustomErrorResponsesMiddleware::CALLABLE_HANDLER,
                        SessionMiddleware::CALLABLE_HANDLER,
                        CsrfMiddleware::CALLABLE_HANDLER,
                        RememberRequestMiddleware::CALLABLE_HANDLER,
                    ]);

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
//            CatchAllResponseMiddleware::class,
        ];
    }
}
