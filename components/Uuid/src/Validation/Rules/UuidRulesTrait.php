<?php declare(strict_types=1);

namespace Orzford\Limoncello\Uuid\Validation\Rules;

use Limoncello\Validation\Contracts\Rules\RuleInterface;
use Limoncello\Validation\Rules\Generic\AndOperator;
use Orzford\Limoncello\Uuid\Validation\JsonApi\Rules\IsUuidRule;

/**
 * @package Orzford\Limoncello\Uuid\Validation\Rules
 */
trait UuidRulesTrait
{
    /**
     * @param RuleInterface|null $next
     *
     * @return RuleInterface
     */
    protected static function isUuid(RuleInterface $next = null): RuleInterface
    {
        $primary = new IsUuidRule();

        return $next === null ? $primary : new AndOperator($primary, $next);
    }
}
