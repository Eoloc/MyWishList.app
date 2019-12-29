<?php

namespace wishlist\models;
use Illuminate\Database\Capsule\Manager as DB;

Class Database {

    public static function connect(){
        $bddConfig = parse_ini_file('src/core/db.config.ini');

        $db = new DB();
        $db->addConnection( [
            'driver'    => $bddConfig['driver'],
            'username'  => $bddConfig['username'],
            'password'  => $bddConfig['password'],
            'host'      => $bddConfig['host'],
            'database'  => $bddConfig['database'],
            'charset'   => $bddConfig['charset'],
            'collation' => $bddConfig['collation'],
            'prefix'    => ''
        ] );
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}
