<?php

require_once("db.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$word = preg_replace("/[^ \w\s]+/", "", $request->word);

$sql = "INSERT INTO bookmarks(`word`) VALUES ('{$word}')";
$con->query($sql);

?>