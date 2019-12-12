<?php
  require 'db.php';
  $userid=$_COOKIE['userid'];
  $gameid = $_POST['gameid'];
  $q = mysqli_fetch_assoc(mysqli_query($link,"select * from `orders` where `game_id`='$gameid' AND `user_id`='$userid'"))['id'];
  if((isset($gameid))&&(isset($userid))&&(count($q)==0)){
    $price = mysqli_fetch_assoc(mysqli_query($link,"SELECT `price` from `games` where `id`='$gameid'"))['price'];
    mysqli_query($link,"INSERT INTO `orders` VALUES(null,'$gameid','$userid','$price')");
  }
  header("Location: /");
?>
