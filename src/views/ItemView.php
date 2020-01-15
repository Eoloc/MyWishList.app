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
        $this->afficher();
    }

    private function showItem()
    {
        $arr_item = $this->res[0];
        $this->title=$arr_item->nom;

        $this->content.="<p>$arr_item->nom</p>\n";
        $this->content.= "<p>$arr_item->descr</p>\n";
        $this->content.= "<img src=\"\\img\\" .$arr_item->img."\" height=\"50\"/>\n";
        if($arr_item->url!=NULL){
            $this->content.="<p><a href=\"$arr_item->url\">Lien</a></p>\n";
        }
        $this->content.="<p>$arr_item->tarif</p>\n";

        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/modif';
        $adressRes = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/reserve';
        $this->content.= "<a href=\"http://$adressModify\"><button>Créer / Modifier</button></a>";
        $this->content.= "<a href=\"http://$adressRes\"><button>Reserver</button></a>";
    }

    private function modifItem()
    {
        $arr_item = $this->res[0];
        $this->title="Modifier: $arr_item->nom";

        $this->content.= <<<END
        <form class="form-horizontal" method='post' action='modif/valideModif'>
        <fieldset>
        
        <!-- Form Name -->
        <legend>Créer / Modifier l'objet</legend>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nom">Nom</label>  
          <div class="col-md-4">
          <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="liste_id">Liste</label>  
          <div class="col-md-4">
          <input id="liste_id" name="liste_id" type="text" placeholder="0 pour aucune liste" class="form-control input-md" required>
          </div>
        </div>
        
        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description">Description</label>
          <div class="col-md-4">
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="prix">Prix unitaire</label>  
          <div class="col-md-4">
          <input id="prix" name="prix" type="text" placeholder="" class="form-control input-md" required>
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="buttonmodif"></label>
          <div class="col-md-8">
            <button id="buttonmodif" name="buttonmodif" class="btn btn-success">Créer / Modifier</button>
            <button id="buttonmodifann" name="buttonmodifann" class="btn btn-danger">Annuler</button>
          </div>
        </div>
        
        </fieldset>
        </form>
END;

        // A INSERER DANS LA BDD
    }

    private function reserveItem()
    {
        $arr_item = $this->res[0];
        $this->title="Réserver: $arr_item->nom";

        $this->content.= <<<END
        <form class="form-horizontal" method="POST" action='reserve/valideReserve'>
        <fieldset>
        
        <!-- Form Name -->
        <legend>Réservation</legend>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Pseudo">Pseudo</label>  
          <div class="col-md-4">
          <input id="pseudo" name="pseudo" type="text" placeholder="" class="form-control input-md" required>
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="message">Message</label>  
          <div class="col-md-4">
          <input id="message" name="message" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="buttonreserver"></label>
          <div class="col-md-8">
            <button id="buttonreserver" name="buttonreserver" class="btn btn-success">Réserver</button>
            <button id="buttonreserverannuler" name="buttonreserverannuler" class="btn btn-danger">Annuler</button>
          </div>
        </div>
        
        </fieldset>
        </form>
END;
    }
}