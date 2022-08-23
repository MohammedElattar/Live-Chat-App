<?php

session_start();
if (isset($_SESSION['username'])) {

    if (isset($_GET['userid']) && is_numeric($_GET['userid'])) {
        $title = "Chatroom";
        require_once("init.php");
        $stmt = $db->prepare("SELECT * FROM users WHERE userid=?");
        $stmt->execute([$_GET['userid']]);
        if ($stmt->rowCount()) {
            $dta = $stmt->fetch();
            $timeago = explode(" ", get_time_ago($dta['last_seen']));
            $timeago = ($timeago[0] == 'less' || $timeago[1] == 'second' . ($timeago[0] > 1 ? "s" : "")) ? "Online" : $timeago;

?>

            <body class="d-flex justify-content-center align-items-center vh-100">
                <div class="p-2  rounded shadow chat-div">
                    <a href="index.php"><i class="fa fa-arrow-left"></i></a>
                    <?php

                    ?>
                    <div class="d-flex align-items-center">
                        <img src="uploads/<?= $dta['avatar'] ?>" class="w-10 rounded-circle">
                        <h3 class="display-4 fs-sm m-2 userName"><?= $dta['Name'] ?>
                            <br>
                            <div id="dv-<?= $dta['userid'] ?>">
                                <div title="online" class="offline" id="parent-online" style="width: 15px;"></div>
                                <p style="color: black;" id="status"></p>
                            </div>
                            <script>
                                $(() => {
                                    function getOnlineOthers() {

                                        $.post("app/ajax/update_last_seen_others.php", {
                                            "userid": <?= $dta['userid'] ?>
                                        }, function(data) {
                                            data = JSON.parse(data);
                                            
                                            let onlinedv = $("#dv-<?= $dta['userid'] ?>").children().eq(0);
                                            let p = $("#status");
                                            if (Array.isArray(data)) p.html(data.join(" "));
                                            else p.html(data);
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
                        </h3>
                    </div>
                    <div class="shadow p-4 rounded d-flex flex-column m4-2 h-50 chat-box">
                        <?php
                        $stmt = $db->prepare("SELECT * FROM messages WHERE (user1=? AND user2=?) OR (user2=? AND user1=?) ORDER BY id ASC");
                        $stmt->execute([$_SESSION['userid'], $_GET['userid'], $_SESSION['userid'], $_GET['userid']]);
                        $msgs = $stmt->fetchAll();

                        $cn = true;
                        if ($msgs) {
                            $cn = false;
                            foreach ($msgs as $i) {
                                $time = date("h:i a", strtotime($i['date']));
                        ?>

                                <p class="<?= $i['user1'] == $_SESSION['userid'] ? "ltext" : "rtext" ?> align-self-end border rounded p-2 mb-1"><?= $i['content'] ?>
                                    <small class="d-block"><?= $time ?></small>
                                </p>

                            <?php
                            }
                        }
                        if ($cn) { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-comments" style="font-size: 50px;"></i>
                                <p class="p-2 fw-bold">No Messages Yet , Be The First One To Chat</p>
                            </div>
                        <?php
                        }


                        ?>

                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control txtarea" cols="3"></textarea>
                        <button class="btn btn-primary snd-message">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </body>
<?php
            require_once("footer.php");
        } else
            header("Location:index.php");
    } else
        header("Location:index.php");
} else
    header("Location:login.php");
?>

<script>
    $(function() {
        let lastseen = function() {
            $.get("app/ajax/update_last_seen.php", "userid=<?= $_SESSION['userid'] ?>");
        }
        lastseen();
        setInterval(lastseen, 2000);

        function scrolldown() {
            let chatbx = document.querySelector(".chat-box");
            chatbx.scrollTop = chatbx.scrollHeight;
        }
        scrolldown();
        $(".snd-message").on("click", function() {

            let txt = $(".txtarea");

            if (txt.val()) {
                $.post("app/ajax/send_message.php", {
                    msg: txt.val(),
                    to: <?= $_GET['userid'] ?>
                }, function(data) {
                    $(".chat-box").append(data);
                    txt.val("");
                    scrolldown();
                })
            }
        })
        let chatbx = $(".chat-box");

        function getMessages() {

            $.post("app/get_messages.php" , {"userid" : <?=$_GET['userid']?>} , (data)=>{
                chatbx.append(data);
                if(data)scrolldown();
            })
        }
        getMessages();
        setInterval(getMessages, 500);
    })
</script>