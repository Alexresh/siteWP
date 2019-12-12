<?php require 'db.php';
  if((isset($_POST['email']))&&(isset($_POST['pass']))){
    $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $pass = md5("gg".$pass."wp");
    $query = mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$pass'");
    $user = mysqli_fetch_assoc($query);
    if(count($user)==0){
      echo "Такой пользователь не найден!";
      exit();
    }
    setcookie('userid',$user['id'],time()+3600,"/");
    setcookie('username',$user['name'],time()+3600,"/");
    header('Location: /');
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Вход</title>
  </head>
  <body>
    <form action="login.php" method="post">
      <input type="email" name="email" placeholder="e-mail"><br>
      <input type="password" name="pass"><br>
      <input type="submit" value="Войти">
    </form>
    <a href="/">Назад</a>
  </body>
</html>
