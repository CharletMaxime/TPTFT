<?php

namespace Controllers;

use Config\Config;
use League\Plates\Engine;
use Models\DAO\OriginDAO;
use Models\Entity\Origin;
use Override;

class OriginController extends Controller
{

    #region Attributs
    protected Engine $templates;
    private OriginDAO $originDAO;
    private Config $config;


    #endregion

    public function __construct()
    {
        $this->templates = new Engine('app/Views');
        $this->originDAO = new OriginDAO();
        $this->config = new Config();
    }

    /**
     * Renvoie la vue du formulaire sous ajout d'une origine
     * @param string|null $message
     * @param array $data
     * @return void
     */
    public function displayAddOrigin(string|null $message = null, array $data = []): void
    {
        $action = '?action=add-origin';

        echo $this->templates->render('add-origin',
        [
            'action' => $action,
            'message' => $message,
            'title' => 'Ajouter une origine',
            'h1' => 'Ajoutez une origine',
            'imageRequired' => true,
            'config' => $this->config,
            'submitButton' => 'Ajouter l\'origine'
        ]);
    }

    /**
     * Renvoie la vue du formulaire sous édition d'une origine
     * @param string|null $message
     * @param array $data
     * @param int $originId
     * @return void
     */
    public function displayEditOrigin(string|null $message = null, array $data = [], int $originId): void
    {
        $idOrigin = $this->originDAO->getById($originId);
        if(!$idOrigin)
        {
            $this->displayAddOrigin('Id : '. $originId . 'of  the origin not found');
        }
        else {
            $action = '?action=edit-origin';
            echo $this->templates->render('edit-origin',
                [
                    'action' => $action,
                    'message' => $message,
                    'title' => 'Modifier une origine',
                    'h1' => 'Modifier une origine',
                    'imageRequired' => false,
                    'config' => $this->config,
                    'submitButton' => 'Modifier l\'origine'
                ]);
        }
    }

    /**
     * Ajoute une origine par les informations du form
     * @param array $data
     * @return void
     */
    public function addOrigin(array $data = []) : void
    {
        $origin = new Origin($data);
        $this->originDAO->create($origin);
        $this->uploadImg();
    }

    /**
     * Renvoie l'édition d'une origine
     * @param array $data
     * @return void
     */
    public function editOrigin(array $data = []): void
    {
        $origin = new Origin($data);
        $this->originDAO->update($origin);
        $this->uploadImg();
    }

    #[Override] public static function uploadImg(): void
    {
        parent::uploadImg();
    }
}