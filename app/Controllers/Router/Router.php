<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\OriginController;
use Controllers\Router\Routes\RouteAddOrigin;
use Controllers\Router\Routes\RouteAddUnit;
use Controllers\Router\Routes\RouteDeleteUnit;
use Controllers\Router\Routes\RouteEditOrigin;
use Controllers\Router\Routes\RouteEditUnit;
use Controllers\Router\Routes\RouteIndex;
use Controllers\Router\Routes\RouteSearch;
use Controllers\UnitController;

class Router
{

    private $routeList;
    private $controllerList;
    private $actionKey;

    /**
     * Constructeur (Initialisation)
     * @param $nameActionKey
     */
    public function __construct($nameActionKey = 'action')
    {
        $this->actionKey = $nameActionKey;
        $this->controllerList = [];
        $this->routeList = [];
        $this->createControllerList();
        $this->createRouteList();

    }

    /**
     * Liste des controllers
     * @return void
     */
    public function createControllerList()
    {
        $this->controllerList['main'] = new MainController();
        $this->controllerList['unit'] = new UnitController();
        $this->controllerList['origin'] = new OriginController();
    }

    /**
     * Liste des routes
     * @return void
     */
    public function createRouteList()
    {
        $this->routeList = [
            //Route MainController
            'index' => new RouteIndex($this->controllerList['main']),
            'search' => new RouteSearch($this->controllerList['main']),
            'delete' => new RouteDeleteUnit($this->controllerList['main']),

            //Route UnitController
            'add-unit' => new RouteAddUnit($this->controllerList['unit']),
            'edit' => new RouteEditUnit($this->controllerList['unit']),

            //Route OriginController
            'add-origin' => new RouteAddOrigin($this->controllerList['origin']),
            'edit-origin' => new RouteEditOrigin($this->controllerList['origin']),
        ];

    }

    /**
     * Détermine la méthode de la route
     * @param $get
     * @param $post
     * @return void || une redirection
     */
    public function routing($get, $post): void
    {
        // Vérifier si l'action est définie dans l'URL
        if (isset($get['action'])) {
            // Sous-condition pour GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $action = $get['action'];

                // Vérifier si l'action existe dans la liste des routes
                if (isset($this->routeList[$action])) {
                    $this->routeList[$action]->get($get);
                } else {
                    // Si l'action n'existe pas, rediriger vers l'index
                    $this->routeList['index']->get($get);
                }
            } // Sous-condition pour POST
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $get['action'];

                // Vérifier si l'action existe dans la liste des routes
                if (isset($this->routeList[$action])) {
                    $this->routeList[$action]->post($post);
                } else {
                    $this->routeList['index']->get($get);
                }
            }
        } else {
            // Si aucune action n'est définie, rediriger vers l'index
            $this->routeList['index']->get($get);
        }
    }

}