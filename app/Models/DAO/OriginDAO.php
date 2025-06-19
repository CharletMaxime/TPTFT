<?php

namespace Models\DAO;

use Models\Database\BasePDODAO;
use Models\Entity\Origin;

class OriginDAO extends BasePDODAO
{

    /**
     * Récupère toutes les origines et les renvoies sous forme de tableau
     * @return array|Origin
     */
    public function getAll(): array|Origin
    {
        $stmt = $this->execRequest('SELECT * FROM origin');
        $origins = [];

        foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row){
            $origin = new Origin([
                "id" => $row["id"],
                'name' => $row["name"],
                'url_img' => $row["url_img"],
            ]);
            $origins[] = $origin;
        }
        return $origins;
    }

    /**
     * Récupère une origine par son ID
     * @param int $id
     * @return Origin|null
     */
    public function getById(int $id): Origin|null
    {
        $stmt = $this->execRequest("SELECT * FROM origin WHERE id = ?", [$id]);
        $origin = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($origin)
        {
            $origin = new Origin([
                "id" => $origin["id"],
                "name" => $origin["name"],
                "url_img" => $origin["url_img"],
            ]);
            return $origin;
        }
        return null;
    }

    /**
     * Retourne true si la ligne est créée (supérieur à 0 création)
     * @param Origin $origin
     * @return bool
     */
    public function create(Origin $origin): bool
    {
        $sql = 'INSERT INTO origin (name, url_img) VALUES (:name, :url_img)';
        $stmt = $this->execRequest($sql,
        [
            "name" => $origin->getName(),
            "url_img" => $origin->getUrl_Img()
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Met à jours en fonction de s'il y a une image ou non l'origine
     * @param Origin $origin
     * @return bool
     */
    public function update(Origin $origin): bool
    {
        $sql = 'UPDATE origin SET name=:name WHERE id=:id';
        if(empty($origin->getUrl_Img())) {
            $stmt = $this->execRequest($sql,
                [
                    "name" => $origin->getName(),
                ]);
        }
        else {
            $sql = 'UPDATE origin SET name = :name, url_img=:url_img WHERE id=:id';
            $stmt = $this->execRequest($sql,
            [
                'name' => $origin->getName(),
                'url_img' => $origin->getUrl_Img(),
            ]);
        }
        return $stmt->rowCount() > 0;
    }

    /**
     * Supprime une origine
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM origin WHERE id=:id';
        $stmt = $this->execRequest($sql,
        [
            "id" => $id
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Récupère toutes les origines d'une unité
     * @param string $unitId
     * @return array
     */
    public function getOriginsForUnits(string $unitId) : array
    {
        $stmt = $this->execRequest("SELECT * FROM origin o INNER JOIN unit u ON o.id = u.id");
        $origins = [];

        foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row){
            $origin = new Origin([
                "id" => $row["id"],
                "name" => $row["name"],
                "url_img" => $row["url_img"],
            ]);
            $origins[] = $origin;
        }
        return $origins;
    }
}