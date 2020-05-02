<?php declare (strict_types=1);

namespace App\Data\Models;

use Doctrine\DBAL\Types\Types;
use Limoncello\Contracts\Application\ModelInterface;
use Limoncello\Contracts\Data\RelationshipTypes;
use Limoncello\Flute\Types\DateTimeType;

/**
 * @package App
 */
class UserType implements ModelInterface, CommonFields
{
    /**
     * Table name
     */
    const TABLE_NAME = 'user_types';

    /**
     * Primary key
     */
    const FIELD_ID = 'id_user_type';

    /**
     * Field name
     */
    const FIELD_NAME = 'name';

    /**
     * Relationship name
     */
    const REL_USERS = 'users';

    /**
     * @inheritdoc
     */
    public static function getTableName(): string
    {
        return static::TABLE_NAME;
    }

    /**
     * @inheritdoc
     */
    public static function getPrimaryKeyName(): string
    {
        return static::FIELD_ID;
    }

    /**
     * @inheritdoc
     */
    public static function getAttributeTypes(): array
    {
        return [
            self::FIELD_ID         => Types::INTEGER,
            self::FIELD_NAME       => Types::STRING,
            self::FIELD_CREATED_AT => DateTimeType::NAME,
            self::FIELD_UPDATED_AT => DateTimeType::NAME,
            self::FIELD_DELETED_AT => DateTimeType::NAME,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getRawAttributes(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getAttributeLengths(): array
    {
        return [
            self::FIELD_NAME => 10,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getRelationships(): array
    {
        return [
            RelationshipTypes::HAS_MANY => [
                self::REL_USERS => [User::class, User::FIELD_ID_TYPE, User::REL_TYPE],
            ],
        ];
    }
}
