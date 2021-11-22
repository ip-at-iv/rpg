<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Effect;

use Demyanseleznev\Rpg\calalble;
use Demyanseleznev\Rpg\CharacterInterface;
use Demyanseleznev\Rpg\CollectionInterface;
use Demyanseleznev\Rpg\EffectInterface;
use Exception;
use function array_filter;
use function array_map;
use function array_search;
use function count;
use function current;
use function key;
use function next;
use function reset;

/**
 * This collection binds to specific character.
 */
final class Collection implements CollectionInterface
{
    private array $effects;

    public function __construct()
    {
        $this->effects = [];
    }

    public function push(EffectInterface $effect): Collection
    {
        $this->effects[] = $effect;
        return $this;
    }

    public function remove(EffectInterface $effect): CollectionInterface
    {
        $index = array_search($effect, $this->effects, true);
        unset($this->effects[$index]);
        return $this;
    }

    public function map(callable $mapper): array
    {
        return array_map($mapper, $this->effects);
    }

    public function current(): EffectInterface
    {
        return current($this->effects);
    }

    public function next()
    {
        next($this->effects);
    }

    public function key(): ?int
    {
        return key($this->effects);
    }

    public function valid(): bool
    {
        return $this->key() !== null;
    }

    public function rewind()
    {
        reset($this->effects);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->effects[$offset]);
    }

    public function offsetGet($offset): EffectInterface
    {
        return $this->effects[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->push($value);
    }

    public function offsetUnset($offset): void
    {
        throw new Exception('Use Collection::remove() instead.');
    }

    public function count(): int
    {
        return count($this->effects);
    }

    public function filter(callable $filter): CollectionInterface
    {
        $collection = new Collection();
        $collection->effects = array_filter($this->effects, $filter);
        return $collection;
    }
}