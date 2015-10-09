<?php

require_once("db.php");

$sql = "SELECT * FROM bookmarks";
$result = $con->query($sql);
$json = array();
while($value = mysqli_fetch_array($result)) {
    $json[] = array("word" => $value['word']);
}

header('Content-Type: application/json');
echo json_encode($json);


