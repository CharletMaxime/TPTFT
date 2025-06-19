<?php

namespace Controllers;

use Config\Config;
use League\Plates\Engine;

abstract class Controller
{

    /**
     * Variable obligatoire pour l'initialisation du template et des vues à render
     * @var Engine
     */
    protected Engine $templates;

    /**
     * Sert à récupérer l'image par l'input type='file' puis la download dans le dossier visé
     * @return void
     */
    public static function uploadImg(): void
    {
        $folder = $_SERVER['DOCUMENT_ROOT'] . Config::get('pathGrpPublicFolder') . 'img/characters/';
        $file = $folder . basename($_FILES['url_img']['name']);
        move_uploaded_file($_FILES['url_img']['tmp_name'], $file);
    }
    

}