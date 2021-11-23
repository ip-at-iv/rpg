<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Contract\Describable;

interface SpellInterface extends Describable
{
    public function affect(CharacterInterface $caster, CharacterInterface $target): void;

    public function name(): string;

    public function manacost(): int;

    public function canCast(CharacterInterface $caster, CharacterInterface $target): bool;
}
