<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\UnitController;
use Controllers\Router\Route;
use Exception;
use Exceptions\RouteException;

class RouteEditUnit extends Route
{

    private UnitController $unitController;
    private MainController $mainController;

    public function __construct(UnitController $unitController)
    {
        parent::__construct();
        $this->unitController = $unitController;
        $this->mainController = new MainController();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function get($params = [])
    {
        try {
            $data = [
                'id' => parent::getParam($params, 'edit', false),
            ];
            if(!$data['id'])
            {
                $this->unitController->displayAddUnit('Id not found');
            }
            $this->unitController->displayEditUnit([$data['id']], '', $params['edit'] );
        } catch (RouteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @inheritDoc
     * @throws RouteException
     */
    public function post($params = [])
    {
        try {
            $data =
                [
                    'id' => parent::getParam($params, 'id', false),
                    'name' => parent::getParam($params, 'name', false),
                    'cost' => parent::getParam($params, 'cost', false),
                    'origin' => parent::getParam($params, 'origin', false),
                    'url_img' => $_FILES['url_img']['name'],
                ];
            $this->unitController->updateUnit($data);
            $this->mainController->index();
        }
        catch (Exception $e) {
            throw new RouteException($e->getMessage());
        }
    }
}