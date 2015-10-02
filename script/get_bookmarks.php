<?php

require_once("remote_db.php");

$sql = "SELECT * FROM bookmarks";
$result = $con->query($sql);
$json = array();
while($value = mysqli_fetch_array($result)) {
    $json[] = array("word" => $value['word'], "description" => $value['description']);
}

echo json_encode($json);

?>

