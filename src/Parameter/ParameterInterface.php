<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Parameter;

/**
 * Implementors of this interface determine value that scales off of {@link AttributeInterface}.
 * For example, Power would scale from Strength.
 */
interface ParameterInterface
{
    /**
     * Basic parameter value. Current value MUST not be lower than base.
     *
     * @return float
     */
    public function base(): float;

    public function current(): float;
}