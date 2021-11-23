<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\Player\Computer;
use Demyanseleznev\Rpg\PlayerInterface;
use Demyanseleznev\Rpg\Randomizer;
use Demyanseleznev\Rpg\SpellInterface;
use Demyanseleznev\Rpg\UI;

final class Manager {
    private UI    $ui;
    private array $interactions;

    public function __construct(UI $ui) {
        $this->ui = $ui;
    }

    public function setInteractions(array $interactions): void {
        $this->interactions = $interactions;
    }

    public function create(PlayerInterface $player): InteractionInterface {
        if ($player instanceof Computer) {
            $character = $player->character();
            $spells =
                    $character->spells()->filter(fn(SpellInterface $spell) => $spell->manacost() <= $character->mana());

            /** @var SpellInterface $spell */
            $spell = Randomizer::fromCollection($spells);
            do {
                /** @var PlayerInterface $target */
                $target = Randomizer::fromCollection($player->targetList());
            } while (!$spell->canCast($player->character(), $target->character()));

            $this->ui->sayTo($player, sprintf('Chooses to use %s on %s', $spell->name(), $target->name()));
            return new Apply($spell, $player->character(), $target->character());
        }

        do {
            $interaction = $this->ui->ask(
                    $player,
                    sprintf(
                            'Choose action [%s]',
                            implode(', ', array_keys($this->interactions))
                    )
            );
            if (!isset($this->interactions[$interaction])) {
                $this->ui->sayTo($player, sprintf('%s is not a valid interaction name', $interaction));
            } else {
                $factory = $this->interactions[$interaction];
            }
        } while (!isset($factory));

        $factory = $this->interactions[$interaction];
        return $factory->create($player);
    }
}