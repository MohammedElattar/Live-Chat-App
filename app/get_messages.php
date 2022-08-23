<?php
if (session_id() == '')
    session_start();
include("../connect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $open = 0;
    $stmt = $db->prepare("SELECT * FROM messages WHERE user1=? AND user2=? ORDER BY id");
    $stmt->execute([$_POST['userid'], $_SESSION['userid']]);
    $msgs = $stmt->fetchAll();
    if ($msgs) {
        foreach ($msgs as $i) {
            if (!$i['opened']) {
                $time = date("h:i a", strtotime($i['date']));
                $i['opened'] = 1;
                $chat_id = $i['id'];

                $stmt = $db->prepare("UPDATE messages SET opened=1 WHERE id=?");
                $stmt->execute([$chat_id]);
?>
                    <p class="rtext align-self-end border rounded p-2 mb-1"><?= $i['content'] ?>
                                    <small class="d-block"><?= $time ?></small>
                    </p>
                <?php
            }
        }
    }
}
else
    header("Location:../index.php");


?>