<?php declare (strict_types=1);

namespace Orzford\Limoncello\Route\Contracts;

/**
 * @package Orzford\Limoncello\Route\Contracts
 */
interface RouteKeyIndexInterface
{
    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     */
    public function setValue(string $value): void;
}
