<?php


namespace wishlist\controllers;


use wishlist\models\Item;
use wishlist\models\Reserve;
use wishlist\views\ItemView;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ItemController extends Controller
{
    public function showItem($id)
    {
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        $vue->views('showItem');
    }

    public function modifItem($id)
    {
        $r = Reserve::where('reservation_id', '=', $id)->first();
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        if (is_null($r)) {
            $vue->views('modifItem');
        }
        else {
            $vue->views('noModifItem');
        }
    }

    public function valideModif($id)
    {
        if(isset($_POST['nom'])) {
            $i = Item::where('nom', '=', $_POST['nom'])->first();
            if (is_null($i)) {
                $i = new Item();
            }
            if (isset($_POST['buttonmodif'])) {
                $i->img = '';
                if(isset($_FILES["boutonimage"]["name"])) {  // L'image ne se supprime pas en local
                    $chemin = "src/img/". basename($_FILES["boutonimage"]["name"]);
                    $nomFile = basename($_FILES["boutonimage"]["name"]);
                    move_uploaded_file( $_FILES['boutonimage']['tmp_name'], $chemin);
                    $i->img = filter_var($nomFile, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                $i->liste_id = filter_var($_POST['liste'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->descr = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->url = '';
                $i->tarif = filter_var($_POST['prix'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->save();
            }
            if($i->id != '') {
                return $i->id;
            }
        }
        return $id;
    }

    public function reserveItem($id)
    {
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        $vue->views('reserveItem');
    }

    public function valideReserve($id)
    {
        $r = Reserve::where('reservation_id', '=', $id)->first();
        if (is_null($r)) {
            if (isset($_POST['buttonreserver'])) {
                $r = new Reserve();
                $r->reservation_id = $id;
                $r->pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_SPECIAL_CHARS);
                $r->message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
                $r->save();
            }
        }
    }
}