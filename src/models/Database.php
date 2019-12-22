<?php

namespace wishlist\models;
use Illuminate\Database\Capsule\Manager as DB;

Class DataBase {

    public static function connect(){
        $bddConfig = parse_ini_file('src/core/db.config.ini');

        $db = new DB();
        $db->addConnection( [
            'driver'    => $bddConfig['driver'],
            'host'      => $bddConfig['host'],
            'database'  => $bddConfig['database'],
            'username'  => $bddConfig['username'],
            'password'  => $bddConfig['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ] );
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}
