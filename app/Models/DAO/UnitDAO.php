<?php

namespace Models\DAO;

use Models\Database\BasePDODAO;
use Models\Entity\Unit;
use Models\Factory\UnitFactory;

class UnitDAO extends BasePDODAO
{


    /**
     * Récupère tous les units et renvoie un tableau
     * @return array|Unit
     */
    public function getAll(): array|Unit
    {
        $stmt = $this->execRequest('SELECT * FROM unit');
        $units = [];

        foreach ($stmt->fetchAll() as $unitData) {
            $unit = UnitFactory::createUnit([
                'id' => $unitData['id'],
                'name' => $unitData['name'],
                'cost' => $unitData['cost'],
                'url_img' => $unitData['url_img']
            ]);
            $units[] = $unit;
        }

        return $units;
    }

    /**
     * Récupère une unité par son id
     * @param string $idUnit l'id de la unit
     * @return Unit|null
     */
    public function getById(string $idUnit): Unit|null
    {
        $stmt = $this->execRequest("SELECT * FROM unit WHERE id = ?", [$idUnit]);
        $unitData = $stmt->fetch();

        if ($unitData) {
            return UnitFactory::createUnit([
                'id' => $unitData['id'],
                'name' => $unitData['name'],
                'cost' => $unitData['cost'],
                'url_img' => $unitData['url_img']
            ]);
        }

        return null;
    }

    /**
     * Ajoute une unité
     * @param Unit $unit
     * @return bool
     */
    public function add(Unit $unit): bool
    {
        //Ajout de l'unité
        $sql = "INSERT INTO unit (id, name, cost, url_img) VALUES (:id ,:name, :cost, :url_img)";
        $stmt = $this->execRequest($sql, [
            'id' => uniqid(),
            'name' => $unit->getName(),
            'cost' => $unit->getCost(),
            'url_img' => $unit->getUrl_img()
        ]);

        // Ajout des origines
        foreach($unit->getOrigin() as $origins)
        {
            if($origins !== 0)
            {
                $sql = "INSERT INTO unitorigin (id_unit, id_origin) VALUES (:id_unit, :id_origin)";
                $stmt = $this->execRequest($sql, [
                    'id_unit' => $unit->getId(),
                    'id_origin' => $origins->getId()
                ]);
            }
        }
        return $stmt->rowCount() > 0;
    }

    /**
     * Supprimer une unité
     * @param string $idUnit
     * @return bool
     */
    public function delete(string $idUnit) : bool
    {
        $sql = "DELETE FROM unit WHERE id = :id";
        $stmt = $this->execRequest($sql, [
            'id' => $idUnit
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Met à jour une unité
     * @param string $id
     * @return bool
     */
    public function update(Unit $unit): bool
    {
        if (empty($unit->getUrl_img())) {
            $sql = "UPDATE unit SET name = :name, cost = :cost, origin = :origin WHERE id = :id";
            $stmt = $this->execRequest($sql, [
                'id' => $unit->getId(),
                'name' => $unit->getName(),
                'cost' => $unit->getCost(),
            ]);
        } else {
            $sql = "UPDATE unit SET name = :name, cost = :cost, origin = :origin, url_img = :url_img WHERE id = :id";
            $stmt = $this->execRequest($sql, [
                'id' => $unit->getId(),
                'name' => $unit->getName(),
                'cost' => $unit->getCost(),
                'url_img' => $unit->getUrl_img()
            ]);
        }
        // Origines
        foreach ($unit->getOrigin() as $origins)
        {
            if($origins->getId() !== 0)
            {
                $sql = "INSERT INTO unitorigin (id_unit, id_origin) VALUES (:id, :id_origin)";
                $stmt = $this->execRequest($sql, [
                    'id_unit' => $unit->getId(),
                    'id_origin' => $origins->getId()
                ]);
            }
        }

        return $stmt->rowCount() > 0;   
    }

}