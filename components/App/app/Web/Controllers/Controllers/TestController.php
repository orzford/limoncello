<?php declare (strict_types=1);

namespace App\Web\Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

/**
 * @package App
 */
class TestController
{
    /**
     * Controller handler
     */
    const CALLABLE_SHOW_HOME = [self::class, 'showHome'];
    const ROUTE_NAME_HOME = 'test::showHome';

    /**
     * @inheritdoc
     */
    public static function showHome(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        return new TextResponse(self::ROUTE_NAME_HOME);
    }
}
