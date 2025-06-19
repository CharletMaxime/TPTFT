<?php

namespace Controllers;

use Config\Config;
use League\Plates\Engine;
use Models\DAO\OriginDAO;
use Models\DAO\UnitDAO;
use Models\Entity\Unit;
use Models\Factory\UnitFactory;
use Override;
use Services\UnitManager;

class UnitController extends Controller
{

    #region Attributs

    protected Engine $templates;
    private UnitDAO $unitDAO;
    private UnitManager $unitManager;
    private Config $config;
    private OriginDAO $originDAO;

    #endregionS

    #region Constructeur

    public function __construct()
    {
        $this->templates = new Engine('app/Views');
        $this->unitDAO = new UnitDAO();
        $this->unitManager = new UnitManager($this->unitDAO);
        $this->config = new Config();
        $this->originDAO = new OriginDAO();
    }

    #endregion

    #region Méthodes d'affichages

    /**
     * Retourne la vue d'ajout d'unité
     * @param string|null $message
     * @param array $data
     * @return void
     */
    public function displayAddUnit(string|null $message = null, array $data = []): void
    {
        $action = "?action=add-unit";
        // Afficher la vue du formulaire
        echo $this->templates->render('add-unit', [
            'message' => $message,
            'action' => $action,
            'title' => 'Ajouter une unité',
            'h1' => 'Ajouter une unité',
            'imageRequired' => true,
            'config' => $this->config,
            'origins' => $this->originDAO->getAll(),
            'submitButton' => 'Ajouter l\'unité',
            'unit' => null
        ]);
    }

    /**
     * Retourne la vue d'édition d'une unité
     * @param array $data
     * @param string|null $message
     * @param string $unitId
     * @return void
     */
    public function displayEditUnit(array $data = [], string|null $message = null, string $unitId): void
    {
        $idUnit = $this->unitManager->getUnitById($unitId);
        if(!$idUnit)
        {
            $this->displayAddUnit('Id : ' . $unitId . ' of the unit not found');
        }
        else
        echo $this->templates->render('add-unit',
            [
                'message' => $message,
                'unit' => $idUnit,
                'action' => "?action=edit&edit=",
                'title' => 'Modifier une unité',
                'h1' => 'Modifiez une unité',
                'imageRequired' => false,
                'submitButton' => 'Modifier l\'unité',
                'origins' => $this->originDAO->getAll()
            ]
        );

    }

    #endregion

    #region Méthodes d'appels aux managers pour le controller

    /**
     * Ajoute une unité en gardant les infos de la vue par les "names"
     * @param array $data
     * @return void
     */
    public function addUnit(array $data = []): void
    {
        $unit = new Unit($data);
        $this->unitManager->createUnit($unit);
        $this->uploadImg();
    }

    /**
     * Met à jour les données d'une unité désignée par son ID
     * @param array $data
     * @return void
     */
    public function updateUnit(array $data = []): void
    {
        $unit = new Unit($data);
        $this->unitManager->updateUnit($unit);
        $this->uploadImg();
    }

    #endregion

    #region Méthodes héritées

    #[Override] public static function uploadImg(): void
    {
        parent::uploadImg();
    }

    #endregion

}