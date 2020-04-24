<?php declare (strict_types=1);

namespace App\Web\Middleware;

use App\Web\Controllers\ControllerTrait;
use App\Web\Views;
use Closure;
use Laminas\Diactoros\Response\HtmlResponse;
use Limoncello\Contracts\Application\MiddlewareInterface;
use Limoncello\Contracts\Exceptions\AuthorizationExceptionInterface;
use Limoncello\Contracts\Http\ThrowableResponseInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

/**
 * @package App
 */
class CatchAllResponseMiddleware implements MiddlewareInterface
{
    use ControllerTrait;

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
                return static::createResponseFromTemplate($container, Views::FORBIDDEN_PAGE, 403);
            }
        }

        // error responses might have just HTTP 4xx code as well
        switch ($response->getStatusCode()) {
            case 404:
                return new TextResponse('catch-all');
            default:
                return $response;
        }
    }

    /**
     * @param ContainerInterface $container
     * @param int                $templateId
     * @param int                $httpCode
     *
     * @return ResponseInterface
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
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
