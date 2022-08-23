<?php
session_start();
require_once("../../connect.php");
require_once("../../functions.php");

$stmt = $db->prepare("SELECT last_seen FROM users WHERE userid=?");
$stmt->execute([$_POST['userid']]);
$status = $stmt->fetch();
$timeago = explode(" ", get_time_ago($status['last_seen']));
$variable = $timeago;
$timeago = ($timeago[0] == 'less' || $timeago[1] == 'second' . ($timeago[0] > 1 ? "s" : "")) ? "Online" : $timeago;
$timeago = json_encode($timeago);
echo $timeago;
?>