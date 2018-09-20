<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/22/2016
 * Time: 15:19
 */
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once('../_includes/nav.php');
include_once('../_config/connect.php');

$ex = "SELECT exchange FROM untied_aid_analyst_worksheet WHERE id = 1 LIMIT 1";

$result = $conn->query($ex);
$award = $_GET['num'];
$sql = "SELECT * FROM untied_aid_analyst_worksheet WHERE project_no = '$award'";
$proj = $conn->query($sql);
$row = $proj->fetch_assoc()
?>
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../_stylesheets/delete.css">
    <title>Delete Record</title>
</head>
<body>
<h1>
    Delete an Existing Record
</h1>
<h2>
    Project Number:
    <?php
        echo $award;
    ?>
</h2>
<?php
    echo '<form action="deleteit.php?num=' . $award . '" method="POST">';
?>
<p>
    <label>Project Title:</label>
    <?php
        echo $row["project_title"];
    ?>
</p>
<p>
    <label>Project Description:</label>
    <?php
        echo $row["project_desc"];
    ?>
</p>
<p>
    <label>Award Number:</label>
    <?php
	echo $row["award_no"];
    ?>
</p>
<p>
    <label>Agency:</label>
    <?php
        echo $row["agency"];
    ?>
</p>
<p>
    <label>Tied Status:</label>
    <?php
        echo $row["tied_status"];
    ?>
</p>
<p>
    <label>Bid Start Date:</label>
    <?php
        echo $row["start_date"];
    ?>
</p>
<p>
    <label>Bid Closing Date:</label>
    <?php
        echo $row["closing_date"];
    ?>
</p>
<p>
    <label>Award Date:</label>
    <?php
        echo $row["award_date"];
    ?>
</p>
<p>
    <label>Project Duration:</label>
    <?php
        echo $row["duration"];
    ?>
</p>
<p>
    <label>Amount in USD, Millions:</label>
    <?php
        echo $row["usd"];
    ?>
</p>
<p>
    <label>Previous SDR Rate:</label>
    <?php
        echo $row["exchange"];
    ?>
</p>
<p>
    <label>OECD Category:</label>
    <?php
    echo $row["oecd_cat"];
    ?>
</p>
<p>
    <label>Donor:</label>
    <?php
        echo $row["donor"];
    ?>
</p>
<p>
    <label>Recipient:</label>
    <?php
        echo $row["recipient"];
    ?>
</p>
<p>
    <label>Sector:</label>
    <?php
        echo $row["sector"];
    ?>
</p>
<p>
    <label>Awarded Implementer:</label>
    <?php
        echo $row["implementer"];
    ?>
</p>
<p>
    <label>Awarded Amount:</label>
    <?php
        echo $row["awarded_amount"];
    ?>
</p>
<p>
    <label>OECD Notification Number:</label>
    <?php
        echo $row["oecd_number"];
    ?>
</p>
<p>
    <label>Contact Name:</label>
    <?php
        echo $row["contact_name"];
    ?>
</p>
<p>
    <label>Implementer Address:</label>
    <?php
        echo $row["contact_add"];
    ?>
</p>
<p>
    <label>Contact Phone:</label>
    <?php
        echo $row["contact_phone"];
    ?>
</p>
<p>
    <label>Contact Email Address:</label>
    <?php
        echo $row["contact_email"];
    ?>
</p>
<p>
    <label>Contact Web Site:</label>
    <?php
        echo $row["web"];
    ?>
</p>
<p>
    <label>Multiple Award Information:</label>
    <?php
        echo $row["multiple"];
    ?>
</p>
<div class="buttons">
    <input type="submit" name="submit" value="Delete" class="regular" onclick="return confirm('Are you sure you want to delete this record?')"/>
</div>
<?php
$conn->close();
?>
</form>
</body>
</html>