<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Player;

use Demyanseleznev\Rpg\CollectionInterface;
use Demyanseleznev\Rpg\PlayerInterface;
use InvalidArgumentException;
use function array_map;
use function count;
use function current;
use function key;
use function next;
use function reset;

final class Collection implements CollectionInterface {
    private array $players;

    public function __construct() {
        $this->players = [];
    }

    public function filter(callable $filter): CollectionInterface {
        $collection = new Collection();
        $collection->players = array_filter($this->players, $filter);
        return $collection;
    }

    public function map(callable $mapper): array {
        return array_map($mapper, $this->players);
    }

    public function find(callable $finder): ?PlayerInterface {
        foreach ($this->players as $player) {
            if (call_user_func($finder, $player)) {
                return $player;
            }
        }

        return null;
    }

    public function current(): PlayerInterface {
        return current($this->players);
    }

    public function next(): void {
        next($this->players);
    }

    public function key(): ?int {
        return key($this->players);
    }

    public function valid(): bool {
        return $this->key() !== null;
    }

    public function rewind(): void {
        reset($this->players);
    }

    public function offsetExists($offset): bool {
        return isset($this->players[$offset]);
    }

    public function offsetGet($offset): ?PlayerInterface {
        return $this->players[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void {
        if (!($value instanceof PlayerInterface)) {
            throw new InvalidArgumentException('Can add only instance of PlayerInterface to Collection.');
        }

        if ($offset === null) {
            $this->players[] = $value;
        } else {
            $this->players[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void {
        unset($this->players[$offset]);
    }

    public function count(): int {
        return count($this->players);
    }
}