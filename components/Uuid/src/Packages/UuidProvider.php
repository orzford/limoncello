<?php declare(strict_types=1);

namespace Orzford\Limoncello\Uuid\Packages;

use Limoncello\Contracts\Provider\ProvidesContainerConfiguratorsInterface;

/**
 * @package App
 */
class UuidProvider implements ProvidesContainerConfiguratorsInterface
{
    /**
     * @inheritDoc
     */
    public static function getContainerConfigurators(): array
    {
        return [
            UuidContainerConfigurator::class,
        ];
    }
}
