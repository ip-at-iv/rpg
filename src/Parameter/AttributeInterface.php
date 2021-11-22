<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

interface AttributeInterface
{
    public function current(): float;

    public function modify(float $value): void;
}