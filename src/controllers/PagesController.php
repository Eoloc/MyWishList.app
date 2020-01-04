<?php


namespace wishlist\controllers;


use wishlist\views\PagesView;

class PagesController
{

    /**
     * Active la vue de l'index de la page
     */
    public function index() {
        $view = new PagesView();
        $view->views('index');
    }
}