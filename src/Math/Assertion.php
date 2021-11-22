<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Math;

final class Assertion
{
    /**
     * @param int|float $value
     *
     * @throws AssertionException
     */
    public static function assertPositive($value): void
    {
        Assertion::assertGreater($value, 0);
    }

    /**
     * @param int|float $value
     * @param int|float $min
     * @throws AssertionException
     */
    public static function assertGreater($value, $min): void
    {
        if ($value <= $min) {
            throw new AssertionException(sprintf('%s must be greater than %s', $value, $min));
        }
    }

    /**
     * @param int|float $value
     * @param int|float $max
     *
     * @throws AssertionException
     */
    public static function assertLesser($value, $max): void
    {
        if ($value >= $max) {
            throw new AssertionException(sprintf('%s must be lesser than %s', $value, $max));
        }
    }
}