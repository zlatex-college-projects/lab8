<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login">
        <label for="login">Login</label>
        <input type="text" id="login">
        <button class="login-btn">Login</button>
    </div>
    <div class="reports">
        <?php
        $reports = $conn->query("SELECT * FROM `reports`");
        while ($report = $reports->fetch_assoc()) {
            $report_id = $report["report_id"]
        ?>
            <div class="report report-<?php echo $report_id ?>">
                <div class="report-id"><?php echo $report_id ?></div>
                <div class="report-name"><input type="text" value="<?php echo $report["report_name"] ?>"></div>
                <div class="report-text"><textarea cols="30" rows="10"><?php echo $report["report_text"] ?></textarea></div>
                <div class="report-author">
                    <?php
                    $user = $conn->query("SELECT `user_name` FROM `users` WHERE `user_id` =" . $report['user_id'])->fetch_object();
                    echo $user->user_name;
                    ?>
                </div>
                <div class="report-save btn"><span onclick="updateReport(<?php echo $report_id ?>)">Save</span></div>
                <div class="report-delete btn"><span onclick="deleteReport(<?php echo $report_id ?>)">Delete</span></div>
            </div>
        <?php
        }
        ?>
    </div>
    <button style="display: none;" class="add-report">Add new report</button>
    <script src="script.js"></script>
</body>

</html>