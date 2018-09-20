<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/22/2016
 * Time: 15:30
 */
include_once('../_includes/nav.php');
include_once('../_config/connect.php');
if( $_POST ) {

    $award = $_GET['num'];

    $stmt = $conn->prepare("DELETE FROM untied_aid_analyst_worksheet WHERE project_no = ?");
    $stmt->bind_param("s", $award);
    $ex=$stmt->execute();

    if (false === $ex) {
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    } else {
        echo "<h3>Record with Project Number " . $award . " deleted successfully.</h3>";
    }

    $stmt->close();
    $conn->close();

}
?>
<br>
<a href="/public_html/index.php">Return to Index</a>

