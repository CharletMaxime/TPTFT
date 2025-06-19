<?php

namespace Controllers;

use League\Plates\Engine;
use Models\DAO\SearchDAO;
use Models\DAO\UnitDAO;
use Override;
use Services\SearchManager;
use Services\UnitManager;

class MainController extends Controller
{
    protected Engine $templates;
    private UnitManager $unitManager;

    private SearchManager $searchManager;

    public function __construct()
    {
        $this->templates = new Engine('app/Views');
        $this->unitManager = new UnitManager(new UnitDAO());
        $this->searchManager = new SearchManager(new SearchDAO());
    }

    /**
     * Retourne la vue "home"
     * @return void
     */
    public function index(): void
    {
        // Récupération des données nécessaires
        $getAllUnit = $this->unitManager->getAllUnits();
        echo $this->templates->render('home', [
            'tftSetName' => 'Remix Rumble',
            'getAllUnits' => $getAllUnit,
        ]);
    }


    /**
     * Supprime une unité en récupérant ses données
     * @param string $idUnit
     * @return void
     */
    public function deleteUnit(string $idUnit): void
    {
        $this->unitManager->deleteUnit($idUnit);
    }

    #[Override] public static function uploadImg(): void
    {
        parent::uploadImg();
    }

    public function search(string $search): void
    {
        $res = $this->searchManager->search($search);
        echo json_encode($res);
    }
}