<?php


namespace wishlist\controllers;


use wishlist\models\Item;
use wishlist\views\ItemView;

class ItemController
{

    /**
     * ItemController constructor.
     */
    public function __construct()
    {
    }

    public function showItem($id)
    {
        $i = Item::select('*')->where('id', '=', "$id")->get();
        $i = json_decode($i);
        $vue = new ItemView($i);
        $vue->views('showItem');
    }
}