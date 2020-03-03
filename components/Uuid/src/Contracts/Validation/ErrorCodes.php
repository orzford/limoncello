<?php declare(strict_types=1);

namespace Orzford\Limoncello\Uuid\Contracts\Validation;

use Limoncello\Flute\Contracts\Validation\ErrorCodes as BaseErrorCodes;

/**
 * @package Orzford\Limoncello\Uuid\Contracts\Validation
 */
interface ErrorCodes extends BaseErrorCodes
{
    /**
     * @var int
     */
    const IS_UUID = self::FLUTE_LAST + 1;
}
