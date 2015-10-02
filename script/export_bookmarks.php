<?php

require_once("remote_db.php");

$sql = "SELECT * FROM bookmarks";
$result = $con->query($sql);
$data = "\"Sl.No\",\"Word\",\"Description\"\n";
$count = 1;
while($value = mysqli_fetch_array($result)) {
    $data .= "\"{$count}\",\"{$value['word']}\",\"{$value['description']}\"\n";
    $count++;
}

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="Bookmark.csv"');
echo $data;
exit;

?>