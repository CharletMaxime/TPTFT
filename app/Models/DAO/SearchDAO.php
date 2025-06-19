<?php

namespace Models\DAO;

use Models\Database\BasePDODAO;

class SearchDAO extends BasePDODAO
{

    public function search(string $search) : array
    {
        $sql = 'SELECT * FROM unit WHERE name LIKE :name';
        $stmt = $this->execRequest($sql, ['name' => "%$search%"]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}