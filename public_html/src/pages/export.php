<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/20/2016
 * Time: 10:04
 */
include_once('../_config/connect.php');
if( $_POST ) {

    $smalls = $_POST['export_start'];
    $smalle = $_POST['export_end'];
    $start = $_POST['export_start'] . " 12:00:00 AM";
    $end = $_POST['export_end'] . " 11:59:59 PM";

    if($_POST['export'] == "Export by Start Date"){
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE start_date between ? AND ?");
        $stmt->bind_param("ss", $start, $end);
        $name = "Start Date";
    } elseif($_POST['export'] == "Export by Report Date"){
        $stmt = $conn->prepare("SELECT * FROM untied_aid_analyst_worksheet WHERE id_time between ? AND ?");
        $stmt->bind_param("ss", $start, $end);
        $name = "Report Date";
    }

    $stmt->execute();
    $stmt->bind_result($id, $id_time, $proj_num, $conversion, $tied_status, $opm, $agency, $duration, $start_date,
        $closing_date, $award_date, $usd, $currency, $category, $donor, $recipient, $sector, $title, $description, $contact_name,
        $contact_address, $email_address, $contact_phone, $implementer, $awarded_amount, $oecd, $website, $multiple, $canned, $notreported, $award_no);

    // These are our easy to read column names
    $header = "Project Number\tAward Number\tSDR Rate\tTied Status\tOPM Code\tAgency" .
            "\tDuration in Months\tBidding Start Date\tBidding Closing Date\tAward Date\tMillions of USD" .
            "\tAmount, After SDR\tSDR Treasury Category\tDonor Country\tRecipient Country\tSector" .
            "\tProject Title\tProject Description\tContact Name" .
            "\tImplementer Address\tContact Email\tContact Phone\tAward Implementer" .
            "\tAmount Awarded\tNotification Number\tWeb Address\tMultiple Award Info\tCancelled\tNot Reported\t";

    /* while( $row = $result->fetch_assoc() )
    {
    */
    while( $stmt->fetch()){
        $counter = true;
        $line = '';
        // foreach( $row as $value )
        // {
            /* if ($counter) {
                if ((!isset($value)) || ($value == "")) {
                    $value = "\t";
                } else {
                    $value = str_replace('"', '""', $value);
                    $value = '"' . $value . '"' . "\t";
                }
                $line .= $value;
            } */

            if ($counter) {
                $line = '""' . str_replace('"','""',$proj_num) . "\t" . str_replace('"','""',$award_no) . "\t" . 
                    str_replace('"','""',$conversion) . "\t" .
                    str_replace('"','""',$tied_status) . "\t" . str_replace('"','""',$opm) . "\t" .
                    str_replace('"','""',$agency) . "\t" . str_replace('"','""',$duration) . "\t" .
                    str_replace('"','""',$start_date) . "\t" . str_replace('"','""',$closing_date) . "\t" .
                    str_replace('"','""',$award_date) . "\t" .
                    str_replace('"','""',$usd) . "\t" . str_replace('"','""',$currency) . "\t" .
                    str_replace('"','""',$category) . "\t" . str_replace('"','""',$donor) . "\t" .
                    str_replace('"','""',$recipient) . "\t" . str_replace('"','""',$sector) . "\t" .
                    str_replace('	',' ',str_replace('"','""',$title)) . "\t" . 
                    str_replace('	',' ',str_replace('"','""',$description)) . "\t" .
                    str_replace('"','""',$contact_name) . "\t" . 
                    str_replace('	',' ',str_replace('"','""',$contact_address)) . "\t" .
                    str_replace('"','""',$email_address) . "\t" . str_replace('"','""',$contact_phone) . "\t" .
                    str_replace('"','""',$implementer) . "\t" . str_replace('"','""',$awarded_amount) . "\t" .
                    str_replace('"','""',$oecd) . "\t" . str_replace('"','""',$website) . "\t" .
                    str_replace('	',' ',str_replace('"','""',$multiple)) . "\t";
                if ($canned == 1) {
                    $line .= str_replace('"','""','Yes') . "\t";
                } else {
                    $line .= str_replace('"','""','No') . "\t";
                }
                if ($notreported == 1) {
                    $line .= str_replace('"','""','Yes') . "\t";
                } else {
                    $line .= str_replace('"','""','No') . "\t";
                }
            }
        $counter = true;
        // }
        $data .= trim( $line ) . "\n";
    }

    $data = str_replace( "\r" , "" , $data );

    if ( $data == "" )
    {
        $data = "\n(0) Records Found!\n";
    }

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=Tied Aid Export ".$smalls." to ".$smalle." ".$name.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$data";

    $stmt->close();
    $conn->close();

}
?>