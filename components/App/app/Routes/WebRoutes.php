<?php declare (strict_types=1);

namespace App\Routes;

use App\Web\Middleware\CatchAllResponseMiddleware;
use Limoncello\Application\Packages\Application\WhoopsContainerConfigurator;
use Limoncello\Contracts\Application\RoutesConfiguratorInterface;
use Limoncello\Contracts\Routing\GroupInterface;

class WebRoutes implements RoutesConfiguratorInterface
{
    const WEB_GROUP_PREFIX = '/';

    /**
     * @inheritDoc
     */
    public static function configureRoutes(GroupInterface $routes): void
    {
//        $routes
//            ->group(self::WEB_GROUP_PREFIX, function (GroupInterface $routes): void {
//                $routes->addContainerConfigurators([
//                    WhoopsContainerConfigurator::CONFIGURE_EXCEPTION_HANDLER,
//                ])->addMiddleware([
//                    CustomErrorResponsesMiddleware::CALLABLE_HANDLER,
//                ]);
//            });
    }

    /**
     * @inheritDoc
     */
    public static function getMiddleware(): array
    {
        return [
            CatchAllResponseMiddleware::class,
        ];
    }
}
