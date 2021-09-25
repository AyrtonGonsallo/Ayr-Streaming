<?php
session_start();

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head style='background-color:#000000;'>
  <meta charset="utf-8">
  <title>NeonFlix-Homepage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
    function sortMovies() {

        selected_genre = document.getElementById('genre').selectedIndex;
        genre = document.getElementById('genre')[selected_genre].value;
        condition = '';
        if (genre != '') {
            if (condition == '') {
                condition += '?genre=' + genre;
            } 
        }
        
        if (condition != '') {
            // alert("condition : "+condition);
            window.location.href = '/homepage.php' + condition;
        } else {
            // alert("rien");
            
        }
    }
    function sortSeries() {

selected_genre = document.getElementById('genre2').selectedIndex;
genre = document.getElementById('genre2')[selected_genre].value;
condition = '';
if (genre != '') {
    if (condition == '') {
        condition += '?genre2=' + genre;
    } 
}

if (condition != '') {
    // alert("condition : "+condition);
    window.location.href = '/homepage.php' + condition;
} else {
    // alert("rien");
    
}
}
    </script>


    <link rel="stylesheet" href="css/homepage.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" /> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
  <body style='background-color:#000000;color:white;' onload="get_genres()">
    <header>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="#" class="navbar-brand"> <img src="images/logo.png" alt=""> </a>
            <span class="navbar-text">NeonFlix</span>

            <ul class="navbar-nav">
              <?php
              if (isset($_SESSION['admin'])) {
                if ($_SESSION['admin'] == 1) {
                  echo "<li class='nav-item'> <a href='admin.php' class='nav-link'>Add movie</a> </li>";
                  echo "<li class='nav-item'> <a href='admin2.php' class='nav-link'>Add serie</a> </li>";
                  echo "<li class='nav-item'> <a href='admin4.php' class='nav-link'>Add season</a> </li>";
                  echo "<li class='nav-item'> <a href='admin3.php' class='nav-link'>Add episode</a> </li>";
                }
              }
              echo "<li class='nav-item'> <a href='account_details.php' class='nav-link'>Account</a> </li>

                  <li class='nav-item'> <a href='backend/logout.php' class='nav-link'>Logout</a> </li>
                  
                  </ul>
                  </nav>
                  <div class='container-fluid'>
                  <br><br><br>";
                  include 'backend/dbh.php';
                  $id = $_SESSION['id'];
                  $quer = $bdd->prepare("SELECT * FROM user1 WHERE id =:id");
                  $quer->bindValue('id',$id, PDO::PARAM_INT);
                  $quer->execute();
                  $rel = $quer->fetch(PDO::FETCH_ASSOC);
                  $quer2 = $bdd->prepare("SELECT * FROM movies WHERE mid in (SELECT mid from user1 where id =:id)");
                  $quer2->bindValue('id',$id, PDO::PARAM_INT);
                  $quer2->execute();
                  $rel2 = $quer2->fetch(PDO::FETCH_ASSOC);

                  $quer3 = $bdd->prepare("SELECT * FROM series WHERE sid in (SELECT sid from user1 where id =:id)");
                  $quer3->bindValue('id',$id, PDO::PARAM_INT);
                  $quer3->execute();
                  $rel3 = $quer3->fetch(PDO::FETCH_ASSOC);

                  $quer4 = $bdd->prepare("SELECT * FROM episods WHERE id in (SELECT eid from user1 where id =:id)");
                  $quer4->bindValue('id',$id, PDO::PARAM_INT);
                  $quer4->execute();
                  $rel4 = $quer4->fetch(PDO::FETCH_ASSOC);

                  $quer5 = $bdd->prepare("SELECT * FROM series WHERE sid =:sid");
                  $quer5->bindValue('sid',$rel4['sid'], PDO::PARAM_INT);
                  $quer5->execute();
                  $rel5 = $quer5->fetch(PDO::FETCH_ASSOC);

              echo"<h1 style='color:black;position:sticky;'>WELCOME <i style = 'color: black;font-size: 25px'> ".ucwords($rel['firstname'])." !</i></h1>
                  </div>
                  </header>
                  <section>

                  
                <div class='jumbotron' style='margin-top:15px;padding-top:30px;padding-bottom:30px;background-color:#1C1C1C;'>
                <div class='row'>
                  <div class='col'>
                    <form action='movie.php' method='POST'>
                    <h4 style='font-size:25px;color:white;'>Last Movie Seen :
                    <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($rel2['name'])."'/></h4>
                    </form>
                  </div>
                  <div class='col'>
                    <form action='search.php' method='POST'>
                    Search Movies by
                    <select  name='option' style='padding:5px;'>
                      <option selected>Keywords</option>
                      <option value='name'>Name</option>
                      <option value='genre'>Genre</option>
                      <option value='rdate'>Release year</option>
                    </select>
                      <input type='text' placeholder='Enter..' style='margin-left:10px;margin-top:10px;padding:5px;' name='textoption'>

                      <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:100px;margin-left:20px;margin-right:20px;margin-top:5px;' value='Search'/></h4>
                    </form>
                  </div>
                </div>

                <div class='row'>
                  <div class='col'>
                    <form action='seasons.php' method='POST'>
                    <h4 style='font-size:25px;color:white;'>Last Serie Seen :
                    <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($rel3['name'])."'/></h4>
                    </form>
                  </div>
                  <div class='col'>
                    <form action='search2.php' method='POST'>
                    Search Series by
                    <select  name='option' style='padding:5px;'>
                      <option selected>Keywords</option>
                      <option value='name'>Name</option>
                      <option value='genre'>Genre</option>
                      <option value='rdate'>Release year</option>
                    </select>
                      <input type='text' placeholder='Enter..' style='margin-left:10px;margin-top:10px;padding:5px;' name='textoption'>

                      <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:100px;margin-left:20px;margin-right:20px;margin-top:5px;' value='Search'/></h4>
                    </form>
                  </div>
                </div>

                <div class='col'>
                <form action='serie.php?episod=".$rel4['id']."' method='POST'>
                <h4 style='font-size:25px;color:white;'>Last Episod Seen :
                <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($rel5['name'])." ".ucwords($rel4['name'])."'/></h4>
                </form>
              </div>
                </div>";
                  ?>
      <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style='margin-top:0px;padding-top:0px;color:white;'>All movies</h2>
          <div class="row">
            <?php
              include 'backend/fetchers/fetcher.php';
             ?>
          </div>
      </div>

      <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style='margin-top:0px;padding-top:0px;color:white;'>All series</h2>
          <div class="row">
            <?php
              include 'backend/fetchers/fetcher2.php';
             ?>
          </div>
      </div>

      <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style="color:white;">Filter Movies by Genre</h2>
          <div id="genre_select" >
          <form action="" method="post" class="form-inline" role="form">
              <select name='genre' id="genre">
                <?php 
                $req3 = $bdd->prepare("SELECT DISTINCT(genre) as genre FROM movies ");
                $req3->execute();
                while($result = $req3->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='".$result['genre']."'>".$result['genre']."</option>";
                }
                 ?>
              </select>
              <button type="button" onclick="sortMovies();" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </form>
          </div>
          <div id="genre_div" class="row">
          <?php
              if(isset($_GET["genre"])){
                $genre =  $_GET["genre"];
                $req = $bdd->prepare("SELECT * FROM movies WHERE genre = :genre ORDER BY name ASC ");
                $req->bindValue('genre',$genre, PDO::PARAM_STR);
                $req->execute();
                start:
                $i=0;

                echo"<div class='row'>";
                while($result = $req->fetch(PDO::FETCH_ASSOC)){

                  echoMovie($result['name'], $result['imgpath']);

                  if ($i==4) {

                    echo"</div>";

                    goto start;
                  }
                  $i++;
                }
                echo"</div>";
              }
             ?>
          </div>

      </div>

      <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style="color:white;">Filter Series by Genre</h2>
          <div id="genre_select" >
          <form action="" method="post" class="form-inline" role="form">
              <select name='genre' id="genre2">
                <?php 
                $req3 = $bdd->prepare("SELECT DISTINCT(genre) as genre FROM series ");
                $req3->execute();
                while($result = $req3->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value='".$result['genre']."'>".$result['genre']."</option>";
                }
                 ?>
              </select>
              <button type="button" onclick="sortSeries();" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </form>
          </div>
          <div id="genre_div" class="row">
          <?php
              if(isset($_GET["genre2"])){
                $genre2 =  $_GET["genre2"];
                $req = $bdd->prepare("SELECT * FROM series WHERE genre = :genre ORDER BY name ASC ");
                $req->bindValue('genre',$genre2, PDO::PARAM_STR);
                $req->execute();
                start2:
                $i=0;

                echo"<div class='row'>";
                while($result = $req->fetch(PDO::FETCH_ASSOC)){

                  echoSerie($result['name'], $result['imgpath']);

                  if ($i==4) {

                    echo"</div>";

                    goto start2;
                  }
                  $i++;
                }
                echo"</div>";
              }
             ?>
          </div>

      </div>


    <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style='margin-top:0px;padding-top:0px;color:white;'>Latest Movies uploaded</h2>
        <div class="row">
            <?php
            include 'backend/fetchers/latest-fetcher.php';
            ?>
        </div>
    </div>

    <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style='margin-top:0px;padding-top:0px;color:white;'>Latest Series uploaded</h2>
        <div class="row">
            <?php
            include 'backend/fetchers/latest-fetcher2.php';
            ?>
        </div>
    </div>
  </section >
  <footer class="page-footer font-small blue" >

    <div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="">ayrtongonsallo444@gmail.com</a>
    </div>

  </footer>
  </body>
</html>
