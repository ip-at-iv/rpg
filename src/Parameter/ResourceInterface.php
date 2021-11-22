<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

interface ResourceInterface
{
    public function maximum(): float;

    public function current(): float;

    public function isFull(): bool;

    public function isEmpty(): bool;

    /**
     * Determines the growth value of resource.
     *
     * @return float
     */
    public function scale(): float;

    public function regen(): AttributeInterface;
}