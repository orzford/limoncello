<?php declare (strict_types=1);

namespace App\Json\Controllers;

use App\Api\UsersApi as Api;
use App\Data\Models\User as Model;
use App\Json\Schemas\UserSchema as Schema;
use App\Validation\User\UserCreateJson as CreateJson;
use App\Validation\User\UsersReadQuery as ReadQuery;
use App\Validation\User\UserUpdateJson as UpdateJson;
use Limoncello\Flute\Validation\JsonApi\Rules\DefaultQueryValidationRules;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @package App
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class UsersController extends BaseController
{
    /**
     * @inheritdoc
     */
    const API_CLASS = Api::class;

    /**
     * @inheritdoc
     */
    const SCHEMA_CLASS = Schema::class;

    /**
     * @inheritdoc
     */
    const ON_CREATE_DATA_VALIDATION_RULES_CLASS = CreateJson::class;

    /**
     * @inheritdoc
     */
    const ON_UPDATE_DATA_VALIDATION_RULES_CLASS = UpdateJson::class;

    /**
     * @inheritdoc
     */
    const ON_INDEX_QUERY_VALIDATION_RULES_CLASS = ReadQuery::class;

    /**
     * @inheritdoc
     */
    const ON_READ_QUERY_VALIDATION_RULES_CLASS = ReadQuery::class;

    /**
     * @param array                  $routeParams
     * @param ContainerInterface     $container
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function readRole(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        return static::readRelationship(
            $routeParams[static::ROUTE_KEY_INDEX],
            Model::REL_ROLE,
            DefaultQueryValidationRules::class,
            $container,
            $request
        );
    }

    /**
     * @param array                  $routeParams
     * @param ContainerInterface     $container
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function readType(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        return static::readRelationship(
            $routeParams[static::ROUTE_KEY_INDEX],
            Model::REL_TYPE,
            DefaultQueryValidationRules::class,
            $container,
            $request
        );
    }
}
