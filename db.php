<?php
$db_host='localhost';
$db_user='user';
$db_pass='mfqepLs6TP0PivNj';
$db_database='mybase_db';
$link = mysqli_connect($db_host,$db_user,$db_pass);
mysqli_select_db($link,$db_database) or exit("бд не робит ".mysqli_error());
$db=null;
$db=mysqli_query($link,"SELECT MAX(`price`)AS `MAX` FROM `games`");
$maxprice=mysqli_fetch_assoc($db)['MAX'];
if((isset($_POST['range']))){
  $maxpricenew=$_POST['range'];
}else{$maxpricenew=$maxprice;}

$categories=mysqli_query($link,"SELECT * FROM `categories`");
$sort='ASC';
$games=mysqli_query($link,"SELECT * FROM `games` WHERE `price`<=$maxpricenew  ORDER BY `price` $sort");
$maxGameId=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) AS 'max' FROM `games`"))['max'];
 ?>
