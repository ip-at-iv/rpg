<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

final class Health implements ResourceInterface
{
    private Strength $attribute;
    private float $current;

    public function __construct(Strength $attribute)
    {
        $this->attribute = $attribute;
    }

    public function maximum(): float
    {
        return $this->attribute->current() * $this->scale();
    }

    public function current(): float
    {
        if (!isset($this->current)) {
            $this->current = $this->maximum();
        }

        return $this->current;
    }

    public function isFull(): bool
    {
        return $this->current() == $this->maximum();
    }

    public function isEmpty(): bool
    {
        return $this->current() <= 0;
    }

    public function regen(): AttributeInterface
    {

    }

    public function scale(): float
    {
        return 15;
    }
}