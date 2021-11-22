<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

use Demyanseleznev\Rpg\Math\Assertion;
use Demyanseleznev\Rpg\Math\AssertionException;

final class Strength implements AttributeInterface
{
    private float $value;

    /**
     * @throws AssertionException
     */
    public function __construct(float $value)
    {
        Assertion::assertPositive($value);

        $this->value = $value;
    }

    public function current(): float
    {
        return $this->value;
    }

    /**
     * @throws AssertionException
     */
    public function modify(float $value): void
    {
        $result = $this->value + $value;
        Assertion::assertPositive($result);
        $this->value = $result;
    }
}