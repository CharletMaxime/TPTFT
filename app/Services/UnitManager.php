<?php

namespace Services;

use Models\DAO\OriginDAO;
use Models\DAO\UnitDAO;
use Models\Entity\Unit;

class UnitManager
{

    private UnitDAO $unitDAO;
    private OriginDAO $originDAO;

    /**
     * Récupère le DAO pour s'en servir pour les données
     * @param UnitDAO $unitDAO
     */
    public function __construct(UnitDAO $unitDAO)
    {
        $this->unitDAO = $unitDAO;
        $this->originDAO = new OriginDAO();
    }

    /**
     * Créé l'unité en BD
     * @param Unit $unit
     * @return bool
     */
    public function createUnit(Unit $unit) : bool
    {
        return $this->unitDAO->add($unit);
    }

    /**
     * Appelle la méthode delete du DAO
     * @param string $idUnit
     * @return bool
     */
    public function deleteUnit(string $idUnit) : bool
    {
        return $this->unitDAO->delete($idUnit);
    }

    /**
     * Appelle la méthode update de Unit DAO
     * @param Unit $unit
     * @return bool
     */
    public function updateUnit(Unit $unit): bool
    {
        return $this->unitDAO->update($unit);
    }

    /**
     * Appelle la méthode getById de UnitDAO
     * @param Unit $unit
     * @return Unit|null
     */
    public function getUnitById(string $unit): Unit|null
    {
        return $this->unitDAO->getById($unit);
    }

    /**
     * Appelle la méthode getAll du DAO
     * @return array|Unit
     */
    public function getAllUnits(): Unit|array
    {
        return $this->unitDAO->getAll();
    }

    /**
     * Récupère les origines d'une unité
     * @param string $unitId
     * @return array
     */
    public function getOriginsForUnit(string $unitId) : array
    {
        return $this->originDAO->getOriginsForUnits($unitId);
    }
}
