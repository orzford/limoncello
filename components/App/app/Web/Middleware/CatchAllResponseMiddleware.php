<?php declare (strict_types=1);

namespace App\Web\Middleware;

use App\Web\Controllers\ControllerTrait;
use App\Web\Views;
use Closure;
use Laminas\Diactoros\Response\HtmlResponse;
use Limoncello\Contracts\Application\MiddlewareInterface;
use Limoncello\Contracts\Exceptions\AuthorizationExceptionInterface;
use Limoncello\Contracts\Http\ThrowableResponseInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CatchAllResponseMiddleware implements MiddlewareInterface
{
    use ControllerTrait;

    /**
     * Middleware handler.
     */
    const CALLABLE_HANDLER = [self::class, self::MIDDLEWARE_METHOD_NAME];

    /**
     * @inheritDoc
     */
    public static function handle(
        ServerRequestInterface $request,
        Closure $next,
        ContainerInterface $container
    ): ResponseInterface
    {
        /** @var ResponseInterface $response */
        $response = $next($request);

        // is it an error response?
        if ($response instanceof ThrowableResponseInterface) {
            if ($response->getThrowable() instanceof AuthorizationExceptionInterface) {
                return static::createResponseFromTemplate(
                    $container,
                    Views::NOT_FORBIDDEN_PAGE,
                    403
                );
            }
        }

        // error responses might have just HTTP 4xx code as well
        switch ($response->getStatusCode()) {
            case 404:
                return static::createResponseFromTemplate(
                    $container,
                    Views::NOT_FOUND_PAGE,
                    404
                );
            default:
                return $response;
        }
    }

    private static function createResponseFromTemplate(
        ContainerInterface $container,
        int $templateId,
        int $httpCode
    ): ResponseInterface
    {
        $body = static::view($container, $templateId);

        return new HtmlResponse($body, $httpCode);
    }
}
