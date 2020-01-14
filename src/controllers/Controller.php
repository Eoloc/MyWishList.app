<?php


namespace wishlist\controllers;

use Slim\App;

class  Controller
{
    protected $app;

    /**
     * ItemController constructor.
     * @param $a App Objet slim injecté dans le contoleur
     */
    public function __construct($a)
    {
        $this->app = $a;
    }
}