<?php

namespace Services;

use Models\DAO\SearchDAO;

class SearchManager
{

    private SearchDAO $searchDAO;

    public function __construct(SearchDAO $searchDAO)
    {
        $this->searchDAO = $searchDAO;
    }

    public function search(string $query) : array
    {
        return $this->searchDAO->search($query);
    }

}