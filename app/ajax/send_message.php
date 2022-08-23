<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once("../../connect.php");

    $msg = htmlspecialchars($_POST['msg']);
    $time = date("h:i a");

    $stmt = $db->prepare("INSERT INTO messages(content , user1 , user2 , date) VALUES(? , ? , ? , NOW())");
    $stmt->execute([htmlspecialchars($_POST['msg']), $_SESSION['userid'], $_POST['to']]);

?>
        <p class="ltext align-self-end border rounded p-2 mb-1"><?=$msg?>
            <small class="d-block" style="color: #FFF;"><?=$time?></small>
        </p>
    <?php

}
?>