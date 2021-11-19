<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Spell;

use Demyanseleznev\Rpg\CharacterInterface;
use Exception;
use Throwable;

final class InvalidTargetException extends Exception
{
    public static function forTarget(CharacterInterface $target): InvalidTargetException
    {
        $message = sprintf('%s is not a valid target.', $target->name());
        return new InvalidTargetException($message);
    }
}