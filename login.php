<?php
if (!$_POST["login"]) {
    http_response_code(403);
    die('Forbidden');
}
include 'db.php';;
$login = $_POST["login"];
$result = $conn->query("SELECT * FROM `users` WHERE `user_name` = '" . $login . "'");
if($result->num_rows > 0){
    die(json_encode($result->fetch_object()));
}else {
    $conn->query("INSERT INTO `users` (`user_name`) VALUES ('$login')");
    $result = $conn->query("SELECT * FROM `users` WHERE `user_name` = '" . $login . "'");
    die(json_encode($result->fetch_object()));
}
