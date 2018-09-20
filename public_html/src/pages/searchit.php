<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/13/2016
 * Time: 15:20
 */
error_reporting(E_ALL);
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
?>
<link rel="stylesheet" type="text/css" href="../_stylesheets/searchit.css">
<?php
if( $_POST ) {

    if($_POST['submit'] == "Solicit"){
    	$solicitation = $_POST['solicitation'];
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE project_no=?");
        $stmt->bind_param("s", $solicitation);
    } elseif($_POST['submit'] == "Award"){
        $awardno = $_POST['awardno'];
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE award_no=?");
        $stmt->bind_param("s", $awardno);        
    } elseif($_POST['submit'] == "Title") {
	$proj_title = $_POST['title'];
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE project_title=?");
        $stmt->bind_param("s", $proj_title);
    }

    $ex=$stmt->execute();
    if (false === $ex){
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
    $ex=$stmt->bind_result($id, $id_time, $proj_num, $conversion, $tied_status, $opm, $agency, $duration, $start_date,
        $closing_date, $award_date, $usd, $currency, $category, $donor, $recipient, $sector, $title, $description, $contact_name,
        $contact_address, $email_address, $contact_phone, $implementer, $awarded_amount, $oecd, $website, $multiple, $canned, $notreported, $awardno);
    if (false === $ex) {
        die('bind_result() failed: ' . htmlspecialchars($stmt->error));
    }
    //$result = $conn->query($sql);

    //if ($result->num_rows > 0) {

    // output data of each row
    echo '<div style="overflow-x:auto">';
    echo '<table>';
    echo '<tr><th><div style="width: 150px">Project Number</div></th><th>Award Number</th><th>SDR Rate</th><th>Tied Status</th>
        <th>OPM Code</th><th>Agency</th><th>Duration in Months</th><th><div style="width: 100px">Bidding Start Date</div></th>
        <th><div style="width: 100px">Bidding Closing Date</div></th><th><div style="width: 100px">Award Date</div></th>
        <th>Amount in USD</th><th>Amount, After Exchange</th><th>SDR Treasury Category</th><th>Donor Country</th>
        <th>Recipient Country</th><th><div style="width: 200px">Sector</th><th><div style="width: 200px">Project Title</div></th>
        <th><div style="width: 600px">Project Description</div></th><th><div style="width: 150px">Contact Name</div></th>
        <th><div style="width: 200px">Implementer Address</div></th><th>Contact Email</th><th>Contact Phone</th>
        <th><div style="width: 150px">Award Implementer</div></th><th>Amount Awarded</th>
        <th>Notification Number</th><th>Web Address</th><th><div style="width: 200px">Multiple Award Information</div></th><th>Cancelled?</th><th>Not Reported?</th></tr>';
    while($stmt->fetch()) {
        echo '<tr>';
        /* $count = 0;
        foreach ($row as $field) {
            if ($count > 1) {
                echo '<td>' . htmlspecialchars($field) . '</td>';
            }
            $count = $count + 1;
        } */
        echo '<td>'.$proj_num.'</td><td>'.$awardno.'</td><td>'.$conversion.'</td><td>'.$tied_status.'</td><td>'.$opm.'</td><td>'.
            $agency.'</td><td>'.$duration.'</td><td>'.$start_date.'</td><td>'.$closing_date.'</td><td>'.$award_date.'</td><td>'.
            $usd.'</td><td>'.$currency.'</td><td>'.$category.'</td><td>'.$donor.'</td><td>'.$recipient.'</td><td>'.
            $sector.'</td><td>'.$title.'</td><td><div style="width: 600px">'.$description.'</div></td><td>'.$contact_name.'</td><td>'.
            $contact_address.'</td><td>'.$email_address.'</td><td>'.$contact_phone.'</td><td>'.$implementer.'</td><td>'.
            $awarded_amount.'</td><td>'.$oecd.'</td><td>'.$website.'</td><td>'.$multiple.'</td>';
        if ($canned == 1) {
            echo '<td>Yes</td>';
        } else {
            echo '<td>No</td>';
        }
        if ($notreported == 1) {
            echo '<td>Yes</td>';
        } else {
            echo '<td>No</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    echo '<h2>Most Recent Submission: </h2>';
    echo '<h2>Edit:</h2><a href="edit.php?num=' . $proj_num . '"><h2>Project:' . $proj_num . '</h2></a>';
    echo '<h2>Delete:</h2><a href="delete.php?num=' . $proj_num . '"><h2>Project:' . $proj_num . '</h2></a>';


    /* } else {
        echo "0 results";
    }*/

    $stmt->close();
    $conn->close();

}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>
