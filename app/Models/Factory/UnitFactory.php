<?php

namespace Models\Factory;

use Models\DAO\OriginDAO;
use Models\Entity\Unit;

class UnitFactory
{


    /**
     * Crée une unité avec ses origines
     * @param array $data
     * @return Unit
     */
    public static function createUnit(array $data = []) : Unit
    {
        $unit = new Unit([$data]);
        $originDAO = new OriginDAO();
        var_dump($unit);
        $originDAO->getOriginsForUnits($unit->getId());
        return $unit;
    }

}