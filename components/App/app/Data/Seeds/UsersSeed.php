<?php declare (strict_types=1);

namespace App\Data\Seeds;

use App\Data\Models\User as Model;
use Doctrine\DBAL\DBALException;
use Limoncello\Contracts\Data\SeedInterface;
use Limoncello\Crypt\Contracts\HasherInterface;
use Limoncello\Data\Seeds\SeedTrait;

/**
 * @package App
 */
class UsersSeed implements SeedInterface
{
    use SeedTrait;

    /**
     * Default user "Administrator"
     */
    const DEFAULT_ID_USER = 1;
    /**
     * Default user "Administrator"
     */
    const DEFAULT_ID_ROLE_USER = RolesSeed::ID_ADMINISTRATORS;
    /**
     * Default user "Administrator"
     */
    const DEFAULT_ID_TYPE_USER = UserTypesSeed::ID_LOCAL;
    /**
     * Default user "Administrator"
     */
    const DEFAULT_FIRST_NAME_USER = 'A';
    /**
     * Default user "Administrator"
     */
    const DEFAULT_LAST_NAME_USER = 'B';
    /**
     * Default user "Administrator"
     */
    const DEFAULT_NAME_USER = 'C';
    /**
     * Default user "Administrator"
     */
    const DEFAULT_EMAIL_USER = 'D';

    /**
     *
     */
    const DEFAULT_PASSWORD = 'secret';

    /**
     * @inheritdoc
     *
     * @throws DBALException
     */
    public function run(): void
    {
        $now = $this->now();
        $hasher = $this->getContainer()->get(HasherInterface::class);

        $this->seedRowData(Model::TABLE_NAME, [
            Model::FIELD_ID            => self::DEFAULT_ID_USER,
            Model::FIELD_ID_ROLE       => self::DEFAULT_ID_ROLE_USER,
            Model::FIELD_ID_TYPE       => self::DEFAULT_ID_TYPE_USER,
            Model::FIELD_FIRST_NAME    => self::DEFAULT_FIRST_NAME_USER,
            Model::FIELD_LAST_NAME     => self::DEFAULT_LAST_NAME_USER,
            Model::FIELD_EMAIL         => self::DEFAULT_EMAIL_USER,
            Model::FIELD_PASSWORD_HASH => $hasher->hash(self::DEFAULT_PASSWORD),
            Model::FIELD_CREATED_AT    => $now,
        ]);
    }
}
