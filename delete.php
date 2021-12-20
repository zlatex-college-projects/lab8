<?php
if (!$_POST["report_id"]) {
    http_response_code(403);
    die('Forbidden');
}
include 'db.php';;
$report_id = $_POST["report_id"];
$result = $conn->query("DELETE FROM `reports` WHERE `report_id` = $report_id");