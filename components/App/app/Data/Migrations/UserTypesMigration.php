<?php declare (strict_types=1);

namespace App\Data\Migrations;

use App\Data\Models\UserType as Model;
use Doctrine\DBAL\DBALException;
use Limoncello\Contracts\Data\MigrationInterface;
use Limoncello\Data\Migrations\MigrationTrait;
use Limoncello\Data\Migrations\RelationshipRestrictions;

/**
 * @package App
 */
final class UserTypesMigration implements MigrationInterface
{
    use MigrationTrait;

    /**
     * @inheritdoc
     *
     * @throws DBALException
     */
    public function migrate(): void
    {
        $this->createTable(Model::class, [
            $this->primaryInt(Model::FIELD_ID),
            $this->string(Model::FIELD_NAME),
            $this->timestamps(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rollback(): void
    {
        $this->dropTableIfExists(Model::class);
    }
}
