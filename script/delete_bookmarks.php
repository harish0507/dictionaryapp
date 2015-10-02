<?php

require_once("remote_db.php");

$sql = "TRUNCATE TABLE bookmarks";
$result = $con->query($sql);

?>