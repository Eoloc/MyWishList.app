<?php


namespace wishlist\controllers;
use Slim\App;
use wishlist\models\Liste;
use wishlist\views\ListView;

/**
 * Classe du Controller de liste.
 * @package wishlist\controllers
 */
class ListController
{

    public function showAll(){
        $l = Liste::select('*')->get();
        $arr = json_decode($l);
        $vue = new ListView($arr);
        $vue->views('showAll');
    }

}