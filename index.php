<?php

require_once './src/classes/DB.php';

$db = new DB('./src/core/db.config.ini');

$db->makeConnection();
$db->makeQuery('SELECT * FROM item');
$stmt = $db->getResult();
$stmt->execute();

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
	print_r($row); echo '<br>';
}
?>