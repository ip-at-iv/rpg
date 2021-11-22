<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg\Text;

use function mb_strtolower;
use function mb_strtoupper;

final class Formatter
{
    public static function lower(string $input): string
    {
        return mb_strtolower($input);
    }

    public static function upper(string $input): string
    {
        return mb_strtoupper($input);
    }
}