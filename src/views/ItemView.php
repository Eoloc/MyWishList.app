<?php


namespace wishlist\views;


class ItemView extends View
{

    /**
     * @inheritDoc
     */
    public function views(string $view)
    {
        switch ($view){
            case 'showItem':
                $this->showItem();
                break;
            case 'modifyItem':
                $this->modifyItem();
                break;
            case 'reserveItem':
                $this->reserveItem();
                break;
            default:
                break;
        }
    }

    private function showItem()
    {
        $arr_item = $this->res[0];
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
            echo "<tr>";
            echo "<td>$arr_item->nom</td>\n";
            echo "<td>$arr_item->descr</td>\n";
            echo "<td><img src=\"\\img\\" .$arr_item->img."\" height=\"50\"/></td>\n";
            echo "<td>$arr_item->url</td>\n";
            echo "<td>$arr_item->tarif</td>\n";
            echo "</tr>";
        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/modify';
        $adressRes = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/reserve';
        echo "</tbody>
        </table>
        <a href=\"http://$adressModify\"><button>Modifier</button></a>
        <a href=\"http://$adressRes\"><button>Reserver</button></a>
        </div>";
    }

    private function modifyItem()
    {
        echo "
        <head>
            <meta charset=\"utf-8\">
            <title>formulaire modifier item</title>
            <form action=\"/item-attributs-php\" method=\"post\">
            <div>
                <label for=\"name\">Nom :</label>
                <input type=\"text\" id=\"nom\" name=\"item_nom\">
            </div>
            <div>
                <label for=\"descri\">Description :</label>
                <textarea id=\"descrip\" name=\"item_description\"></textarea>
            </div>
            <div>
                <label for=\"url\">URL :</label>
                <input type=\"text\" id=\"url\" name=\"item_url\">
            </div>
            <div>
                <label for=\"tarif\">Prix Unitaire :</label>
                <input type=\"text\" id=\"tarif\" name=\"item_tarif\">
             </div>
            <input type=\"button\" value=\"Modifier\">
            <input type=\"button\" value=\"Modifier l'image\">
            <input type=\"button\" value=\"Annuler\">
            </form>
        </head>
        <body></body>
        ";

        // A INSERER DANS LA BDD
    }

    private function reserveItem()
    {
        echo "
        <head>
            <meta charset=\"utf-8\">
            <title>formulaire reserver item</title>
            <form action=\"/item-attributs-php\" method=\"post\">
            <div>
                <label for=\"pseudo\">Pseudo :</label>
                <input type=\"text\" id=\"pseudo\" name=\"pseudo\">
            </div>
            <input type=\"button\" value=\"Reserver\">
            <input type=\"button\" value=\"Annuler\">
            </form>
        </head>
        <body></body>
        ";
        //INSERER DANS LA BDD
    }
}