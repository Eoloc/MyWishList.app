<?php


namespace wishlist\controllers;


use wishlist\views\PagesView;

class PagesController extends Controller
{

    /**
     * Affiche la vue de l'index de la page
     */
    public function index() {
        $view = new PagesView();
        $view->views('index');
    }

    /**
     * Affiche la vue de la page a propos
     */
    public function about()
    {
        $view = new PagesView();
        $view->views('about');
    }
}