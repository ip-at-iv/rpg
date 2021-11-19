<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Character;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\EffectInterface;
use Demyanseleznev\Rpg\Spell\Collection as SpellCollection;

final class Mage implements CharacterInterface
{
    public function update(): void {
        // TODO: Implement update() method.
    }
    public function mana(): int {
        // TODO: Implement mana() method.
    }
    public function health(): int {
        // TODO: Implement health() method.
    }
    public function defense(): int {
        // TODO: Implement defense() method.
    }
    public function power(): int {
        // TODO: Implement power() method.
    }
    public function effect(EffectInterface $effect): void {
        // TODO: Implement effect() method.
    }
    public function takeDamage(int $damage): void {
        // TODO: Implement takeDamage() method.
    }
    public function spells(): SpellCollection {
        // TODO: Implement spells() method.
    }
    public function name(): string {
        // TODO: Implement name() method.
    }
}