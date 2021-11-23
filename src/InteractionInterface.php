<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

interface InteractionInterface
{
    public function act(): void;

    public function consumesTurn(): bool;
}
