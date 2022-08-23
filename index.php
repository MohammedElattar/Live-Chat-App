<?php
ob_start();
if(session_id()== '')session_start();
$title = "Home";
require_once("init.php");
if (isset($_SESSION['username'])) {

    $stmt = $db->prepare("SELECT Name,avatar FROM users WHERE username=?");
    $stmt->execute([$_SESSION['username']]);
    $dta = $stmt->fetch();
?>

    <body class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
        <div class="p-2 w-400 rounded shadow" style="width: 400px;">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light"></div>
                <div class="d-flex align-items-center info">
                    <img src="uploads/<?= $dta['avatar'] ?>" alt="<?= $dta['Name'] ?>" class="w-25 rounded-circle" style="height: 58%;">
                    <h3 class="fs-xs m-2" style="width:45% ;"><?= $dta['Name'] ?></h3>
                    <a href="log_out.php" class="btn btn-danger">Log Out</a>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" id="searchinpt">
                    <button class="btn btn-primary"><i class="fa fa-search" id="search-btn"></i></button>
                </div>
                <ul class="list-group mvh-50 overflow-auto" id="chat-list">
                            <?php
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
                                if ($stmt->rowCount() == 0) { ?>
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
                                            <a href="chats.php?userid=<?= $i ?>" class="d-flex justify-content-center align-items-center p-2" id="a-<?=$i?>">
                                                <div class="d-flex align-items-center">
                                                    <img src="uploads/<?= $data['avatar'] ?>" class="w-10 rounded-circle">
                                                    <h4 class="fs-xs m-2"><?= $data['Name'] ?></h4>
                                                </div>
                                                <div title="online" class="<?=$timeago?>" id="parent-online"></div>
                                                
                                                <script>
                                                    $(()=>{
                                                        function getOnlineOthers(){

                                                            $.post("app/ajax/update_last_seen_others.php" , {"userid":<?=$i?>} , function(data){
                                                                data = JSON.parse(data);
                                                                
                                                                let onlinedv = $("#a-<?=$i?>").children().eq(1);
                                                                if(data == "Online"){
                                                                    if(onlinedv.attr("class") == "offline"){onlinedv.attr("class" , "online");}
                                                                }
                                                                else {if(onlinedv.attr("class") == "online"){onlinedv.attr("class" , "offline")}}
                                                            })
                                                        }

                                                        getOnlineOthers();
                                                        setInterval(getOnlineOthers , 2000);
                                                    }) 
                                                </script>

                                            </a>
                                        </li>
<?php
                                    }
                                }
                                ?>
                </ul>
            </div>
        </div>
        </div>
    </body>
<?php

} else header("Location:login.php");
require_once("footer.php")
?>
<script>
$(function () {
    var txt;
    var online;
    let lastseen = function () {
        $.get("app/ajax/update_last_seen.php", "userid=<?= $_SESSION['userid'] ?>");
    }
    lastseen();
    setInterval(lastseen, 1000);
    $("#searchinpt").on("keyup", function () {
        $.post("app/ajax/search_users.php", {
            'word': `${this.value}`
        }, function (data) {
            if (data) $("#chat-list").html(data);
            else return;
        })
    })
})
</script>
<?php ob_end_flush() ?>
