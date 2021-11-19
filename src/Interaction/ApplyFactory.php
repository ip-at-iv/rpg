<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\InteractionFactoryInterface;
use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\PlayerInterface;
use Demyanseleznev\Rpg\SpellInterface;
use Demyanseleznev\Rpg\UI;
use Exception;

final class ApplyFactory implements InteractionFactoryInterface
{
    private UI $ui;

    public function __construct(UI $ui)
    {
        $this->ui = $ui;
    }

    public function create(PlayerInterface $actor): InteractionInterface
    {
        //region Spell selection
        $spells = $actor->character()->spells()->map(fn (SpellInterface $spell) => $spell->name());

        $choice = $this->ui->ask($actor, sprintf('Choose a spell [%s]: ', implode(', ', $spells)));
        if (!in_array($choice, $spells)) {
            throw new Exception(sprintf('Unknown spell: %s', $choice));
        }
        $spell = $actor->character()->spells()->find(fn (SpellInterface $spell) => $spell->name() == $choice);
        //endregion

        //region Target selection
        $targets = $actor->targetList()->map(fn (PlayerInterface $player) => $player->character()->name());
        $choice = $this->ui->ask($actor, sprintf('Choose a target [%s]: ', implode(', ', $targets)));
        if (!in_array($choice, $targets)) {
            throw new Exception(sprintf('Invalid target: %s', $choice));
        }
        $target = $actor->targetList()->find(fn (PlayerInterface $player) => $player->character()->name() == $choice);
        //endregion

        return new Apply($spell, $actor->character(), $target->character());
    }
}