<?php declare (strict_types=1);

namespace App\Api;

use App\Authorization\UserTypeRules as Rules;
use App\Data\Models\UserType as Model;
use App\Json\Schemas\UserTypeSchema as Schema;
use Limoncello\Contracts\Exceptions\AuthorizationExceptionInterface;
use Limoncello\Flute\Contracts\Models\PaginatedDataInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @package App
 */
class UserTypesApi extends BaseApi
{
    /**
     * @param ContainerInterface $container
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container, Model::class);
    }

    /**
     * @inheritdoc
     *
     * @throws AuthorizationExceptionInterface
     */
    public function create(?string $index, iterable $attributes, iterable $toMany): string
    {
        $this->authorize(Rules::ACTION_CREATE_USER_TYPE, Schema::TYPE, $index);

//        $attributes = $this->addIterable($attributes, [Model::FIELD_ID_USER => $this->getCurrentUserIdentity()]);

        $index = parent::create($index, $attributes, $toMany);

        return $index;
    }

    /**
     * @inheritdoc
     *
     * @throws AuthorizationExceptionInterface
     */
    public function update(?string $index, iterable $attributes, iterable $toMany): int
    {
        $this->authorize(Rules::ACTION_EDIT_USER_TYPE, Schema::TYPE, $index);

        $updated = parent::update($index, $attributes, $toMany);

        return $updated;
    }

    /**
     * @inheritdoc
     *
     * @throws AuthorizationExceptionInterface
     */
    public function remove(?string $index): bool
    {
        $this->authorize(Rules::ACTION_EDIT_USER_TYPE, Schema::TYPE, $index);

        $removed = parent::remove($index);

        return $removed;
    }

    /**
     * @inheritdoc
     *
     * @throws AuthorizationExceptionInterface
     */
    public function index(): PaginatedDataInterface
    {
        $this->authorize(Rules::ACTION_VIEW_USER_TYPES, Schema::TYPE);

        return parent::index();
    }

    /**
     * @inheritdoc
     *
     * @throws AuthorizationExceptionInterface
     */
    public function read($index)
    {
        $this->authorize(Rules::ACTION_VIEW_USER_TYPES, Schema::TYPE, $index);

        return parent::read($index);
    }

    /**
     * @param string|int    $index
     * @param iterable|null $relationshipFilters
     * @param iterable|null $relationshipSorts
     *
     * @return PaginatedDataInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws AuthorizationExceptionInterface
     */
    public function readUsers(
        $index,
        iterable $relationshipFilters = null,
        iterable $relationshipSorts = null
    ): PaginatedDataInterface
    {
        $this->authorize(Rules::ACTION_VIEW_USERS, Schema::TYPE, $index);

        return $this->readRelationshipInt($index, Model::REL_USERS, $relationshipFilters, $relationshipSorts);
    }
}
