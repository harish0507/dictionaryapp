<?php

require_once("db.php");

$sql = "TRUNCATE TABLE bookmarks";
$result = $con->query($sql);

?>