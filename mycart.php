<?php
require 'db.php';
$userid=$_COOKIE['userid'];

$sumOfPrice=0;
if(!isset($userid)){
  header("Location: /login.php");
}else{
  if(isset($_GET['buy'])){
    mysqli_query($link, "DELETE FROM `orders` WHERE `user_id`='$userid'");
    echo "Поздравляем с покупкой";
    exit();
  }
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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Ваша корзина</title>
  </head>
  <body style="background-color:#e6e6e6">
    <div class="header">
      <div class="inner-header">
        <div class="logo">
          <a href="/" style="color:white;"><p>ProstoGames</p></a>
        </div>
        <div class="auth">
          <?php
            if(isset($_COOKIE['username'])){
              echo '<p style="color:white; font-size:15px; font-family: Montserrat, sans-serif;">'.$_COOKIE['username'].'</p><p><a href="logout.php">Выход</a></p>';
            }else{
              echo '<p><a href="login.php">Вход</a></p><p><a href="registration.php">Регистрация</a></p>';
            }
           ?>

        </div>
      </div>
    </div>
  <div>
    <?php
    $q=mysqli_query($link,"SELECT * FROM `orders` WHERE `user_id`='$userid'");
    $count_of_orders=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) as `a` FROM `orders` WHERE `user_id`='$userid'"))['a'];
    while ($order = mysqli_fetch_assoc($q)) {
      $gameid=$order['game_id'];
      $gamename=mysqli_fetch_assoc(mysqli_query($link,"select `name` from `games` where `id`=$gameid"))['name'];
      $orderid=$order['id'];
      $sumOfPrice+=$order['price'];
      echo '<form method="POST" class="center" action="mycart.php"> <p class="text" style="width:auto; margin-bottom:10px; height:auto; color:#595959">' . $gamename . ' Цена:' . $order['price'] . ' </p><input type="hidden" name="delorder" value="'. $orderid .'"><input class="submit" type="submit" value="Удалить из корзины"></form><br>';

    }

    if($count_of_orders==0){
      echo '<p style="color:#595959; margin-left:10%; font-size: 20pt; width:100%">Ваша корзина пуста, сначала добавьте в неё товары </p><br>';
    }else{
      echo '<button type="button" class="submit center" style="width:20%;" name="button"><a href="?buy=1" style="text-decoration:none; color:white;">Купить всё!</a></button>';
      echo '<p class="center" style="color:#595959; font-size: 20pt;">Сумма:' . $sumOfPrice . '</p>';
    }
     ?>
  </body>
</html>
