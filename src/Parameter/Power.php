<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

final class Power implements ParameterInterface
{
    private AttributeInterface $primary;

    public function __construct(AttributeInterface $primary)
    {
        $this->primary = $primary;
    }

    public function base(): float
    {
        return 20.0;
    }

    public function current(): float
    {
        return $this->base() + $this->primary->current();
    }
}