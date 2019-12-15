<?php require 'db.php';
$current_category=$_GET['cur_cat'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>ProstoGames</title>
    <script type="text/javascript" src="js/scripts.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <div class="inner-header">
          <div class="logo">
            <a href="/" style="color:white;"><p>ProstoGames</p></a>
          </div>
          <div class="nav">
            <ul>
              <li ="menu-item">
                <a href="#" id="hovered" onclick="ShowList()">Каталог</a>
                <ul id="submenu" style="position:relative;">
                  <li  class="submenu-item"> <a href="?cat=1">Экшн</a> </li>
                  <li  class="submenu-item"> <a href="?cat=2">Аркады</a> </li>
                  <li  class="submenu-item"> <a href="?cat=8">Головоломки</a> </li>
                  <li  class="submenu-item"> <a href="?cat=4">Стратегии</a> </li>
                  <li  class="submenu-item"> <a href="?cat=5">Приключения</a> </li>
                  <li  class="submenu-item"> <a href="?cat=6">Музыкальные игры</a> </li>
                  <li  class="submenu-item"> <a href="?cat=7">Ролевые игры</a> </li>
                  <li  class="submenu-item"> <a href="?cat=3">Симуляторы</a> </li>
                  <li style="height:25px;" onclick="closeList()">&#8593; свернуть</li>
                </ul>
              </li>
              <li class="menu-item"> <a id="hovered" href="mycart.php">Корзина</a> </li>
            </ul>
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
      <div class="row">
        <div class="sidebar">
          <div class="inner-side">
            <form class="form1" action="index.php" method="get">
              <span style="  font-family: 'Montserrat', sans-serif;">Категории</span>
              <ul id="categories">
                <li> <a href=""><span>Все игры</span></a></li>
                <li><a href="?cat=1"><span>Экшен</span></a></li>
                <li><a href="?cat=2"><span>Аркады</span></a></li>
                <li><a href="?cat=3"><span>Симуляторы</span></a></li>
                <li><a href="?cat=4"><span>Стратегии</span></a></li>
                <li><a href="?cat=5"><span>Приключения</span></a></li>
                <li><a href="?cat=6"><span>Музыкальные игры</span></a></li>
                <li><a href="?cat=7"><span>Ролевые игры</span></a></li>
                <li><a href="?cat=8"><span>Головоломки</span></a></li>
              </ul>
              <p style="font-family: 'Montserrat', sans-serif;">Фильтр</p>
              <table style="width:100%;">
                <tr>
                  <td colspan="2" style="  font-family: 'Montserrat', sans-serif;">Цена:</td>
                </tr>
                <tr><td style="font-family: 'Montserrat', sans-serif;">От:</td> <td style="font-family:'Montserrat', sans-serif;">До:</td>  </tr>
                <tr>
                  <td>
                    <input type="number" name="min" value="<?php if($minprice!='') echo $minprice; else echo '0'?>"  id="inp1">
                  </td>
                  <td>
                    <input type="number" name="max" value="<?php if($maxprice!='') echo $maxprice; else echo $maxPriceInDB?>"  id="inp2">
                  </td>
                </tr>
                <tr>
                  <td> <input type="submit" value="Показать"  class="submit" ></td>
                  <td> <input type="reset" value="Очистить" id="res"> </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
        <div class="main">
          <div class="inner-main">
            <div class="all">
		<input checked type="radio" name="respond" id="desktop">
			<article id="slider">
					<input checked type="radio" name="slider" id="switch1">
					<input type="radio" name="slider" id="switch2">
					<input type="radio" name="slider" id="switch3">
					<input type="radio" name="slider" id="switch4">
					<input type="radio" name="slider" id="switch5">
				<div id="slides">
					<div id="overflow">
						<div class="image">
							<article><img src="img/2.jpg"></article>
							<article><img src="img/1.jpg"></article>
							<article><img src="img/3.jpg"></article>
							<article><img src="img/4.jpg"></article>
							<article><img src="img/5.jpg"></article>
						</div>
					</div>
				</div>
				<div id="controls">
					<label for="switch1"></label>
					<label for="switch2"></label>
					<label for="switch3"></label>
					<label for="switch4"></label>
					<label for="switch5"></label>
				</div>
				<div id="active">
					<label for="switch1"></label>
					<label for="switch2"></label>
					<label for="switch3"></label>
					<label for="switch4"></label>
					<label for="switch5"></label>
				</div>
			</article>
        <div class="marg">

        </div>
	       </div>
         <?php
          for($m=0; $m<$maxGameId / 5; $m++){
            for ($i=0; $i < 5 ; $i++) {
              $game=mysqli_fetch_assoc($games);
              if((isset($game))){
                echo '
                <form action="addtocart.php" method="post">
                <input type="hidden" name="gameid" value="'. $game['id'] .'">
                <div class="card">
                   <div class="inner-card">
                     <div class="imgCard">
                      <img src="img/' . $game['image'] .'" width="100%" height="100%">
                      <p><b>' . $game['name'] . '</b></p>
                      </div>
                      <p>' .$game['smallDescriptions']. '</p>
                      <p>Цена:<span>'. $game['price'].'</span></p>
                      <div class="">
                        <input type="submit" name="" value="В корзину">
                      </div>
                   </div>
                 </div>
                 </form>
                ';
              }

              }
            }
         ?>

         <div style="clear:both;"></div>
          </div>
        </div>

      </div>
      <div class="footer">
        <div class="inner-footer">
          <p>	&copy; cвязаться с нами&emsp;<span onclick="gotoSanya()">Алексеев.А.А.</span>&emsp;<span onclick="gotoVaness()">Рыжаев И.В.</span >&emsp;</p>
          <?php
            $userid=$_COOKIE["userid"];
            if(isset($userid)){
            $q=mysqli_query($link,"SELECT * FROM `users` WHERE `id`='$userid' AND `isAdmin`='1'");
            $user=mysqli_fetch_assoc($q);
            if(count($user)!=0)
              echo '<a href="admin.php">Админ-панель</a>';
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
