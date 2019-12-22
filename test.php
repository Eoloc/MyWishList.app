<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TD 10</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
echo "<div class=\"alert alert-warning\" role=\"alert\" align=\"center\">TD 10</div>";

/**
 * File:  index.php
 * Creation Date: 04/12/2017
 * description:
 *
 * @author: canals
 */

use wishlist\models\Database;
use wishlist\models\Item;
use wishlist\models\Liste;

require_once 'vendor/autoload.php';

Database::connect();
echo "<div class=\"alert alert-primary\" role=\"alert\">Exercice 1 :  Modèles et requêtes simples</div>";

$listes = Liste::select('*')->get();
echo "
        <div>
        <table class=\"table table-bordered table-dark\">
            <thead>
            <tr>
                <th scope=\"col\">no</th>
                <th scope=\"col\">user_id</th>
                <th scope=\"col\">titre</th>
                <th scope=\"col\">description</th>
                <th scope=\"col\">expiration</th>
                <th scope=\"col\">token</th>
            </tr>
            </thead>
            <tbody> ";
foreach ($listes as $liste){
    $array = json_decode($liste);
    echo "<tr>";
    foreach ($array as $row){
        echo "<td>$row</td>";
    }
    echo "</tr>";
}
echo "</tbody>
        </table>
    </div>";

$items = Item::select('*')->get();
echo "
        <div>
        <table class=\"table table-bordered table-dark\">
            <thead>
            <tr>
                <th scope=\"col\">id</th>
                <th scope=\"col\">liste id</th>
                <th scope=\"col\">nom</th>
                <th scope=\"col\">description</th>
                <th scope=\"col\">image</th>
                <th scope=\"col\">url</th>
                <th scope=\"col\">tarif</th>
            </tr>
            </thead>
            <tbody> ";
foreach ($items as $item){
    $array = json_decode($item);
    echo "<tr>";
    $i = 0;
    foreach ($array as $row){
        if($i == 4){
            echo "<td><img src=\"src\img\\" . $row . "\" height=\"50\"/></td>";
        }
        else{
            echo "<td>$row</td>";
        }
        $i += 1;
    }
    echo "</tr>";
}
echo "</tbody>
        </table>
    </div>";

if(isset($_GET['id'])){
    $item = Item::select('*')->where('id', '=', $_GET['id'])->get();
    echo "
        <div style=\"width: 30px\">
            <table class=\"table table-bordered table-dark\">
                <thead>
                <tr>
                    <th scope=\"col\">id</th>
                    <th scope=\"col\">liste id</th>
                    <th scope=\"col\">nom</th>
                    <th scope=\"col\">description</th>
                    <th scope=\"col\">image</th>
                    <th scope=\"col\">url</th>
                    <th scope=\"col\">tarif</th>
                </tr>
                </thead>
                <tbody>";
    foreach ($item as $it){
        $array = json_decode($it);
        echo "<tr>";
        $i = 0;
        foreach ($array as $row){
            if($i == 4){
                echo "<td><img src=\"src\img\\" . $row . "\" height=\"50\"/></td>";
            }
            else{
                echo "<td>$row</td>";
            }
            $i += 1;
        }
        echo "</tr>";
    }
    echo "</tbody>
        </table>
    </div>";
}

$nvItem = new Item();
$nvItem->liste_id = 1;
$nvItem->nom = 'Test';
$nvItem->descr = 'Test';
$nvItem->img = '';
$nvItem->url = '';
$nvItem->tarif = 10.00;
//$nvItem->save();

echo "<div class=\"alert alert-primary\" role=\"alert\">Exercice 2 : Associations</div>";

$item = Item::select('*')->get();
echo "
        <div>
        <table class=\"table table-bordered table-dark\">
            <thead>
            <tr>
                <th scope=\"col\">id</th>
                <th scope=\"col\">liste id</th>
                <th scope=\"col\">nom</th>
                <th scope=\"col\">description</th>
                <th scope=\"col\">image</th>
                <th scope=\"col\">url</th>
                <th scope=\"col\">tarif</th>
                <th scope=\"col\">nom liste</th>
            </tr>
            </thead>
            <tbody> ";
$titre = "";
foreach ($items as $item){
    $array = json_decode($item);
    echo "<tr>";
    $i = 0;
    foreach ($array as $row){
        if($i == 0) {
            $it = Item::where('id', '=', $row)->first();
            $listeTab = $it->liste()->first();
            $obj = json_decode($listeTab);
            if(isset($obj)) {
                $titre = $obj->titre;
            }
        }
        if($i == 4){
            echo "<td><img src=\"src\img\\" . $row . "\" height=\"50\"/></td>";
        }
        else{
            echo "<td>$row</td>";
        }
        $i += 1;
    }
    echo "<td>$titre</td>";
    echo "</tr>";
}
echo "</tbody>
        </table>
    </div>";

if(isset($_GET['no'])){
    $liste = Liste::where('no', '=', $_GET['no'])->first();
    $items = $liste->items()->get();
    echo "
        <div>
            <table class=\"table table-bordered table-dark\">
                <thead>
                <tr>
                    <th scope=\"col\">id</th>
                    <th scope=\"col\">liste id</th>
                    <th scope=\"col\">nom</th>
                    <th scope=\"col\">description</th>
                    <th scope=\"col\">image</th>
                    <th scope=\"col\">url</th>
                    <th scope=\"col\">tarif</th>
                </tr>
                </thead>
                <tbody>";
    foreach ($items as $item){
        $array = json_decode($item);
        echo "<tr>";
        $i = 0;
        foreach ($array as $row){
            if($i == 4){
                echo "<td><img src=\"img\\" . $row . "\" height=\"50\"/></td>";
            }
            else{
                echo "<td>$row</td>";
            }
            $i += 1;
        }
        echo "</tr>";
    }
    echo "</tbody>
        </table>
    </div>";
}
?>

</body>
</html>
