<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use Demyanseleznev\Rpg\Interaction\Manager as InteractionManager;
use Demyanseleznev\Rpg\Player\Collection as PlayerCollection;

final class TurnArbiter {
    private int                $turns;
    private PlayerCollection   $playerPool;
    private UI                 $ui;
    private InteractionManager $interactionManager;

    public function __construct(UI $ui, InteractionManager $interactionManager) {
        $this->interactionManager = $interactionManager;
        $this->playerPool = new PlayerCollection();
        $this->turns = 0;
        $this->ui = $ui;
    }

    public function add(PlayerInterface $player): void {
        $this->playerPool[] = $player;
    }

    private function prepare(): void {
        foreach ($this->playerPool as $player) {
            $player->setTargetList($this->playerPool);
        }
    }

    public function run(): void {
        $this->prepare();
        $this->ui->say('Let the game begin!');

        do {
            foreach ($this->playerPool as $index => $player) {
                $player->character()->update();
                do {
                    $interaction = $this->interactionManager->create($player);
                    $interaction->act();
                } while (!$interaction->consumesTurn());

                if (!$player->character()->isAlive()) {
                    $this->ui->sayTo($player, 'You get __NOTHING__! You LOSE! GOOD DAY, SIR!');
                    unset($this->playerPool[$index]);
                }
            }
            $this->turns += 1;

            foreach ($this->playerPool as $player) {
                $character = $player->character();

                $maxHealth = $character->health();
                if ($character->currentHealth < $maxHealth) {
                    $character->currentHealth += $character->healthRegen();
                }
                $character->currentHealth =
                        $character->currentHealth > $maxHealth ? $maxHealth : $character->currentHealth;
                $this->ui->sayTo(
                        $player,
                        sprintf(
                                'Regenerates %s health and now has [%s/%s] health',
                                $character->healthRegen(),
                                $character->currentHealth,
                                $maxHealth
                        )
                );

                $maxMana = $character->mana();
                if ($character->currentMana < $maxMana) {
                    $character->currentMana += $character->manaRegen();
                }

                $character->currentMana = $character->currentMana > $maxMana ? $maxMana : $character->currentMana;
                $this->ui->sayTo(
                        $player,
                        sprintf(
                                'Regenerates %s mana and now has [%s/%s] mana',
                                $character->manaRegen(),
                                $character->currentMana,
                                $maxMana
                        )
                );
            }
        } while (count($this->playerPool) > 1);

        $this->playerPool->rewind();
        $winner = $this->playerPool->current();
        $this->ui->say(sprintf('%s wins the match!', $winner->name()));
        $this->ui->say(sprintf('Total turns taken: %s', $this->turns()));
    }

    public function turns(): int {
        return $this->turns;
    }
}