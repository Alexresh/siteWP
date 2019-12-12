<?php
require 'db.php';
$userid=$_COOKIE['userid'];

if(!isset($userid)){
  header("Location: /login.php");
}
if(isset($_POST["delorder"])){
  $or=$_POST["delorder"];
  mysqli_query($link,"DELETE FROM `orders` WHERE `id`='$or'");
}
 ?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ваша корзина</title>
  </head>
  <body>
    <?php
    $q=mysqli_query($link,"SELECT * FROM `orders` WHERE `user_id`='$userid'");
    $count_of_orders=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) as `a` FROM `orders` WHERE `user_id`='$userid'"))['a'];
    while ($order = mysqli_fetch_assoc($q)) {
      $gameid=$order['game_id'];
      $gamename=mysqli_fetch_assoc(mysqli_query($link,"select `name` from `games` where `id`=$gameid"))['name'];
      $orderid=$order['id'];
      echo '<form method="POST" action="mycart.php">' . $gamename . ' Цена:' . $order['price'] . ' <input type="hidden"  name="delorder" value="'. $orderid .'"><input type="submit" value="Удалить из корзины"></form><br>';

    }

    if($count_of_orders==0){
      echo "Ваша корзина пуста, сначала добавьте в неё товары <br>";
    }else{
      echo '<button type="button" name="button">Купить всё!</button>';
    }
     ?>
     <a href="/">Назад</a>
  </body>
</html>
