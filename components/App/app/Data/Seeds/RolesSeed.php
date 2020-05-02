<?php declare (strict_types=1);

namespace App\Data\Seeds;

use App\Data\Models\Role as Model;
use Doctrine\DBAL\DBALException;
use Exception;
use Limoncello\Contracts\Data\SeedInterface;
use Limoncello\Data\Seeds\SeedTrait;

/**
 * @package App
 */
class RolesSeed implements SeedInterface
{
    use SeedTrait;

    /**
     * Role "Administrators"
     */
    const ID_ADMINISTRATORS = 'Administrators';

    /**
     * Role "Moderators"
     */
    const ID_MODERATORS = 'Moderators';

    /**
     * Role "Users"
     */
    const ROLE_USERS = 'Users';

    /**
     * @inheritdoc
     *
     * @throws DBALException
     * @throws Exception
     */
    public function run(): void
    {
        $now = $this->now();

        $this->seedRowData(Model::TABLE_NAME, [
            Model::FIELD_ID         => self::ID_ADMINISTRATORS,
            Model::FIELD_CREATED_AT => $now,
        ]);
        $this->seedRowData(Model::TABLE_NAME, [
            Model::FIELD_ID         => self::ID_MODERATORS,
            Model::FIELD_CREATED_AT => $now,
        ]);
        $this->seedRowData(Model::TABLE_NAME, [
            Model::FIELD_ID         => self::ROLE_USERS,
            Model::FIELD_CREATED_AT => $now,
        ]);
    }
}
