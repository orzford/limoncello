<?php declare (strict_types=1);

namespace Orzford\Limoncello\Azure\Packages;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @package App
 */
class AzureController
{
    /**
     * @var callable
     */
    const TOKEN_HANDLER = [self::class, 'token'];

    /**
     * @param array                  $routeParams
     * @param ContainerInterface     $container
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public static function token(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        assert($routeParams !== null && $request !== null);

        /** @var PassportServerInterface $passportServer */
        $passportServer = $container->get(PassportServerInterface::class);
        $tokenResponse = $passportServer->postCreateToken($request);

        return $tokenResponse;
    }
}
