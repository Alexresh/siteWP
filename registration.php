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
  echo "Ползователь с именем $username и данной почтой уже зарегистрирован";
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
      printf("Заполните поля!");
    }

  }
 ?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Регистрация</title>
  </head>
  <body>
<form action="registration.php" method="post">
  <input type="email" name="email" placeholder="e-mail"><br>
  <input type="text" name="name" placeholder="name"><br>
  <input type="text" name="surname" placeholder="surname"><br>
  <input type="password" name="pass"><br>
  <input type="password" name="confirmpass"><br>
  <input type="text" name="steam" placeholder="your steam"><br>
  <input type="submit" value="зарегистрироваться">
</form>


  </body>
</html>
