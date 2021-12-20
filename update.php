<?php
if (!$_POST["report_id"]) {
    http_response_code(403);
    die('Forbidden');
}
include 'db.php';;
$report_id = $_POST["report_id"];
$report_name = mysqli_real_escape_string($conn,$_POST["name"]); ;
$report_text = mysqli_real_escape_string($conn,$_POST["text"]);
$user_id = $_POST["user_id"];
$result = $conn->query("UPDATE `reports` SET `report_name` = '$report_name', `report_text` = '$report_text', `user_id` = $user_id WHERE `report_id` = $report_id");
die(json_encode($result));