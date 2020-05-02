<?php declare (strict_types=1);

namespace App\Json\Schemas;

use App\Data\Models\UserType as Model;

/**
 * @package App
 */
class UserTypeSchema extends BaseSchema
{
    /**
     * Type
     */
    const TYPE = 'user-types';

    /**
     * Model class name
     */
    const MODEL = Model::class;

    /**
     * Attribute name
     */
    const ATTR_NAME = Model::FIELD_NAME;

    /**
     * Relationship name
     */
    const REL_USERS = Model::REL_USERS;

    /**
     * @inheritdoc
     */
    public static function getMappings(): array
    {
        return [
            self::SCHEMA_ATTRIBUTES    => [
                self::RESOURCE_ID     => Model::FIELD_ID,
                self::ATTR_NAME       => Model::FIELD_NAME,
                self::ATTR_CREATED_AT => Model::FIELD_CREATED_AT,
                self::ATTR_UPDATED_AT => Model::FIELD_UPDATED_AT,
            ],
            self::SCHEMA_RELATIONSHIPS => [
                self::REL_USERS => Model::REL_USERS,
            ],
        ];
    }
}
