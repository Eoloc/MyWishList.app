<?php


namespace wishlist\views;

/**
 * Affichage des listes
 * @package wishlist\views
 */
class ListView extends View
{

    public function views(string $view)
    {
        switch ($view) {
            case 'showAll';
                $this->showAll();
                break;
            case 'showList';
                $this->showList();
                break;
            default:
                break;
        }
        $this->afficher();
    }

    /**
     * Affiche toutes les listes
     */
    private function showAll()
    {
        foreach ($this->res as $list) {
            $this->content.= "<p><a href='/list/$list->token'>$list->titre</a></p>\n";
        }
        $this->title='Les Listes';
    }

    /**
     * Affiche une liste en particulier en récupérant son token depuis l'URL
     */
/*    private function showList()
    {
        //liste
        $this->content.="
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>titre</th>
                <th>description</th>
            </tr>
            </thead>
            <tbody>\n ";
        $liste = $this->res[0];
        $this->content.= "            <tr>\n";
        $this->content.= "<tr>\n<td>$liste->titre</td>\n<td>$liste->description</td>\n</tr>\n";

        $this->content.= "            </tbody>
               </table>
         </div>";

        // liste d'item
        $items = $this->res[1];
        //<th>id</th>
        //                <th>liste id</th>
        $this->content.= "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>nom</th>
                <th>image</th>
                <th>tarif</th>
            </tr>
            </thead>
            <tbody> ";
        foreach ($items as $item){
            $this->content.= "<tr>";
            $this->content.= "<td><a href='/item/$item->id'>$item->nom</a></td>\n";
            $this->content.= "<td><img src=\"\\img\\" .$item->img."\" height=\"50\"/></td>\n";
            $this->content.= "<td>$item->tarif</td>\n";
            $this->content.= "</tr>";
        }
        $this->content.= "</tbody>
        </table>
    </div>";

    }*/

    private function showList()
    {
        //liste
        $liste = $this->res[0];
        $this->content.= "
            <p class='titre'>$liste->titre</p>\n
            <p>$liste->description</p>\n";




        // liste d'item
        $items = $this->res[1];
        $this->content.= "<table><thead><tr>
                <th>nom</th>
                <th>image</th>
                <th>tarif</th>
            </tr></thead><tbody> ";
        foreach ($items as $item){
            $this->content.= "<tr>";
            $this->content.= "<td><a href='/item/$item->id'>$item->nom</a></td>\n";
            $this->content.= "<td><img src=\"\\img\\" .$item->img."\" height=\"50\"/></td>\n";
            $this->content.= "<td>$item->tarif</td>\n";
            $this->content.= "</tr>";
        }
        $this->content.= "</tbody></table>";
    }
}