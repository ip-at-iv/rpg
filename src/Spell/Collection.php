<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CollectionInterface;
use Demyanseleznev\Rpg\SpellInterface;
use Exception;
use function array_filter;
use function array_map;
use function call_user_func;
use function current;
use function key;
use function next;
use function reset;

final class Collection implements CollectionInterface {
    private array $spells;

    public function __construct(array $spells) {
        $this->spells = $spells;
    }

    public function push(SpellInterface $spell): Collection {
        $this->spells[] = $spell;
        return $this;
    }

    public function filter(callable $filter): Collection {
        $collection = new Collection([]);
        $collection->spells = array_filter($this->spells, $filter);
        return $collection;
    }

    public function map(callable $mapper): array {
        return array_map($mapper, $this->spells);
    }

    public function find(callable $finder): ?SpellInterface {
        foreach ($this->spells as $spell) {
            if (call_user_func($finder, $spell)) {
                return $spell;
            }
        }

        return null;
    }

    public function current(): SpellInterface {
        return current($this->spells);
    }

    public function next(): void {
        next($this->spells);
    }

    public function key(): int {
        return key($this->spells);
    }

    public function valid(): bool {
        return $this->key() !== null;
    }

    public function rewind(): void {
        reset($this->spells);
    }

    public function count(): int {
        return count($this->spells);
    }

    public function offsetExists($offset): bool {
        return isset($this->spells[$offset]);
    }

    public function offsetGet($offset): SpellInterface {
        return $this->spells[$offset];
    }

    public function offsetSet($offset, $value): void {
        throw new Exception('Cannot modify collection via array syntax. Use Collection::push() to add items.');
    }

    public function offsetUnset($offset): void {
        throw new Exception('Cannot remove items from collection.');
    }
}