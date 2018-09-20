<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/15/2016
 * Time: 12:05
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');

$sql = "SELECT start_date, MIN(start_date) FROM untied_aid_analyst_worksheet GROUP BY start_date LIMIT 1";

$result = $conn->query($sql);

$earliest = $result->fetch_assoc();
?>
<link rel="stylesheet" type="text/css" href="../_stylesheets/find.css">
<body>
    <h3>
        This page is used to search for records via either the date the record was put into the database, or via the listed bidding start date.</br>
        Input the range of dates to search for, and then click the appropriate button to return the results.
    </h3>
    <h1>Export Records to CSV:</h1>
    <form action="export.php" method="POST">
        <p>
            <label for="export_start">Earliest Date:</label>
            <input type="date" name="export_start" id="export_start" required>
        </p>
        <p>
            <label for="export_end">Latest Date:</label>
            <input type="date" name="export_end" id="export_end" required>
        </p>
        <div class="buttons">
            <input type="submit" name="export" value="Export by Start Date" class="regular" />
            <input type="submit" name="export" value="Export by Report Date" class="regular" />
        </div>
    </form>
    <h1>Display a Table of Records:</h1>
    <form action="findit.php" method="POST">
        <p>
            <label for="table_start">Earliest Date:</label>
            <input type="date" name="table_start" id="table_start" required>
        </p>
        <p>
            <label for="table_end">Latest Date:</label>
            <input type="date" name="table_end" id="table_end" required>
        </p>
        <div class="buttons">
            <input type="submit" name="submit" value="Search by Start Date" class="regular" />
            <input type="submit" name="submit" value="Search by Report Date" class="regular" />
        </div>
        <h3>Note: This option may take a bit to load.</h3>
    </form>
    <?php
        echo "<h3>Earliest Start Date: " . $earliest['start_date'] . "</h3>";
    ?>
</body>
