<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/20/2016
 * Time: 13:28
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
if( $_POST ) {

    header( "refresh:3;url=../../index.php" );

    $currency = $_POST['curr'];

    $stmt = $conn->prepare("UPDATE untied_aid_analyst_worksheet SET exchange = ? WHERE id = 1");
    $stmt->bind_param("s", $currency);
    $stmt->execute();

    echo "<h3>Changed the exchange rate to " . $currency . "</h3>";

    $stmt->close();
    $conn->close();

}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>
