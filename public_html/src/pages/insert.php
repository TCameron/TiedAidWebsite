<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/12/2016
 * Time: 11:58
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
if( $_POST ) {

    header( "refresh:3;url=../../index.php" );

    $opm = $_POST['opm_code'];
    $awardno = $_POST['awardno']; 
    $start_date = $_POST['start_date'];
    $closing_date = $_POST['closing_date'];
    $award_date = $_POST['award_date'];
    $duration = $_POST['duration'];
    $usd = $_POST['usd'];
    $donor = $_POST['donor'];
    $recipient = $_POST['recipient'];
    $sector = $_POST['sector'];
    $award = $_POST['award'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $contact_name = $_POST['contact_name'];
    $contact_address = $_POST['contact_address'];
    $contact_phone = $_POST['contact_phone'];
    $email_address =  $_POST['email'];
    $website = $_POST['website'];
    $implementer = $_POST['implementer'];
    $awarded_amount = $_POST['awarded_amount'];
    $oecd = $_POST['oecd_number'];
    $multiple = $_POST['multiple'];
    if(isset($_POST['cancelled'])){
        $canned = $_POST['cancelled'];
    } else {
        $canned = 0;
    }
    if(isset($_POST['notreported'])){
        $notreported = $_POST['notreported'];
    } else {
        $notreported = 0;
    }

    if($opm == 935) {
        $agency = 'OECD';
        $tied_status = 'untied';
    } else {
        $agency = 'Treasury';
        if($opm == 000){
            $tied_status = 'tied';
        } else {
            $tied_status = 'partially tied';
        }
    }

    $curr = "SELECT exchange FROM untied_aid_analyst_worksheet WHERE id = 1 LIMIT 1";

    $result = $conn->query($curr);

    while($oldcurr = $result->fetch_assoc()) {
        $conversion = $oldcurr["exchange"];
    }

    $description = str_replace(array("\r", "\n"), ' ', $description);
    $contact_address = str_replace(array("\r", "\n"), ' ', $contact_address);
    $currency = $usd * $conversion;
    include_once('../_includes/oecdcat.php');

    if ($agency == 'Treasury') {
        $stmt=$conn->prepare("INSERT INTO untied_aid_analyst_worksheet (project_no, exchange, agency, tied_status, 
        opm_code, start_date, closing_date, award_date, duration, usd, currency, oecd_cat, donor, recipient, sector, project_title, 
        project_desc, contact_name, contact_add, contact_phone, contact_email, web, implementer, 
        awarded_amount, oecd_number, multiple, cancelled, notreported, award_no) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $ex=$stmt->bind_param("sdssssssiddssssssssssssdssiis", $award, $conversion, $agency, $tied_status, $opm, $start_date,
            $closing_date, $award_date, $duration, $usd, $currency, $category, $donor, $recipient, $sector, $title, $description,
            $contact_name, $contact_address, $contact_phone, $email_address, $website, $implementer, $awarded_amount,
            $oecd, $multiple, $canned, $notreported, $awardno);
        if (false === $ex) {
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        $ex=$stmt->execute();
        if (false === $ex) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    } else {
        $stmt=$conn->prepare("INSERT INTO untied_aid_analyst_worksheet (project_no, exchange, agency, tied_status, 
        opm_code, start_date, closing_date, award_date, duration, usd, donor, recipient, sector, project_title, project_desc, 
        contact_name, contact_add, contact_phone, contact_email, web, implementer, awarded_amount, oecd_number, multiple, cancelled,
	notreported, award_no) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $ex=$stmt->bind_param("sdssssssidsssssssssssdssiis", $award, $conversion, $agency, $tied_status, $opm, $start_date,
            $closing_date, $award_date, $duration, $usd, $donor, $recipient, $sector, $title, $description, $contact_name,
            $contact_address, $contact_phone, $email_address, $website, $implementer, $awarded_amount, $oecd, $multiple, $canned,
            $notreported, $awardno);
        if (false === $ex) {
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        $ex=$stmt->execute();
        if (false === $ex) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
    }

    /*
    if ($conn->query($sql) === TRUE) {
        echo "<h3>New record created successfully</h3>";
    } else {
        echo "<h3>Error: " . $sql . "<br>" . $conn->error . "</h3>";
    }
    */

    if (true === $ex) {
        echo '<h3>New record created successfully.</h3>';
    }

    $stmt->close();
    $conn->close();
    
}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>
