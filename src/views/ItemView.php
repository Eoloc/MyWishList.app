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
            case 'modifItem':
                $this->modifItem();
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
        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/modif';
        $adressRes = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/reserve';
        echo "</tbody>
        </table>
        <a href=\"http://$adressModify\"><button>Créer / Modifier</button></a>
        <a href=\"http://$adressRes\"><button>Reserver</button></a>
        </div>";
    }

    private function modifItem()
    {
        echo "
        <form class=\"form-horizontal\" method='post' action='modif/valideModif'>
        <fieldset>
        
        <!-- Form Name -->
        <legend>Créer / Modifier l'objet</legend>
        
        <!-- Text input-->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"nom\">Nom</label>  
          <div class=\"col-md-4\">
          <input id=\"nom\" name=\"nom\" type=\"text\" placeholder=\"\" class=\"form-control input-md\" required=\"\">
          </div>
        </div>
        
        <!-- Text input-->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"liste_id\">Liste</label>  
          <div class=\"col-md-4\">
          <input id=\"liste_id\" name=\"liste_id\" type=\"text\" placeholder=\"0 pour aucune liste\" class=\"form-control input-md\" required=\"\">
          </div>
        </div>
        
        <!-- Textarea -->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"description\">Description</label>
          <div class=\"col-md-4\">                     
            <textarea class=\"form-control\" id=\"description\" name=\"description\"></textarea>
          </div>
        </div>
        
        <!-- Text input-->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"prix\">Prix unitaire</label>  
          <div class=\"col-md-4\">
          <input id=\"prix\" name=\"prix\" type=\"text\" placeholder=\"\" class=\"form-control input-md\" required=\"\">
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class=\"form-group\">
          <label class=\"col-md-4 control-label\" for=\"buttonmodif\"></label>
          <div class=\"col-md-8\">
            <button id=\"buttonmodif\" name=\"buttonmodif\" class=\"btn btn-success\">Créer / Modifier</button>
            <button id=\"buttonmodifann\" name=\"buttonmodifann\" class=\"btn btn-danger\">Annuler</button>
          </div>
        </div>
        
        </fieldset>
        </form>
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