<?php


namespace wishlist\views;


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
    }

    /**
     * Affiche toutes les listes
     */
    private function showAll()
    {
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>titre</th>
                <th>description</th>
            </tr>
            </thead>
            <tbody>\n ";
        foreach ($this->res as $liste) {
            echo "<tr>\n<td><a href='/liste/$liste->token'>$liste->titre</a></td>\n<td>$liste->description</td>\n</tr>\n";
        }
        echo "            </tbody>
               </table>
         </div>";
    }

    /**
     * Affiche une liste en particulier en récupérant son token depuis l'URL
     */
    private function showList()
    {
        //liste
        echo "
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
        echo "            <tr>\n";
        echo "<tr>\n<td>$liste->titre</td>\n<td>$liste->description</td>\n</tr>\n";

        echo "            </tbody>
               </table>
         </div>";

        // liste d'item
        $items = $this->res[1];
        //<th>id</th>
        //                <th>liste id</th>
        echo "
        <div>
        <table border=\"2\">
            <thead>
            <tr>
                <th>nom</th>
                <th>description</th>
                <th>image</th>
                <th>url</th>
                <th>tarif</th>
            </tr>
            </thead>
            <tbody> ";
        foreach ($items as $item){
            //echo "<pre>var_dump($item)</pre>";
            echo "<tr>";
            echo "<td><a href='/item/$item->id'>$item->nom</a></td>\n";
            echo "<td>$item->descr</td>\n";
            echo "<td><img src=\"\\img\\" .$item->img."\" height=\"50\"/></td>\n";
            echo "<td>$item->url</td>\n";
            echo "<td>$item->tarif</td>\n";
            echo "</tr>";
        }
        echo "</tbody>
        </table>
    </div>";

    }

}