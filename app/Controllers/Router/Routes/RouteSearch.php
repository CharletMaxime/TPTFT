<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;
use Exception;

class RouteSearch extends Route
{

    private MainController $controller;

    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function get($params = [])
    {
        try {
            $search = [
                'search' => parent::getParam($params, 'search', false)
            ];
            $this->controller->search($search['search']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'ERROR', 'message' => $e->getMessage()]);
        }


    }

    public function post($params = [])
    {
        // TODO: Implement post() method.
    }
}