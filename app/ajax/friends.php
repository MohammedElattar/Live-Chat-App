<?php if (session_id() == '')
    session_start();
require_once('../../connect.php');
require_once("../../functions.php");

$stmt = $db->prepare("SELECT userid FROM users WHERE username =?");
$stmt->execute([$_SESSION['username']]);
$id = $stmt->fetch();
$_SESSION['userid'] = $id['userid'];
$ids = [];
$stmt = $db->prepare(
    "SELECT
        *
    FROM
        messages
    where
        messages.user1=? or messages.user2=?
    "
);
$stmt->execute([$_SESSION['userid'], $_SESSION['userid']]);
$messages = $stmt->fetchAll();
if ($stmt->rowCount() == 0) {?>
    <div class="alert alert-info no-messages">
        <i class="fa fa-comments d-block fs-big"></i>
        <p>You Have No Messges Right Now</p>
    </div>

    <?php
} else {
    foreach ($messages as $item) $ids[] = $_SESSION['userid'] != $item['user1'] ? $item['user1'] : $item['user2'];
    $ids = array_unique($ids);
    foreach ($ids as $i) {
        $stmt = $db->prepare("SELECT Name , avatar , last_seen FROM users  WHERE userid=?");
        $stmt->execute([$i]);
        $data = $stmt->fetch();
        $timeago = explode(" ", get_time_ago($data['last_seen']));
        $timeago = ($timeago[0] == 'less' || $timeago[1] == 'second' . ($timeago[0] > 1 ? "s" : "")) ? "online" : "";
    ?>
        <li class="list-group-item">
            <a href="chats.php?userid=<?= $i ?>" class="d-flex justify-content-center align-items-center p-2" id="a-<?= $i ?>">
                <div class="d-flex align-items-center">
                    <img src="uploads/<?= $data['avatar'] ?>" class="w-10 rounded-circle">
                    <h4 class="fs-xs m-2"><?= $data['Name'] ?></h4>
                </div>
                <div title="online" class="<?= $timeago ?>" id="parent-online"></div>

                <script>
                    $(() => {
                        function getOnlineOthers() {

                            $.post("app/ajax/update_last_seen_others.php", {
                                "userid": <?= $i ?>
                            }, function(data) {
                                data = JSON.parse(data);
                                let onlinedv = $("#a-<?= $i ?>").children().eq(1);
                                if (data == "Online") {
                                    if (onlinedv.attr("class") == "offline") {
                                        onlinedv.attr("class", "online");
                                    }
                                } else {
                                    if (onlinedv.attr("class") == "online") {
                                        onlinedv.attr("class", "offline")
                                    }
                                }
                            })
                        }
                        getOnlineOthers();
                        setInterval(getOnlineOthers, 2000);
                    })
                </script>

            </a>
        </li>
<?php
    }
}
?>