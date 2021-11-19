<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

interface SpellInterface
{
    public function affect(CharacterInterface $caster, CharacterInterface $target): void;

    public function name(): string;

    public function manacost(): int;

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool;
}