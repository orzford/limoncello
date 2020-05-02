<?php declare (strict_types=1);

namespace App\Authorization;

use App\Api\UserTypesApi as Api;
use App\Data\Models\UserType as Model;
use App\Json\Schemas\UserTypeSchema as Schema;
use Limoncello\Application\Contracts\Authorization\ResourceAuthorizationRulesInterface;
use Limoncello\Auth\Contracts\Authorization\PolicyInformation\ContextInterface;
use Limoncello\Flute\Contracts\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @package App
 */
final class UserTypeRules implements ResourceAuthorizationRulesInterface
{
    use RulesTrait;

    /**
     * Action name
     */
    const ACTION_VIEW_USER_TYPES = 'canViewUserTypes';
    /**
     * Action name
     */
    const ACTION_CREATE_USER_TYPE = 'canCreateUserType';
    /**
     * Action name
     */
    const ACTION_EDIT_USER_TYPE = 'canEditUserType';
    /**
     * Action name
     */
    const ACTION_VIEW_USERS = 'canViewUsers';

    /**
     * @inheritdoc
     */
    public static function getResourcesType(): string
    {
        return Schema::TYPE;
    }

    /**
     * @param ContextInterface $context
     *
     * @return bool
     */
    public static function canViewUserTypes(ContextInterface $context): bool
    {
        assert($context);

        return true;
    }

    /**
     * @param ContextInterface $context
     *
     * @return bool
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function canCreateUserType(ContextInterface $context): bool
    {
        $userId = self::getCurrentUserIdentity($context);

        return $userId !== null;
    }

    /**
     * @param ContextInterface $context
     *
     * @return bool
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function canEditUserType(ContextInterface $context): bool
    {
        assert(self::reqGetResourceType($context) === Schema::TYPE);

        $userId = self::getCurrentUserIdentity($context);

        return $userId !== null;
    }

    /**
     * @param ContextInterface $context
     *
     * @return bool
     */
    public static function canViewUsers(ContextInterface $context): bool
    {
        assert($context);

        return true;
    }

//    /**
//     * @param ContextInterface $context
//     *
//     * @return bool
//     *
//     * @throws ContainerExceptionInterface
//     * @throws NotFoundExceptionInterface
//     */
//    private static function canCurrentUserChangeUserType(ContextInterface $context): bool
//    {
//        $canChange = false;
//
//        if (($userId = self::getCurrentUserIdentity($context)) !== null) {
//            $userId = (int)$userId;
//
//            /** @var FactoryInterface $factory */
//            $container = self::ctxGetContainer($context);
//            $factory   = $container->get(FactoryInterface::class);
//            $usertypeId    = self::reqGetResourceIdentity($context);
//            $usertype      = $factory->createApi(UserTypesApi::class)->read($usertypeId);
//            $canChange = $usertype === null || $usertype->{UserType::FIELD_ID_USER} === $userId;
//        }
//
//        return $canChange;
//    }
}
