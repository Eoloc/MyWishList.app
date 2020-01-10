<?php


namespace wishlist\views;

class PagesView extends View
{

    /**
     * @inheritDoc
     */
    public function views(string $view)
    {
        switch ($view){
            case 'index':
                $this->index();
                break;
            default:
                break;
        }
    }

    private function index(){
        echo "<p><a href=\"/test.php\" target=\"_self\">Page de test</a></p>";
        echo "<a href=\"/list\">tableau de toutes les listes</a>";
    }
}