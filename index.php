<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


use Demyanseleznev\Rpg\Character\Warrior;
use Demyanseleznev\Rpg\Interaction\ApplyFactory;
use Demyanseleznev\Rpg\Interaction\InspectFactory;
use Demyanseleznev\Rpg\Interaction\Manager as InteractionManager;
use Demyanseleznev\Rpg\Player\Computer;
use Demyanseleznev\Rpg\Player\Player;
use Demyanseleznev\Rpg\TurnArbiter;
use Demyanseleznev\Rpg\UI;

require __DIR__ . '/vendor/autoload.php';

$ui = new UI();
$interactionManager = new InteractionManager($ui);
$interactionManager->setInteractions([
        'use' => new ApplyFactory($ui),
        'inspect' => new InspectFactory($ui)
]);

$arbiter = new TurnArbiter($ui, $interactionManager);

$player = new Player('Player-1');
$character = new Warrior('War228', 5, 2, 6);
$player->setCharacter($character);

$cpu = new Computer(new Warrior('War322', 8, 4, 2));

$arbiter->add($player);
$arbiter->add($cpu);

$arbiter->run();