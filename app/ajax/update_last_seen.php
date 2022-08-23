<?php
if (session_id() == '')
    session_start();
if (isset($_SESSION['username']) && $_GET['userid']) {

    require("../../connect.php");
    $stmt = $db->prepare("UPDATE users SET last_seen=NOW() WHERE userid=?");
    $stmt->execute([$_GET['userid']]);

}
else
    header("Location:../../index.php");
?>