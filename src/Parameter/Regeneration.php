<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

final class Regeneration implements AttributeInterface
{
    private float $value;

    public function current(): float
    {

    }

    public function modify(float $value): void
    {
        // TODO: Implement modify() method.
    }
}