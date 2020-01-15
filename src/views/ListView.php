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
            case 'showAll':
                $this->showAll();
                break;
            case 'showList':
                $this->showList();
                break;
            case 'create':
                $this->create();
                break;
            case 'link':
                $this->showLink();
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
        $this->content.= "<table id='customers'><tbody>";
        foreach ($this->res as $list) {
            $this->content.= "<tr><td><a href='/list/$list->token'>$list->titre</a></td></tr>\n";
        }
        $this->title='Les Listes';

        $adressModify = $_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"] . '/create';
        $this->content.= "</tbody></table>";
        $this->content .= <<<END
<a      href="http://$adressModify"><button>Créer un liste</button></a>
END;
    }

    /**
     * Affiche une liste en particulier en récupérant son token depuis l'URL
     */
    private function showList()
    {
        //liste
        $liste = $this->res[0];
        $this->title="$liste->titre";

        $this->content.= "
            <p class='titre'>$liste->titre</p>\n
            <p>$liste->description</p>\n
            <p>Numéro de la liste pour les items : $liste->no</p>
            ";

        // liste d'item
        $items = $this->res[1];
        $this->content.= "<table id=\"customers\"><thead><tr>
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
        $adress = $_SERVER['HTTP_HOST'] . '/item/1/modif';
        $this->content.= "<a href=\"http://$adress\"><button>Ajouter item</button></a>";
        $this->content.= "<a href=\"http://{$_SERVER['HTTP_HOST']}{$_SERVER["REDIRECT_URL"]}/share \"><button>Partager la liste</button></a>";
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
          <input id="title" name="title" type="text" placeholder="Le nom de la liste" class="form-control input-md" required>
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
                <input type="date" name="date" required>
            </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="button1id">confirm</label>
          <div class="col-md-8">
            <button id="valide1" name="valide1" class="btn btn-success">Valider</button>
            <button id="cancel" name="cancel" class="btn btn-danger">Annuler</button>
          </div>
        </div>
        
        
        
        </fieldset>
        </form>

END;

    }

    /**
     * Affiche le lien de la liste
     */
    private function showLink()
    {
        $this->content.= $_SERVER["HTTP_REFERER"];
    }
}