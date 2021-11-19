<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

use function rand;

final class Randomizer
{
    public static function fromCollection(CollectionInterface $collection)
    {
        $random = rand(0, $collection->count() - 1);
        return $collection[$random];
    }
}