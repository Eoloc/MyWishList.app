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
            case 'create';
                $this->create();
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

        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/create';
        $this->content .= <<<END
<a href="http://$adressModify"><button>Créer un liste</button></a>
END;
    }

    /**
     * Affiche une liste en particulier en récupérant son token depuis l'URL
     */
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

    private function create()
    {

        $this->content.=<<<END
<form class="form-horizontal" action="/list/create/confirm" method="post">
<fieldset>

<!-- Form Name -->
<legend>Création d'une liste</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Titre</label>  
  <div class="col-md-4">
  <input id="title" name="title" type="text" placeholder="Le nom de la liste" class="form-control input-md">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="desc">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="desc" name="desc">La description de la liste</textarea>
  </div>
</div>

<!-- Date -->
<div class="form-group">
    <label class="col-md-4 control-label" for="desc">Date d'expiration</label>
    <div class="col-md-4">      
        <input type="date" name="date">
    </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id">confirm</label>
  <div class="col-md-8">
    <button id="button1id" name="button1id" class="btn btn-success">Validée</button>
    <button id="cancel" name="cancel" class="btn btn-danger">Annuler</button>
  </div>
</div>



</fieldset>
</form>


END;

    }


}