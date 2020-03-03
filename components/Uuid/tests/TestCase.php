<?php declare(strict_types=1);

namespace Orzford\Limoncello\Test\Uuid;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Limoncello\Common\Reflection\ClassIsTrait;
use Mockery;

/**
 * @package App
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    use ClassIsTrait;

    /**
     * @inheritDoc
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    /**
     * @return Connection
     * @throws DBALException
     */
    protected function createConnection(): Connection
    {
        $connection = DriverManager::getConnection(['url' => 'sqlite:///', 'memory' => true]);
        $this->assertNotSame(false, $connection->exec('PRAGMA foreign_keys = ON;'));

        return $connection;
    }
}
