<?php

namespace wishlist\models;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model{
    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';
    public $timestamps = false;

    public function reserve() {
        return $this->belongsTo('wishlist\models\Reserve', 'no');
    }
}