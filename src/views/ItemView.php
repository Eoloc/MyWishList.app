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
            case 'noModifItem':
                $this->noModifItem();
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

        $this->content.="<p>Nom : $arr_item->nom</p>\n";
        $this->content.= "<p>Description : $arr_item->descr</p>\n";
        $this->content.= "<img src=\"\\img\\" .$arr_item->img."\" height=\"50\"/>\n";
        if($arr_item->url!=NULL){
            $this->content.="<p><a href=\"$arr_item->url\">Lien</a></p>\n";
        }
        $this->content.="<p>Tarif : $arr_item->tarif</p>\n";

        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/modif';
        $adressRes = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/reserve';
        $this->content.= "<a href=\"http://$adressModify\"><button>Créer / Modifier</button></a>";
        $this->content.= "<a href=\"http://$adressRes\"><button>Reserver</button></a>";
    }

    private function noModifItem()
    {
        $this->content.= <<<END
        <form class="form-horizontal" method='post' action='return'>
        <fieldset>
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="retourmodif"></label>
          <div class="col-md-4">
          <p>Impossible de modifier cet item, il a été reservé</p>
            <button id="retourmodif" name="retourmodif" class="btn btn-primary">Retour</button>
          </div>
        </div>
        
        </fieldset>
        </form>
        

END;
    }

    private function modifItem()
    {
        if(!isset($this->res)) {
            $arr_item = $this->res[0];
            $this->title="Modifier: $arr_item->nom";
        } else {
            $this->title="Créer un item";
        }


        $this->content.= <<<END
        <form class="form-horizontal" method='post' action='modif/valideModif' enctype="multipart/form-data">
        <fieldset>
        
        <!-- Form Name -->
        <legend>Créer / Modifier l'objet</legend>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nom">Nom : </label>  
          <input id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="">
          <div class="col-md-4">
          <span class="help-block">Mettre le même nom de l'item pour le modifier</span>  
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="liste">Liste : </label>  
          <input id="liste" name="liste" type="text" placeholder="numéro de la liste" class="form-control input-md" required="">
          <div class="col-md-4">
          <span class="help-block">0 pour aucune liste</span>  
          </div>
        </div>
        
        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description">Description : </label>
          <div class="col-md-4">                     
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="prix">Prix unitaire</label>  
          
          <input id="prix" name="prix" type="text" placeholder="" class="form-control input-md" required="">

        </div>
        
        <!-- File Button --> 
        <div class="form-group">
          <label class="col-md-4 control-label" for="boutonimage">Nouvelle image</label>
          
            <input id="boutonimage" name="boutonimage" class="input-file" type="file">

        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="buttonmodif"></label>
          <div class="col-md-8">
            <button id="buttonmodif" name="buttonmodif" class="btn btn-success">Créer / Modifier</button>
            <button id="buttonmodifannuler" name="buttonmodifannuler" class="btn btn-danger">Annuler</button>
          </div>
        </div>
        
        
        
        </fieldset>
        </form>
        

END;
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