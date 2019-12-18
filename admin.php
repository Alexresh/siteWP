<?php
require 'db.php';
$userid=$_COOKIE["userid"];
if(!isset($userid)) $userid=-1;
$q=mysqli_query($link,"SELECT * FROM `users` WHERE `id`='$userid' AND `isAdmin`='1'");
$user=mysqli_fetch_assoc($q);
if(count($user)==0):
  header("Location: /");
else:?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Админ-панель</title>
  </head>
  <body>
    <div class="wrapper">
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
    <div style="float:left;padding: 10px; border:1px black solid;">
      <p>Добавление товара:</p>
      <form action="admin.php" method="post">
        <p>Название игры(до 50 символов):</p><input type="text" name="name">
        <p>Небольшое описание(до 255 символов):</p><textarea name="smallDescriptions" rows="8" cols="50"></textarea>
        <p>Полное описание(до 500 символов):</p><textarea name="descriptions" rows="8" cols="50"></textarea>
        <p>Год выпуска:</p><input type="number" name="year" value="2019">
        <p>Платформы(до 100 символов):</p><input type="text" name="platforms">
        <p>Название картинки:</p><input type="text" name="image" value="">
        <p>Цена:</p><input type="number" name="price">
        <p>Категория:</p><input type="number" name="categories_id" value="1">
        <p style="font-size:15px">1-Экшен; 2-Аркады; 3-Симуляторы; 4-Стратегии;<br> 5-Приключения; 6-Музыкальные игры; <br>7-Ролевые игры; 8-Головоломки</p>
        <input type="submit" value="Добавить игру">
      </form>
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <p>Загрузка картинки на сайт:</p>
        <input type="file" name="upload">
        <button>Загрузить</button>
      </form>
      <?php
        $filePath  = $_FILES['upload']['tmp_name'];
        if(isset($filePath)){
          if (!move_uploaded_file($filePath, __DIR__ . '/img/' . $_FILES['upload']['name'])) {
            die('При записи изображения на диск произошла ошибка.');
          }
        }
      ?>
    </div>
    <?php
      if (isset($_POST["name"])) {
        $name=$_POST['name'];
        $smallDescriptions=$_POST['smallDescriptions'];
        $descriptions=$_POST['descriptions'];
        $year=$_POST['year'];
        $platforms= $_POST['platforms'];
        $image=$_POST['image'];
        $price=$_POST['price'];
        $categories_id=$_POST['categories_id'];
        mysqli_query($link,"INSERT INTO `games` VALUES(NULL,'$name','$smallDescriptions','$descriptions','$year','$platforms','$image','$price','$categories_id')");
        echo mysqli_error($link);
      }
     ?>
    <div style="float:left; padding: 10px; border:1px black solid; margin-left:50px;">
      <p>Удаление товара:</p>
      <form action="admin.php" method="post">
       <p>Поиск id:</p>
       <input type="text" name="searchname" placeholder="Примерное название игры">
       <input type="submit" value="Найти">
      </form>
      <br>
      <?php
        if(isset($_POST['searchname'])){
          $searchname=$_POST['searchname'];
          $q=mysqli_query($link,"SELECT `id`, `name` FROM `games` WHERE `name` LIKE '%$searchname%'");
          while ($sgame = mysqli_fetch_assoc($q)) {
            echo "<p>" . $sgame['name'] . " id:" . $sgame['id'] . "</p>";
          }
        }
       ?>
       <form action="admin.php" method="post">
         <input type="number" name="delid" placeholder="id для удаления">
         <input type="submit" value="Удалить">
       </form>
       <?php
        if(isset($_POST['delid'])){
          $delid=$_POST['delid'];
          mysqli_query($link,"DELETE FROM `games` WHERE `id`='$delid'");
        }
        ?>
    </div>
    <div style="padding:10px; margin-left:15px; float:left; border:1px solid">
      <form action="admin.php" method="post">
        <p>Редактирование:</p>
        <p>Введите название:</p>
        <input type="text" name="itemname">
        <input type="submit" value="Показать данные">
        <?php
          if(isset($_POST['itemname'])){
            $kk=$_POST['itemname'];
            $newItem=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `games` WHERE `name`='$kk'"));
            echo '
              <input type="number" name="uid" hidden value="'.$newItem['id'].'">
              <p>Имя:<input type="text" name="Uname" value="'.$newItem['name'].'"></p>
              <p>Небольшое описание:<textarea name="UsmallDescriptions" rows="8" cols="30">'.$newItem['smallDescriptions'].'</textarea></p>
              <p>Описание:<textarea name="Udescriptions" rows="8" cols="30">'.$newItem['descriptions'].'</textarea></p>
              <p>Год:<input type="number" name="Uyear" value="'.$newItem['year'].'"></p>
              <p>Платформы:<input type="text" name="Uplatforms" value="'.$newItem['platforms'].'"></p>
              <p>Картинка:<input type="text" name="Uimage" value="'.$newItem['image'].'"></p>
              ';
              $dir = "img";
              $images=array_slice(scandir($dir),2);
              foreach ($images as $key) {
                echo '<img src="img/'.$key.'" width="70px"><span>'.$key.'</span><br>';
              }
              echo '
              <p>Цена:<input type="number" name="Uprice" value="'.$newItem['price'].'"></p>
              <p>Категория:<input type="number" name="Ucategories_id" value="'.$newItem['categories_id'].'"></p>
              <p style="font-size:15px">1-Экшен; 2-Аркады; 3-Симуляторы; 4-Стратегии;<br> 5-Приключения; 6-Музыкальные игры; <br>7-Ролевые игры; 8-Головоломки</p>
              <input type="submit" value="Обновить">';
          }
        ?>


      </form>
      <?php
        if(isset($_POST['Uname'])){
          $uid=$_POST['uid'];
          $uname=$_POST['Uname'];
          $usmallDescriptions=$_POST['UsmallDescriptions'];
          $udescriptions=$_POST['Udescriptions'];
          $uyear=$_POST['Uyear'];
          $uplatforms=$_POST['Uplatforms'];
          $uimage=$_POST['Uimage'];
          $uprice=$_POST['Uprice'];
          $ucatgories_id=$_POST['Ucategories_id'];
          mysqli_query($link,"UPDATE `games` SET `name`='$uname',
                                           `smallDescriptions`='$usmallDescriptions',
                                           `descriptions`='$udescriptions',
                                           `year`='$uyear',
                                           `platforms`='$uplatforms',
                                           `image`='$uimage',
                                           `price`='$uprice',
                                           `categories_id`='$ucatgories_id'  WHERE `id`='$uid'");
        }
       ?>
    </div>

  </body>
</html>
<?php endif; ?>
