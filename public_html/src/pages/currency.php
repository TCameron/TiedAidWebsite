<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/20/2016
 * Time: 11:10
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');

$sql = "SELECT exchange FROM untied_aid_analyst_worksheet WHERE id = 1 LIMIT 1";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../_stylesheets/currency.css">
    <title>Change the SDR Rate</title>
</head>
<body>
<h1>Change the SDR Rate</h1>
<h3><label>Current SDR Rate:</label>
    <?php
    while($oldcurr = $result->fetch_assoc()) {
        echo $oldcurr["exchange"];
    }
    $conn->close();
    ?></h3>
<form action="changecurrency.php" method="POST">
    <p>
    <h3><label for="curr">New SDR Rate:</label>
        <input type="text" name="curr" id="curr" required></h3>
    </p>
    <div class="buttons">
        <input type="submit" name="submit" value="Submit" class="regular" />
    </div>
</form>
</body>
</html>