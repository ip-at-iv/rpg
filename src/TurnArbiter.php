<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Interaction\Manager as InteractionManager;
use Demyanseleznev\Rpg\Player\Collection as PlayerCollection;

final class TurnArbiter
{
    private int   $turns;
    private PlayerCollection $playerPool;
    private UI                 $ui;
    private InteractionManager $interactionManager;

    public function __construct(UI $ui, InteractionManager $interactionManager)
    {
        $this->interactionManager = $interactionManager;
        $this->playerPool = new PlayerCollection();
        $this->turns = 0;
        $this->ui = $ui;
    }

    public function add(PlayerInterface $player): void
    {
        $this->playerPool[] = $player;
    }

    private function prepare(): void
    {
        foreach ($this->playerPool as $player) {
            $player->setTargetList($this->playerPool);
        }
    }

    public function run(): void
    {
        $this->prepare();
        $this->ui->say('Let the game begin!');

        do {
            foreach ($this->playerPool as $index => $player) {
                $player->character()->update();
                do {
                    $interaction = $this->interactionManager->create($player);
                    $interaction->act();
                } while (!$interaction->consumesTurn());

                if ($player->character()->health() == 0) {
                    $this->ui->sayTo($player, 'You get __NOTHING__! You LOSE! GOOD DAY, SIR!');
                    unset($this->playerPool[$index]);
                }
            }
            $this->turns += 1;
        } while (count($this->playerPool) > 1);

        $this->playerPool->rewind();
        $winner = $this->playerPool->current();
        $this->ui->say(sprintf('%s wins the match!', $winner->name()));
    }

    public function turns(): int
    {
        return $this->turns;
    }
}