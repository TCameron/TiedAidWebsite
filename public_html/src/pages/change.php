<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/14/2016
 * Time: 10:07
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
if( $_POST ) {

    header("refresh:3;url=/public_html/index.php");

    $proj_title = $_POST['proj_title'];
    $proj_desc = $_POST['proj_desc'];
    $award_no = $_POST['award_num'];
    $start_date = $_POST['start_date'];
    $closing_date = $_POST['closing_date'];
    $award_date = $_POST['award_date'];
    $opm_code = $_POST['opm_code'];
    $duration = $_POST['duration'];
    $usd = $_POST['usd'];
    $conversion = $_POST['conversion'];
    $award = $_GET['num'];
    $contact_name = $_POST['contact_name'];
    $contact_address = $_POST['contact_address'];
    $contact_phone = $_POST['contact_phone'];
    $email_address = $_POST['email'];
    $website = $_POST['website'];
    $implementer = $_POST['implementer'];
    $awarded_amount = $_POST['awarded_amount'];
    $oecd = $_POST['oecd_number'];
    $multiple = $_POST['multiple'];
    $recipient = $_POST['recipient'];
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

    $curr = "SELECT exchange FROM untied_aid_analyst_worksheet WHERE id = 1 LIMIT 1";

    $result = $conn->query($curr);

    while ($oldcurr = $result->fetch_assoc()) {
        $conversion = $oldcurr["exchange"];
    }

    if($opm_code == 935) {
        $agency = 'OECD';
        $tied_status = 'untied';
    } else {
        $agency = 'Treasury';
        if($opm_code == 000){
            $tied_status = 'tied';
        } else {
            $tied_status = 'partially tied';
        }
    }

    $proj_desc = str_replace(array("\r", "\n"), ' ', $proj_desc);
    $contact_address = str_replace(array("\r", "\n"), ' ', $contact_address);
    $currency = $usd * $conversion;
    include_once('../_includes/oecdcat.php');

    if ($agency == 'Treasury') {
        $stmt = $conn->prepare("UPDATE untied_aid_analyst_worksheet SET project_title=?, project_desc=?, 
            start_date=?, closing_date=?, award_date=?, agency=?, tied_status=?, opm_code=?, duration=?, usd=?, currency=?, oecd_cat=?, contact_name=?, contact_add=?, 
            contact_phone=?, contact_email=?, web=?, implementer=?, awarded_amount=?, oecd_number=?, multiple=?,
            cancelled=?, notreported=?, award_no=?, recipient=?
            WHERE project_no = ?");
        $stmt->bind_param("ssssssssiddsssssssdssiisss", $proj_title, $proj_desc, $start_date, $closing_date, $award_date, $agency, $tied_status, $opm_code, $duration, $usd, $currency, 
            $category, $contact_name, $contact_address, $contact_phone, $email_address, $website, $implementer,
            $awarded_amount, $oecd, $multiple, $canned, $notreported, $award_no, $recipient, $award);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("UPDATE untied_aid_analyst_worksheet SET
                project_title=?, project_desc=?, start_date=?, closing_date=?, award_date=?, agency=?, tied_status=?, opm_code=?, duration=?, usd=?, contact_name=?,
                contact_add=?, contact_phone=?, contact_email=?, web=?, implementer=?, awarded_amount=?,
                oecd_number=?, multiple=?, cancelled=?, notreported=?, award_no=?, recipient=?
                WHERE project_no = ?");
        $stmt->bind_param("ssssssssidssssssdssiisss", $proj_title, $proj_desc, $start_date, $closing_date, $award_date, $agency, $tied_status, $opm_code, $duration, $usd, 
            $contact_name, $contact_address, $contact_phone, $email_address, $website, $implementer, 
            $awarded_amount, $oecd, $multiple, $canned, $notreported, $award_no, $recipient, $award);
        $stmt->execute();
    }


    /*if ($conn->query($sql) === TRUE) {
        echo "<h3>Record with Project Number " . $award . " updated successfully.</h3>";
    } else {
        echo "<h3>Error: " . $sql . "<br>" . $stmt->errno . "</h3>";
    }*/

    $stmt->close();
    $conn->close();

}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>

