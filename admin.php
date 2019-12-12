<?php
require 'db.php';
$email=$_COOKIE["useremail"];
$q=mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email' AND `isAdmin`='1'");
$user=mysqli_fetch_assoc($q);
if(count($user)==0):
  header("Location: /");
else:?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Админ-панель</title>
  </head>
  <body>
    <div style="float:left;padding: 10px; border:1px black solid;">
      <p>Добавление товара:</p>
      <form action="admin.php" method="post">
        <p>Название игры(до 50 символов):</p><input type="text" name="name">
        <p>Небольшое описание(до 255 символов):</p><textarea name="smallDescriptions" rows="8" cols="50"></textarea>
        <p>Полное описание(до 500 символов):</p><textarea name="descriptions" rows="8" cols="50"></textarea>
        <p>Год выпуска:</p><input type="number" name="year" value="2019">
        <p>Платформы(до 100 символов):</p><input type="text" name="platforms">
        <p>Путь до картинки:</p><input type="text" name="image" value="/img/">
        <p>Цена:</p><input type="number" name="price">
        <p>Категория:</p><input type="number" name="categories_id" value="1">
        <p style="font-size:15px">1-Экшен; 2-Аркады; 3-Симуляторы; 4-Стратегии;<br> 5-Приключения; 6-Музыкальные игры; <br>7-Ролевые игры; 8-Головоломки</p>
        <input type="submit" value="Добавить игру">
      </form>
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
  </body>
</html>
<?php endif; ?>
