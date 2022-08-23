<?php
session_start();
require_once("../../functions.php");
$word['word'] = $_POST['word'] ? $_POST['word'] : "Word";
if(isset($_SESSION['username']) && isset($word['word']) && $word['word']){

    require_once("../../connect.php");
    $word['word'] = htmlspecialchars($word['word']);
    // if()
    $stmt = $db->prepare("SELECT Name,userid FROM users WHERE Name LIKE ? AND username!=? ");
    $stmt->execute(["%" . $word['word'] . "%" , $_SESSION['username']]);
    $names = $stmt->fetchAll();
    if(!empty($names)){
        foreach ($names as $i){
            $stmt = $db->prepare("SELECT avatar , last_seen FROM users  WHERE userid=?");
            $stmt->execute([$i[1]]);
            $data = $stmt->fetch();
            ?>
            <li class="list-group-item">
                                <a href="chats.php?userid=<?= $i[1] ?>" class="d-flex justify-content-center align-items-center p-2">
                                    <div class="d-flex align-items-center">
                                        <img src="uploads/<?= $data['avatar'] ?>" class="w-10 rounded-circle">
                                        <h4 class="fs-xs m-2"><?= $i[0]?></h4>
                                    </div>
                                    <?php
                                    $online = get_time_ago($data['last_seen']);
                                        
                                    ?>
                                    <div title="online" style="width: 30px;
                                                            height: 15px;
                                                            background: green;
                                                            border-radius: 50%;
                                                            display:none;
                                                            " name="<?=$online?>" id="parent-online">
                                    </div>
                                    <?php
                                    ?>

                                </a>
                            </li>
                <?php
        }
    }
    else{
        if($word['word'] == "Word"){
            require_once("friends.php");
        }
        else{
            ?>
        <div class="alert alert-info text-center p-2">
            <i class="fa fa-user-times d-block fs-big" style="font-size:60px;"></i>
            <br>
            <p style="font-weight: bold;
    text-align: left;" class="text-truncate"> There is no <?=$word['word']?></p>
        </div>
    <?php
        }
        
    }
}
else header("Location:../../index.php")
?>