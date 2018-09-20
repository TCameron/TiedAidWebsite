<!DOCTYPE html>
<html lang="en">
<?php
include_once('../_includes/nav.php');
include_once('../_config/connect.php');

$sql = "SELECT exchange FROM untied_aid_analyst_worksheet WHERE id = 1 LIMIT 1";

$result = $conn->query($sql);
?>
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../_stylesheets/untied.css">
    <title>Untied Aid Analyst Worksheet Submission</title>
    <script src="../_js/jquery-1.11.1.min.js"></script>
    <script src="../_js/jquery-ui.min.js"></script>
    <script src="../_js/jquery.select-to-autocomplete.js"></script>
    <!--<script>
        (function($){
            $(function(){
                $('select').selectToAutocomplete();
            });
        })(jQuery);
    </script>
    <link rel="stylesheet" href="jquery-ui.css">
    <style>
        body {
            font-family: Arial, Verdana, sans-serif;
            font-size: 13px;
        }
        .ui-autocomplete {
            padding: 0;
            list-style: none;
            background-color: #fff;
            width: 218px;
            border: 1px solid #B0BECA;
            max-height: 350px;
            overflow-x: hidden;
        }
        .ui-autocomplete .ui-menu-item {
            border-top: 1px solid #B0BECA;
            display: block;
            padding: 4px 6px;
            color: #353D44;
            cursor: pointer;
        }
        .ui-autocomplete .ui-menu-item:first-child {
            border-top: none;
        }
        .ui-autocomplete .ui-menu-item.ui-state-focus {
            background-color: #D5E5F4;
            color: #161A1C;
        }
    </style>-->
</head>
<body>
<h1>
    Create a New Record
</h1>
<form action="insert.php" method="POST">
    <p>
        <label for="award">Donor Project No.:</label>
        <input type="text" name="award" id="award" placeholder="XXX-XXX-XXXXX" required>
    </p>
    <p>
	<label for="awardno">Award Number:</label>
	<input type="text" name="awardno" id="awardno" placeholder="XXX-XXX-XXXXX"><b style="color:red">*</b>
    </p>
    <p>
        <label for="title">Project Title:</label>
        <input type="text" name="title" id="title" placeholder="Project Title" required>
    </p>
    <p>
        <label for="description">Project Description:</label>
        <textarea name="description" id="description" placeholder="Project Description" cols="40" rows="4" required></textarea>
    </p>
    <p>
        <label>OPM Code: </label><br>
        <input type="radio" name="opm_code" value="935" required>935 - OECD - Untied<br>
        <input type="radio" name="opm_code" value="000" required>000 - Treasury - Tied<br>
        <input type="radio" name="opm_code" value="937" required>937 - Treasury - Partially Tied<br>
        <input type="radio" name="opm_code" value="110" required>110 - Treasury - Partially Tied<br>
    </p>
    <p>
        <label for="start_date">Bid Start Date:</label>
        <input type="date" name="start_date" id="start_date" placeholder="YYYY-MM-DD" required>
    </p>
    <p>
        <label for="closing_date">Bid Closing Date:</label>
        <input type="date" name="closing_date" id="closing_date" placeholder="YYYY-MM-DD" required>
    </p>
    <p>
        <label for="award_date">Award Date:</label>
        <input type="date" name="award_date" id="award_date" placeholder="YYYY-MM-DD"><b style="color:red">*</b>
    </p>
    <p>
        <label for="duration">Project Duration (Months):</label>
        <input type="number" name="duration" id="duration" placeholder="24" >
    </p>
    <p>
        <label for="usd">Amount in USD:</label>
        <input type="number" name="usd" id="usd" step="any" placeholder="35000000" required>
    </p>
    <p>
        <label>Current SDR Rate:</label>
        <?php
        while($oldcurr = $result->fetch_assoc()) {
            echo $oldcurr["exchange"];
        }
        $conn->close();
        ?>
    </p>
    <p>
        <label for="donor">Donor:</label>
        <select name="donor" id="donor" autofocus="autofocus" autocorrect="off" autocomplete="off" placeholder="Donor Country">
	<option value="United States">United States</option>
        </select>
    </p>
    <p>
        <label for="recipient">Recipient:</label>
        <select name="recipient" id="recipient" autofocus="autofocus" autocorrect="off" autocomplete="off" placeholder="Recipient Country">
            <?php
            include_once('../_includes/rcountries.php');
            ?>
        </select>
    </p>
    <p>
        <label for="sector">Sector:</label>
        <select name="sector" id="sector" autofocus="autofocus" autocorrect="off" autocomplete="off" placeholder="Sector">
            <?php
            include_once('../_includes/sectors.php');
            ?>
        </select>
    </p>
    <p>
        <label for="implementer">Awarded Implementer:</label>
        <input type="text" id="implementer" name="implementer" placeholder="Implementer"><b style="color:red">*</b>

    </p>
    <p>
        <label for="awarded_amount">Awarded Amount:</label>
        <input type="number" name="awarded_amount" id="awarded_amount" placeholder="10.5"><b style="color:red">*</b>

    </p>
    <p>
        <label for="oecd_number">OECD Notification Number:</label>
        <input type="text" name="oecd_number" id="oecd_number" placeholder="XXX-XXX-XXXXX"><b style="color:red">*</b>

    </p>
    <p>
        <label for="contact_name">Contact Name:</label>
        <input type="text" name="contact_name" id="contact_name" placeholder="First Last" required>
    </p>
    <p>
        <label for="contact_address">Implementer Address:</label>
        <textarea name="contact_address" id="contact_address" placeholder="Implementer Address" cols="40" rows="4"></textarea><b style="color:red">*</b>
    </p>
    <p>
        <label for="contact_phone">Contact Phone:</label>
        <input type="tel" name="contact_phone" id="contact_phone" placeholder="555-555-5555"><b style="color:red">*</b>
    </p>
    <p>
        <label for="email">Contact Email Address:</label>
        <input type="email" name="email" id="email" placeholder="example@email.com" required>
    </p>
    <p>
        <label for="website">Web Address:</label>
        <input type="url" name="website" id="website" placeholder="http://www.example.com/" required>
    </p>
    <p>
        <label for="multiple">Multiple Award Information:</label>
        <textarea name="multiple" id="multiple" placeholder="Multiple Award Infomation" cols="40" rows="4"></textarea><b style="color:red">*</b>
    </p>
    <p>
        <label for="cancelled">Cancelled?</label>
        <input type="checkbox" name="cancelled" id="cancelled" value="1">
    </p>
    <p>
        <label for="notreported">Not Reported?</label>
        <input type="checkbox" name="notreported" id="notreported" value="1">
    </p>
    <div class="buttons">
        <input type="submit" name="submit" value="Submit" class="regular" />
    </div>
</form>
<b style="color:red">*</b> = Not Required
</body>
</html>
