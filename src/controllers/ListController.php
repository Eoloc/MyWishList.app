<?php


namespace wishlist\controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
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

    public function createForm()
    {
        $vue = new ListView();
        $vue->views('create');
    }

    public function confirmCreate(Request $request)
    {
        $name = $request->getParsedBody();
        filter_var_array($name, FILTER_SANITIZE_SPECIAL_CHARS);
            if ($name['title'] != null && $name['date'] != null) {
                $r = new Liste();
                $r->titre = strip_tags($name['title']);
                $r->description = strip_tags($name['desc']);
                $r->expiration = $name['date'];
                $r->token = sha1(mt_rand(1, 90000) . 'SALT');
                $r->save();
            }
    }

}