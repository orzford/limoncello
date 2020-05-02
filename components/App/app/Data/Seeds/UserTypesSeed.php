<?php declare (strict_types=1);

namespace App\Data\Seeds;

use App\Data\Models\UserType as Model;
use Doctrine\DBAL\DBALException;
use Exception;
use Limoncello\Contracts\Data\SeedInterface;
use Limoncello\Data\Seeds\SeedTrait;

/**
 * @package App
 */
class UserTypesSeed implements SeedInterface
{
    use SeedTrait;

    /**
     * User type "Local"
     */
    const ID_LOCAL = 1;
    /**
     * User type "Local"
     */
    const NAME_LOCAL = 'Local';

    /**
     * User type "Remote"
     */
    const ID_REMOTE = 2;
    /**
     * User type "Remote"
     */
    const NAME_REMOTE = 'Remote';

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
            Model::FIELD_ID         => self::ID_LOCAL,
            Model::FIELD_NAME       => self::NAME_LOCAL,
            Model::FIELD_CREATED_AT => $now,
        ]);
        $this->seedRowData(Model::TABLE_NAME, [
            Model::FIELD_ID         => self::ID_REMOTE,
            Model::FIELD_NAME       => self::NAME_REMOTE,
            Model::FIELD_CREATED_AT => $now,
        ]);
    }
}
