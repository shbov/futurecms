<?php

namespace Engine\Core\Validation\Rules\Core;

use Engine\Core\Validation\Rules\AbstractRule;

/**
 * Date validation rule.
 *
 * @package Engine\Core\Validation\Rules\Core
 */
class Date extends AbstractRule
{
    const PATTERN = '/^(\d{4})-(\d{2})-(\d{2})$/';

    /**
     * Validates input.
     *
     * @param mixed $input
     *
     * @return bool
     */
    public function isValid($input = null)
    {
        if ($input === null || $input === '') {
            return false;
        }

        $input = (string) $input;

        if (!preg_match(static::PATTERN, $input, $matches)) {
            $this->violations[] = 'format';

            return false;
        }

        if (!checkdate($matches[2], $matches[3], $matches[1])) {
            $this->violations[] = 'date';

            return false;
        }

        return true;
    }
}
