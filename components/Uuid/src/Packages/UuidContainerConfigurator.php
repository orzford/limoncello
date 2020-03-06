<?php declare(strict_types=1);

namespace Orzford\Limoncello\Uuid\Packages;

use Doctrine\DBAL\Types\Type;
use Limoncello\Contracts\Container\ContainerInterface as LimoncelloContainerInterface;
use Limoncello\Flute\Package\FluteContainerConfigurator;
use Orzford\Limoncello\Uuid\Types\UuidType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\Validator\GenericValidator as UuidValidator;
use Ramsey\Uuid\Validator\ValidatorInterface as UuidValidatorInterface;

/**
 * @package App
 */
class UuidContainerConfigurator extends FluteContainerConfigurator
{
    /**
     * @inheritDoc
     */
    public static function configureContainer(LimoncelloContainerInterface $container): void
    {
        parent::configureContainer($container);

        $container[UuidFactoryInterface::class] = function (): UuidFactoryInterface {
            return Uuid::getFactory();
        };

        $container[UuidValidatorInterface::class] = function (): UuidValidatorInterface {
            return new UuidValidator();
        };

        Type::hasType(UuidType::NAME) === true ?: Type::addType(UuidType::NAME, UuidType::class);
    }
}
