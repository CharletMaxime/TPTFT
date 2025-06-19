<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;
use Controllers\UnitController;
use Exception;
use Exceptions\RouteException;

class RouteAddUnit extends Route
{
    private UnitController $controller;
    private MainController $mainController;

    public function __construct(UnitController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->mainController = new MainController();
    }

    public function get($params = [])
    {
        $this->controller->displayAddUnit('');
    }

    /**
     * Récupère les données du formulaire de la page add-unit.php
     * @param array $params
     * @throws Exception
     */
    public function post($params = [])
    {
        try {
            $data =
                [
                    'name' => parent::getParam($params, 'name', false),
                    'cost' => parent::getParam($params, 'cost', false),
                    'origin' =>
                        [
                            'origin1' => intval(parent::getParam($params, 'origin1', false)),
                            'origin2' => intval(parent::getParam($params, 'origin2')),
                            'origin3' => intval(parent::getParam($params, 'origin3'))
                        ],
                    'url_img' => $_FILES['url_img']['name'],
                ];
            var_dump($_POST);

            $this->controller->addUnit($data);
            $this->mainController->index();
        } catch (Exception $e) {
            throw new RouteException($e->getMessage());
        }
    }
}