<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Demyanseleznev\Rpg;

interface InteractionFactoryInterface
{
    public function create(PlayerInterface $actor): InteractionInterface;
}