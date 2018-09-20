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
    <link rel="stylesheet" type="text/css" href="../_stylesheets/edit.css">
    <title>Edit Record</title>
    <!--<script src="jquery-1.11.1.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="jquery.select-to-autocomplete.js"></script>
    <script>
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
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                if($(this).attr('id') == 'oecd') {
                    $('#show-me').hide();
                    $("#untied").prop("checked", true);
                }
                else {
                    $('#show-me').show();
                }
            });
        });

    </script>
</head>
<body>
<h1>
    Editing an Existing Record
</h1>
<h2>
    Project Number:
    <?php
        echo $award;
    ?>
</h2>
<?php
    echo '<form action="change.php?num=' . $award . '" method="POST">';
?>
    <p>
        <label>Project Title:</label>
        <?php
	echo '<input type="text" name="proj_title" id="proj_title" value="'.$row["project_title"].'">';
        ?>
    </p>
    <p>
        <label>Project Description:</label>
        <textarea name="proj_desc" id="proj_desc" placeholder="Project Description" cols="40" rows="4"><?php
        echo $row["project_desc"];
        ?></textarea>
    </p>
    <p>
	<label>Award Number:</label>
	<?php
        echo '<input type="text" name="award_num" id="award_num" value="'.$row["award_no"].'">';
	?><b style="color:red">*</b>

    </p>
    <p>
        <label>OPM Code: </label><br>
        <input type="radio" name="opm_code" value="935" <?php
	if ($row["opm_code"] == 935)
            echo 'checked="checked"';
	?>required>935 - OECD - Untied<br>
        <input type="radio" name="opm_code" value="000" <?php
	if ($row["opm_code"] == 000)
            echo 'checked="checked"';
        ?>required>000 - Treasury - Tied<br>
        <input type="radio" name="opm_code" value="937" <?php
        if ($row["opm_code"] == 937)
            echo 'checked="checked"';
        ?>required>937 - Treasury - Partially Tied<br>
        <input type="radio" name="opm_code" value="110" <?php
        if ($row["opm_code"] == 110)
            echo 'checked="checked"';
        ?>required>110 - Treasury - Partially Tied<br>
    </p>
    <p>
        <label for="start_date">Bid Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php
        echo $row["start_date"];
        ?>" required>
    </p>
    <p>
        <label for="closing_date">Bid Closing Date:</label>
        <input type="date" name="closing_date" id="closing_date" value="<?php
        echo $row["closing_date"];
        ?>" required>
    </p>
    <p>
        <label for="award_date">Award Date:</label>
        <input type="date" name="award_date" id="award_date" value="<?php
        echo $row["award_date"];
        ?>"><b style="color:red">*</b>
    </p>
    <p>
        <label for="duration">Project Duration (Months):</label>
        <input type="number" name="duration" id="duration" placeholder="24" value="<?php
            echo $row["duration"];
        ?>" required>
    </p>
    <p>
        <label for="usd">Amount in USD:</label>
        <input type="number" name="usd" id="usd" step="any" placeholder="35000000"  value="<?php
        echo $row["usd"];
        ?>" required>
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
        <label for="recipient">Recipient:</label>
        <select name="recipient" id="recipient" autofocus="autofocus" autocorrect="off" autocomplete="off" placeholder="Recipient Country">
            <?php
            include_once('../_includes/ecountries.php');
            ?>
        </select>
    </p>
    <p>
        <label>Sector:</label>
        <?php
            echo $row["sector"];
        ?>
    </p>
    <p>
        <label for="implementer">Awarded Implementer:</label>
        <input type="text" id="implementer" name="implementer" placeholder="Implementer" value="<?php
        echo $row["implementer"];
        ?>" >
    </p>
    <p>
        <label for="awarded_amount">Awarded Amount:</label>
        <input type="number" name="awarded_amount" id="awarded_amount" placeholder="10.5" value="<?php
        echo $row["awarded_amount"];
        ?>" >
    </p>
    <p>
        <label for="oecd_number">OECD Notification Number:</label>
        <input type="text" name="oecd_number" id="oecd_number" placeholder="XXX-XXX-XXXXX" value="<?php
        echo $row["oecd_number"];
        ?>" >
    </p>
    <p>
        <label for="contact_name">Contact Name:</label>
        <input type="text" name="contact_name" id="contact_name" placeholder="First Last" value="<?php
        echo $row["contact_name"];
        ?>" required>
    </p>
    <p>
        <label for="contact_address">Implementer Address:</label>
        <textarea name="contact_address" id="contact_address" placeholder="Implementer Address" cols="40" rows="4"><?php
        echo $row["contact_add"];
        ?></textarea>
    </p>
    <p>
        <label for="contact_phone">Contact Phone:</label>
        <input type="tel" name="contact_phone" id="contact_phone" placeholder="555-555-5555" value="<?php
        echo $row["contact_phone"];
        ?>"><b style="color:red">*</b>
    </p>
    <p>
        <label for="email">Contact Email Address:</label>
        <input type="email" name="email" id="email" placeholder="example@email.com" value="<?php
        echo $row["contact_email"];
        ?>" required>
    </p>
    <p>
        <label for="website">Web Address:</label>
        <input type="url" name="website" id="website" placeholder="http://www.example.com/" value="<?php
        echo $row["web"];
        ?>" required>
    </p>
    <p>
        <label for="multiple">Multiple Award Information:</label>
        <textarea name="multiple" id="multiple" placeholder="Multiple Award Infomation" cols="40" rows="4"><?php
        echo $row["multiple"];
        ?></textarea><b style="color:red">*</b>
    </p>
    <p>
        <label for="cancelled">Cancelled?</label>
        <input type="checkbox" name="cancelled" id="cancelled" value="1" <?php
	    if ($row["cancelled"] == 1) {
            echo 'checked';
        }
        ?>>
    </p>
    <p>
        <label for="notreported">Not Reported?</label>
        <input type="checkbox" name="notreported" id="notreported" value="1" <?php
	    if ($row["notreported"] == 1) {
            echo 'checked';
        }
        ?>>
    </p>
    <div class="buttons">
        <input type="submit" name="submit" value="Submit" class="regular" />
    </div>
<b style="color:red">*</b> = Not Required

<?php
$conn->close();
?>
</form>
</body>
</html>
