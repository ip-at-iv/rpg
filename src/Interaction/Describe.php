<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Interaction;

use Demyanseleznev\Rpg\Contract\Describable;
use Demyanseleznev\Rpg\InteractionInterface;
use Demyanseleznev\Rpg\UI;

final class Describe implements InteractionInterface
{
    private UI $ui;
    private Describable $describable;

    public function __construct(UI $ui, Describable $describable)
    {
        $this->ui = $ui;
        $this->describable = $describable;
    }

    public function act(): void
    {
        $this->ui->say($this->describable->describe());
    }

    public function consumesTurn(): bool
    {
        return false;
    }
}