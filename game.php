<?php
  require("db.php");
  $gameid=$_GET['game'];
  if(!isset($gameid)){
    header("Location: /");
  }

?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ProstoGames</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
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
      <div style="float:left; margin:20px 0px 0px 20px; width:25%">
        <?php
            $q=mysqli_query($link,"SELECT * FROM `games` WHERE `id`='$gameid'");
            $gameArr=mysqli_fetch_assoc($q);
            if(!isset($gameArr)){
              echo "<span style='width:100%; text-align:center; position:absolute;color:black; font-size:25pt;'>404 page Not Found</span>";
              exit();
            }

            $gamename=$gameArr['name'];
            $gameid=$gameArr['id'];
            $description=$gameArr['descriptions'];
            $year=$gameArr['year'];
            $platform=$gameArr['platforms'];
            $price=$gameArr['price'];
            $_cat=$gameArr['categories_id'];
            $Gimg=$gameArr['image'];

            echo '<img width="100%" height="auto" src="img/' . $Gimg . '"></div>';
            $category=mysqli_fetch_assoc(mysqli_query($link,"SELECT `name` FROM `categories` WHERE `id`='$_cat'"))['name'];
            echo "<div class='container'>$gamename<br>$description<br>Год выпуска:$year<br>Платформы:$platform<br>Цена:$price ₽<br>Категория:$category<div>";
            echo '<form action="addtocart.php" method="post">';
            echo '<input type="hidden" name="gameid" value="'. $gameid .'">
              <input type="submit" class="submit" style="width:15%; margin:10px;" name="" value="В корзину"></form>';
         ?>

    </body>
</html>
