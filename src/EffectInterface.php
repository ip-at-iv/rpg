<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

interface EffectInterface
{
    public function notify(CharacterInterface $target): void;

    public function turnsLeft(): int;

    public function name(): string;
}