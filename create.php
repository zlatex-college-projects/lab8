<?php
if (!$_POST["user_id"]) {
    http_response_code(403);
    die('Forbidden');
}
include 'db.php';;
$user_id = $_POST["user_id"];
$conn->query("INSERT INTO `reports` (`user_id`) VALUES ($user_id)");
echo $conn -> insert_id;