<?php declare (strict_types=1);

namespace Orzford\Limoncello\Route;

use Limoncello\Container\Traits\HasContainerTrait;
use Orzford\Limoncello\Route\Contracts\RouteKeyIndexInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class RouteKeyIndex implements RouteKeyIndexInterface
{
    use HasContainerTrait;

    /**
     * @inheritDoc
     */
    public function __construct(PsrContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @var
     */
    private $value;

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $value): void
    {
        $this->setValue($value);
    }
}
