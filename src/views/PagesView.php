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
            case 'about':
                $this->about();
                break;
            default:
                break;
        }
        $this->afficher();
    }

    private function index(){

        $this->content.= <<<END
<h1>MyWishList.App</h1>
<br/>
<p>Bienvenue sur notre site.</p>
<p>Ici, vous pourrez créer vos propres liste de souhait pour votre anniversaire ou d'autre évènement.</p>
</br>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget ante sapien.
Praesent faucibus vitae dui vel blandit. Sed quis neque elit. Pellentesque pretium vitae erat a condimentum.
Duis tortor odio, ullamcorper nec metus ac, vehicula malesuada tellus. Proin et diam a leo consequat dignissim.
Proin maximus fringilla cursus. </p>
<p>Etiam aliquam gravida felis sed ullamcorper. Cras sollicitudin posuere commodo. Aenean porta mattis nisl ut ultricies.
 Donec vestibulum, arcu sed fermentum accumsan, ipsum leo condimentum sem, scelerisque commodo lacus elit sodales felis.
  Nam tincidunt elementum nisl. Nulla facilisi.
  Aenean convallis, enim ac ultrices ultrices, ante justo dapibus enim, at suscipit ligula risus eget ipsum. S
  uspendisse finibus, augue sit amet vulputate ultricies, purus odio vehicula quam, non pretium elit purus eget est.
  Duis et erat interdum, egestas massa eu, cursus nisi. Aliquam et euismod risus.
  Vestibulum rutrum arcu massa, at dignissim mi tempus eget. Mauris congue volutpat hendrerit.
  Praesent vestibulum purus viverra ullamcorper gravida. Morbi in nisl consectetur nisi congue accumsan nec ac turpis.
   Nam eu porttitor neque. </p>
END;


          //  "<p><a href=\"/test.php\" target=\"_self\">Page de test</a></p>";
        //echo "<a href=\"/list\">tableau de toutes les listes</a>";
    }

    private function about()
    {
        $this->content.="<p>Code source <a href='https://github.com/Eoloc/MyWishList.app/'>MyWishList.app</a> 
            et toutes les autres informations</p>";
    }


}
