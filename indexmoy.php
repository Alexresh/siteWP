
  <?php include 'db.php'; ?>
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
         <div class="container">
          <div class="nav-wripper">
           <a href="#" class="brand-logo" style="font-family:'Lobster', bolt;">ProstoGames</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#">ссылка 1</a> </li>
            <li><a href="#">ссылка 2</a> </li>
            <li><a href="#">ссылка 3</a> </li>
          </ul>
         </div>
        </div>
      </nav>
     </div>
     <div class="row">
       <div class="col s12 m4 l2">
        <form class="game-list" action="index.php" method="post">
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
            <form action="#">
              <legend>Цена</legend>
              <p class="range-field">
                <input type="range" id="test5" min="0" max="2000" />
              </p>
            </form>
        </form>



       </div>
       <div class="col s12 m4 l2">
         <div class="card">
           <div class="card-image">
             <img src="img/1.jpg" alt="">
             <span class="card-title">Игрушка 1</span>
           </div>
           <div class="card-content">
             <p>это самая крутая игра под номером 1. Цена - 1000р</p>
           </div>
         </div>
         </div>
         <div class="col s12 m4 l2">
           <div class="card">
             <div class="card-image">
               <img src="img/1.jpg" alt="">
               <span class="card-title">Игрушка 1</span>
             </div>
             <div class="card-content">
               <p>это самая крутая игра под номером 2. Цена - 2000р</p>
             </div>
           </div>
           </div>
           <div class="col s12 m4 l2">
             <div class="card">
               <div class="card-image">
                 <img src="img/1.jpg" alt="">
                 <span class="card-title">Игрушка 3</span>
               </div>
               <div class="card-content">
                 <p>это самая крутая игра под номером 3. Цена - 1000р</p>
               </div>
             </div>
             </div>
             <div class="col s12 m4 l2">
               <div class="card">
                 <div class="card-image">
                   <img src="img/1.jpg" alt="">
                   <span class="card-title">Игрушка 4</span>
                 </div>
                 <div class="card-content">
                   <p>это самая крутая игра под номером 4. Цена - 1000р</p>
                 </div>
               </div>
               </div>
     </div>
     <div class="row">
       <div class="col s12 m4 l2">
         <div class="card">
           <div class="card-image">
             <img src="img/1.jpg" alt="">
             <span class="card-title">Игрушка 4</span>
           </div>
          <div class="card-content">
            <p>это самая крутая игра под номером 4. Цена - 1000р</p>
          </div>
         </div>
       </div>
       <div class="col s12 m4 l2">
         <div class="card">
           <div class="card-image">
             <img src="img/1.jpg" alt="">
             <span class="card-title">Игрушка 4</span>
           </div>
           <div class="card-content">
             <p>это самая крутая игра под номером 4. Цена - 1000р</p>
           </div>
         </div>
       </div>
       <div class="col s12 m4 l2">
        <div class="card">
          <div class="card-image">
            <img src="img/1.jpg" alt="">
              <span class="card-title">Игрушка 4</span>
          </div>
          <div class="card-content">
            <p>это самая крутая игра под номером 4. Цена - 1000р</p>
          </div>
         </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card">
            <div class="card-image">
              <img src="img/1.jpg" alt="">
              <span class="card-title">Игрушка 4</span>
            </div>
            <div class="card-content">
              <p>это самая крутая игра под номером 4. Цена - 1000р</p>
            </div>
          </div>
         </div>
     </div>





      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
