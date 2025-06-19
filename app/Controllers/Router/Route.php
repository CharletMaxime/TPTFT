<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe mère Route
 */
abstract class Route
{

    /**
     * Initialise les attributs
     */
    public function __construct()
    {

    }

    /**
     * Récupère les paramètres de la route si elle en a
     * @param array $array
     * @param string $paramName
     * @param bool $canBeEmpty
     * @return mixed
     * @throws Exception
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true): mixed
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName]))
                throw new Exception("Paramètre '$paramName' vide");
            return $array[$paramName];
        } else
            throw new Exception("Paramètre '$paramName' absent");
    }

    /**
     * Méthode GET de la route
     * @param $params [] paramètres de la route
     * @return void
     */
    public abstract function get($params = []);

    /**
     * Méthode POST de la route
     * @param $params [] paramètres de la route
     * @return void
     */
    public abstract function post($params = []);

}