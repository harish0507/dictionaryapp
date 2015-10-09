<?php

$con = new mysqli("127.0.0.1","root","","dictionaryapp");
if($con->connect_errno) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}

?>