<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\SpellInterface;

final class Apply implements InteractionInterface
{
    private CharacterInterface $caster;
    private CharacterInterface $target;
    private SpellInterface $spell;

    public function __construct(SpellInterface $spell, CharacterInterface $caster, CharacterInterface $target)
    {
        $this->spell = $spell;
        $this->caster = $caster;
        $this->target = $target;
    }

    public function act(): void
    {
        $this->spell->affect($this->caster, $this->target);
    }

    public function consumesTurn(): bool
    {
        return true;
    }
}