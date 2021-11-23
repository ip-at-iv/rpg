<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Aggregates possible collection methods.
 */
interface CollectionInterface extends Iterator, Countable, ArrayAccess {
    public function filter(callable $filter): CollectionInterface;
}