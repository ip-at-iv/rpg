<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use function readline;

final class UI
{
    public function ask(PlayerInterface $who, string $what): string
    {
        $this->sayTo($who, $what);
        return readline();
    }

    public function say(string $what): void
    {
        echo $what . PHP_EOL;
    }

    public function sayTo(PlayerInterface $who, string $what): void
    {
        echo sprintf('[%s] %s', $who->name(), $what) . PHP_EOL;
    }
}