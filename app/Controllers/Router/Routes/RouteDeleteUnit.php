<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\Router\Route;
use Exceptions\RouteException;

class RouteDeleteUnit extends Route
{

    private $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function get($params = [])
    {
        try {
            $data =
                [
                    'id' => parent::getParam($params, 'delete', false),
                ];
            if(!$data['id'])
            {
                echo RouteException::class->getMessage();
            }
            $this->mainController->deleteUnit($data['id']);
            $this->mainController->index();
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function post($params = [])
    {
        // TODO: Implement post() method.
    }
}