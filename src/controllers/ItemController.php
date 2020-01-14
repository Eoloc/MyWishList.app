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

    public function modifyItem($id)
    {
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        $vue->views('modifyItem');
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
        var_dump($r);
        if (is_null($r)) {
            if (isset($_POST['pseudo'])) {
                $r = new Reserve();
                $r->reservation_id = $id;
                $r->pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_SPECIAL_CHARS);
                $r->message = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
                $r->save();
            }
        }
    }
}