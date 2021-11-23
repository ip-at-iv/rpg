<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\InteractionFactoryInterface;
use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\PlayerInterface;
use Demyanseleznev\Rpg\UI;
use Exception;

final class InspectFactory implements InteractionFactoryInterface {
    private UI $ui;

    public function __construct(UI $ui) {
        $this->ui = $ui;
    }

    public function create(PlayerInterface $actor): InteractionInterface {
        $targets = $actor->targetList()->map(fn(PlayerInterface $player) => $player->character()->name());
        $choice = $this->ui->ask($actor, sprintf('Choose target [%s]', implode(', ', $targets)));
        if (!in_array($choice, $targets)) {
            throw new Exception(sprintf('%s is not a valid target.', $choice));
        }

        $target = $actor->targetList()->find(fn(PlayerInterface $player) => $player->character()->name() == $choice);
        return new Inspect($this->ui, $target->character());
    }
}