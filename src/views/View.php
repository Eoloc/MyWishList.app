<?php


namespace wishlist\views;

/**
 * Classe abstraite des vues.
 * @package wishlist\views
 */
abstract class View
{
    /**
     * @var array $res resulat du controleur à afficher
     */
    protected $res;

    protected $content;

    /**
     * View constructor.
     * @param null $res
     */
    public function __construct($res = null)
    {
        $this->res=$res;
    }

    /**
     * @param string $view le mode d'affichage
     *
     * Choisir le mode d'affichage des listes.
     */
    public abstract function views(string $view);
}