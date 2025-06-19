<?php

namespace Controllers\Router\Routes;

use Controllers\MainController;
use Controllers\OriginController;
use Controllers\Router\Route;
use Exceptions\RouteException;

class RouteEditOrigin extends Route
{
    private OriginController $originController;
    private MainController $mainController;

    public function __construct(OriginController $originController)
    {
        parent::__construct();
        $this->originController = $originController;
        $this->mainController = new MainController();
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function get($params = [])
    {
        try {
            $data = [
                'id' => parent::getParam($params, 'edit-origin', false),
            ];
            if(!$data['id'])
            {
                $this->originController->displayAddOrigin('Id not found');
            }
            $this->originController->displayEditOrigin('', [$data['id']], $params['edit-origin'] );
        } catch (RouteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function post($params = [])
    {
        try {
            $data =
                [
                    'id' => parent::getParam($params, 'id', false),
                    'name' => parent::getParam($params, 'name', false),
                    'url_img' => $_FILES['url_img']['name']
                ];
            $this->originController->editOrigin($data);
            $this->mainController->index();
        }
        catch (RouteException $e) {
            throw new RouteException($e->getMessage());
        }
    }
}