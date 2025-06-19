<?php
require_once 'app/Helpers/Autoloader.php';

use Controllers\Router\Router;
use Helpers\Psr4AutoloaderClass;
use League\Plates\Engine;


$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('Helpers', __DIR__ . '/app/Helpers');
$loader->addNamespace('Controllers', __DIR__ . '/app/Controllers');
$loader->addNamespace('Models', __DIR__ . '/app/Models');
$loader->addNamespace('Views', __DIR__ . '/app/Views');
$loader->addNamespace('League\Plates', __DIR__ . '/Vendor/Plates/src');
$loader->addNamespace('Config', __DIR__ . '/app/Config');
$loader->addNamespace('Controllers/Router', __DIR__ . '/app/Controllers/Router');
$loader->addNamespace('Services', __DIR__ . '/app/Services');
$loader->addNamespace('Exceptions', __DIR__ . '/app/Exceptions');
$loader->addNamespace('Models', __DIR__ . '/app/Models/Entity');


$engine = new Engine(__DIR__ . '/app/Views');

$router = new Router();
$router->routing($_GET, $_POST);
var_dump($_POST);