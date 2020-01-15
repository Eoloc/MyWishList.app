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

    /**
     * @var string $title le titre de la page
     */
    protected $title;

    /**
     * @var array $nav contenu de la barre de navigation
     */
    protected $nav;

    /**
     * @var string $content contenue de la page
     */
    protected $content;


    /**
     * View constructor.
     * @param null $res
     */
    public function __construct($res = null)
    {
        $this->res=$res;

        $this->nav=[
            '<li><a href="/">Accueil</a></li>',
            '<li><a href="/list">Mes listes</a></li>',
            '<li><a href="/contact">Contact</a></li>',
            '<li><a href="/about">A propos</a></li>'
        ];
    }

    /**
     * @param string $view le mode d'affichage
     *
     * Choisir le mode d'affichage des listes.
     */
    public abstract function views(string $view);

    /**
     * Afficheur de la page
     */
    public function afficher(){



        echo <<<END
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>$this->title</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav>
        <ul>
            {$this->nav[0]}
            {$this->nav[1]}
            {$this->nav[2]}
            {$this->nav[3]}
        </ul>
    </nav>
    <div id='center'>
$this->content
    </div>
    <footer>
        @2020 Mathieu Sousa Jin Conte
    </footer>
</body>
</html>
END;
    }
}