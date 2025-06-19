<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;

class RouteIndex extends Route
{
    private MainController $controller;

    public function __construct(MainController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    public function get($params = [])
    {
        $this->controller->index();
    }

    public function post($params = [])
    {
        $this->controller->index();
    }
}