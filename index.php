  <?php include 'db.php';?>
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="styles.css">
      <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="utf-8">

    </head>

    <body>
        <div class="navbar-fixed">
          <nav>

          <div class="nav-wripper">
           <a href="#" class="brand-logo" style="font-family:'Lobster', bolt;">ProstoGames</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php
              if(isset($_COOKIE['username'])){
                echo "<li>Здравствуйте, " . $_COOKIE['username'] . "</li>";
              }
             ?>
            <li><a href="#"><i class="large material-icons left">shopping_cart</i> </a> </li>
            <li><a href="login.php"><i class="large material-icons left">account_circle</i> </a> </li>
            <li><a href="registration.php"><i class="large material-icons left">account_circle</i> </a></li>
          </ul>
         </div>

      </nav>
     </div>
     <div class="row">
       <div class="col l2 sidebar ">
        <form class="game-list" action="#" method="post">
          <legend>Категории</legend>
            <ul>
              <?php
              if (mysqli_num_rows($categories)>0) {
                $row = mysqli_fetch_assoc($categories);
                do {
                  echo '<li><a class="filter" href="#">'.$row["name"].'</a></li>';
                } while ($row = mysqli_fetch_assoc($categories));
              }
               ?>
            </ul>
            <div class="divider"></div>
            <p>Фильтр</p>
            <form action="index.php" method="post">
              <legend>Цена</legend>
              <p class="range-field">
                <input type="range"  name="range" min="0" max="<?php echo "$maxprice"; ?>" />
                <button class="btn" type="submit" name="button">Показать</button>
              </p>
            </form>
        </form>
       </div>
       <div class="col l10">
         <?php
         for($m=0; $m<$maxGameId / 4; $m++){ ?>
         <div class="row">
          <?php
            for ($i=0; $i < 4 ; $i++) {
              $game=mysqli_fetch_assoc($games);
              if((isset($game))){
          ?>
          <div class="col s3">
            <div class="card">
              <div class="card-image">
                <img src="img/<?php echo $game['image']?>">
                <span class="card-title"><?php echo $game['name']?></span>
              </div>
              <div class="card-content">
                <p><?php $game['smallDescriptions']?> Цена - <?php echo $game['price']?></p>
              </div>
            </div>
          </div>
        <?php }} ?>
        </div>
      <?php } ?>






      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <?php
        $email=$_COOKIE["useremail"];
        if(isset($email)){
        echo '<a href="logout.php">Выйти</a> <br>';
        $q=mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email' AND `isAdmin`='1'");
        $user=mysqli_fetch_assoc($q);
        if(count($user)!=0)
          echo '<a href="admin.php">Админ-панель</a>';
        }
      ?>
    </body>
  </html>
