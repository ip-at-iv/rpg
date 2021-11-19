<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\TargetInterface;
use Demyanseleznev\Rpg\UI;

final class Inspect implements InteractionInterface
{
    private CharacterInterface $target;
    private UI                $ui;

    public function __construct(UI $ui, CharacterInterface $target)
    {
        $this->ui = $ui;
        $this->target = $target;
    }

    public function act(): void
    {
        $stats = array(
                sprintf('Name: %s', $this->target->name()),
                sprintf('Health: %s', $this->target->health()),
                sprintf('Defense: %s', $this->target->defense()),
                sprintf('Mana: %s', $this->target->mana()),
                sprintf('Power: %s', $this->target->power()),
        );

        foreach ($stats as $stat) {
            $this->ui->say($stat);
        }
    }

    public function consumesTurn(): bool
    {
        return false;
    }
}