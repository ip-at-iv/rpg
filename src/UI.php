<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use function in_array;
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

    public function choice(PlayerInterface $who, string $title, array $choices): string
    {
        do {
            $this->sayTo($who, $title);
            foreach ($choices as $key => $value) {
                $this->say(sprintf("\t[%s] %s", $key, $value));
            }
            $choice = readline();

            $valid = isset($choices[$choice]) || in_array($choice, $choices);
            if (!$valid) {
                $this->sayTo($who, 'Invalid choice.');
            }
        } while (!$valid);

        return $choice;
    }
}
