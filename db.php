<?php
$db_host='localhost';
$db_user='root';
$db_pass='';
$db_database='mybase_db';
$link = mysqli_connect($db_host,$db_user,$db_pass);
mysqli_select_db($link,$db_database) or exit("бд не робит ".mysqli_error());
$db=null;
$minprice=$_GET['min'];
$maxprice=$_GET['max'];
$maxPriceInDB=mysqli_fetch_assoc(mysqli_query($link,"SELECT MAX(`price`) AS `max` FROM `games`"))['max'];
if(($minprice!='')&&($maxprice!='')){
  $games=mysqli_query($link,"SELECT * FROM `games` WHERE `price`<='$maxprice' AND `price`>='$minprice' ORDER BY `price` ASC");

}else {
  $games=mysqli_query($link,"SELECT * FROM `games`");
}
if (isset($_GET['cat'])){
  $cat=$_GET['cat'];
  $games=mysqli_query($link,"SELECT * FROM `games` WHERE `categories_id`='$cat'");
}

$maxGameId=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) AS 'max' FROM `games`"))['max'];
 ?>
