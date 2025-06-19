<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\OriginController;
use Controllers\Router\Route;
use Exception;
use Exceptions\RouteException;

class RouteAddOrigin extends Route
{

    private OriginController $originController;
    private MainController $mainController;

    public function __construct(OriginController $originController)
    {
        parent::__construct();
        $this->originController = $originController;
        $this->mainController = new MainController();
    }

    public function get($params = [])
    {
        $this->originController->displayAddOrigin('', );
    }

    /**
     * @param $params
     * @return void
     * @throws RouteException
     */
    public function post($params = [])
    {
        try {
            $data =
                [
                    'name' => parent::getParam($params, 'name', false),
                    'url_img' => $_FILES['url_img']['name']
                ];
            $this->originController->addOrigin($data);
            $this->mainController->index();
        }
        catch (RouteException $e) {
            throw new RouteException($e->getMessage());
        }
    }
}