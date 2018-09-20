<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/15/2016
 * Time: 13:30
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
?>
<link rel="stylesheet" type="text/css" href="../_stylesheets/findit.css">
<?php
if( $_POST ) {

    $start = $_POST['table_start'] . " 12:00:00 AM";
    $end = $_POST['table_end'] . " 11:59:59 PM";

    if($_POST['submit'] == "Search by Start Date"){
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE start_date between ? AND ?");
        $stmt->bind_param("ss", $start, $end);
    } elseif($_POST['submit'] == "Search by Report Date"){
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE id_time between ? AND ?");
        $stmt->bind_param("ss", $start, $end);
    }

    $stmt->execute();
    $stmt->bind_result($id, $id_time, $proj_num, $conversion, $tied_status, $opm, $agency, $duration, $start_date,
        $closing_date, $award_date, $usd, $currency, $category, $donor, $recipient, $sector, $title, $description, $contact_name,
        $contact_address, $email_address, $contact_phone, $implementer, $awarded_amount, $oecd, $website, $multiple, $canned, $notreported, $awardno);

        // output data of each row
        echo '<div style="overflow-x:auto">';
        echo '<table>';
        echo '<tr><td>Project Number</td><td>Award Number</td><td>SDR Rate</td><td>Tied Status</td>
            <td>OPM Code</td><td>Agency</td><td>Duration in Months</td><td>Bidding Start Date</td>
            <td>Bidding Closing Date</td><td>Award Date</td><td>Amount in USD</td><td>Amount, After SDR Exchange</td>
            <td>SDR Treasury Category</td><td>Donor Country</td><td>Recipient Country</td><td>Sector</td>
            <td>Project Title</td><td>Project Description</td><td>Contact Name</td><td>Implementer Address</td>
            <td>Contact Email</td><td>Contact Phone</td><td>Award Implementer</td><td>Amount Awarded</td>
            <td>Notification Number</td><td>Web Address</td><td>Multiple Award Information</td><td>Cancelled?</td><td>Not Reported?</td></tr>';
        while($stmt->fetch()) {
            if ($id !== 1) {
                echo '<tr>';
                echo '<td>' . $proj_num . '</td><td>' . $awardno . '</td><td>' . $conversion . '</td><td>' . $tied_status . '</td><td>' .
                    $opm . '</td><td>' . $agency . '</td><td>' . $duration . '</td><td>' . $start_date . '</td><td>' .
                    $closing_date . '</td><td>' . $award_date . '</td><td>' . $usd . '</td><td>' . $currency . '</td><td>' . $category .
                    '</td><td>' . $donor . '</td><td>' . $recipient . '</td><td>' . $sector . '</td><td>' . $title .
                    '</td><td>' . $description . '</td><td>' . $contact_name . '</td><td>' . $contact_address .
                    '</td><td>' . $email_address . '</td><td>' . $contact_phone . '</td><td>' . $implementer .
                    '</td><td>' . $awarded_amount . '</td><td>' . $oecd . '</td><td>' . $website . '</td><td>' . $multiple . '</td>';
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
        }
        echo '</table>';
        echo '</div>';

    $stmt->close();
    $conn->close();

}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>
