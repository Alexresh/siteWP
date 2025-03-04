<?php
  require 'db.php';
  if(isset($_POST['email'])){
    $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $surname=filter_var(trim($_POST['surname']),FILTER_SANITIZE_STRING);
    $pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $cpass=filter_var(trim($_POST['confirmpass']),FILTER_SANITIZE_STRING);
    $steam=filter_var(trim($_POST['steam']),FILTER_SANITIZE_STRING);
$query=mysqli_query($link,"SELECT `name` AS `name` FROM `users` WHERE `email`='$email'");
$username=mysqli_fetch_assoc($query)['name'];
if(mb_strlen($username)>0){
  echo "Пользователь с именем $username и данной почтой уже зарегистрирован";
  exit();
}
if($pass!=$cpass){
  echo "Пароли не совпадают";
  exit();
}
    if((mb_strlen($pass)>3) && (mb_strlen($pass)<12)&&(mb_strlen($name)!=0)&&(mb_strlen($steam)!=0)&&(mb_strlen($email)!=0)){
      $pass = md5('gg'.$pass.'wp');
      mysqli_query($link, "INSERT INTO `users`(`email`,`steamid`,`name`,`surname`,`pass`) VALUES('$email','$steam','$name','$surname','$pass')");
      header("Location: /login.php");
    }else{
      $error='!';
    }

  }
 ?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Регистрация</title>
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
    <form class="center" action="registration.php" method="post">
      <?php
      if($error=='!'){
        echo '<p class="text" style="width:100%; color:#595959">Заполните поля</p><br>';
      }
       ?>
      <p class="text" style="height:20px; color:#595959">E-mail:</p><input class="input" type="email" name="email"><br>
      <p class="text" style="height:20px; color:#595959">Имя:</p><input class="input" type="text" name="name"><br>
      <p class="text" style="height:20px; color:#595959">Фамилия:</p><input class="input" type="text" name="surname"><br>
      <p class="text" style="height:20px; color:#595959">Пароль:</p><input class="input" type="password" name="pass"><br>
      <p class="text" style="height:20px; color:#595959">Подтверждение:</p><input class="input" type="password" name="confirmpass"><br>
      <p class="text" style="height:20px; color:#595959">Steam id:</p><input class="input" type="text" name="steam"><br>
      <input class="submit" type="submit" value="Зарегистрироваться">

      <div style="margin-top:30px"></div>
    </form>
  </body>
</html>
