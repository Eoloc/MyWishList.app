<?php


namespace wishlist\controllers;
use wishlist\models\Liste;
use wishlist\models\Item;
use wishlist\views\ListView;

/**
 * Classe du Controller de liste.
 * @package wishlist\controllers
 */
class ListController extends Controller
{

    public function showAll(){
        $l = Liste::select('*')->get();
        $arr = json_decode($l);
        $vue = new ListView($arr);
        $vue->views('showAll');
    }

    public function showList($token)
    {
        $l = Liste::select('*')->where('token', '=', "$token")->get();
        $l = json_decode($l);
        $items = Item::select('*')->where('liste_id', '=', $l[0]->no)->get();
        $items = json_decode($items);
        array_push($l, $items);
        $arr = $l;
        $vue = new ListView($arr);
        $vue->views('showList');
    }

}