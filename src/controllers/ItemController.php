<?php


namespace wishlist\controllers;


use wishlist\models\Item;
use wishlist\models\Reserve;
use wishlist\views\ItemView;

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
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        $vue->views('modifItem');
    }

    public function valideModif()
    {
        if(isset($_POST['nom'])) {
            $i = Item::where('nom', '=', $_POST['nom'])->first();
            if (is_null($i)) {
                $i = new Item();
            }
            var_dump($_POST);
            if (isset($_POST['buttonmodif'])) {
                $i->liste_id = filter_var($_POST['liste_id'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->descr = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->img = '';
                $i->url = '';
                $i->tarif = filter_var($_POST['prix'], FILTER_SANITIZE_SPECIAL_CHARS);
                $i->save();
            }
            return $i->id;
        }
        return null;
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