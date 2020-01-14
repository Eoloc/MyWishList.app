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
        <form class=\"form-horizontal\" method=\"POST\" action='reserve/valideReserve'>
        <fieldset>
        
        <!-- Form Name -->
        <legend>Réservation</legend>
        
        <!-- Text input-->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"Pseudo\">Pseudo</label>  
          <div class=\"col-md-4\">
          <input id=\"pseudo\" name=\"pseudo\" type=\"text\" placeholder=\"\" class=\"form-control input-md\" required=\"\">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"message\">Message</label>  
          <div class=\"col-md-4\">
          <input id=\"message\" name=\"message\" type=\"text\" placeholder=\"\" class=\"form-control input-md\">
            
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"buttonreserver\"></label>
          <div class=\"col-md-8\">
            <button id=\"buttonreserver\" name=\"buttonreserver\" class=\"btn btn-success\">Réserver</button>
            <button id=\"buttonreserverannuler\" name=\"buttonreserverannuler\" class=\"btn btn-danger\">Annuler</button>
          </div>
        </div>
        
        </fieldset>
        </form>
        ";
        //INSERER DANS LA BDD
    }
}