<?php

require_once("remote_db.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$word = preg_replace("/[^ \w]+/", "", $request->word);
$description = preg_replace("/[^ \w]+/", "", $request->description);

$sql = "INSERT INTO bookmarks(`word`, `description`) VALUES ('{$word}','{$description}')";
$con->query($sql);

?>