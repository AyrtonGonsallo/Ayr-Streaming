<?php
session_start();

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>NeonFlix-Homepage</title>
  <link rel="stylesheet" href="css/homepage.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
  <body style='background-color:#000000;color:white;'>
    <header>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="homepage.php" class="navbar-brand"> <img src="images/logo.png" alt=""> </a>
            <span class="navbar-text">NeonFlix</span>

            <ul class="navbar-nav">
              <?php
              if (isset($_SESSION['id'])) {
                if ($_SESSION['id'] == 1) {
                  echo "<li class='nav-item'> <a href='admin.php' class='nav-link'>Add movie</a> </li>";
                  echo "<li class='nav-item'> <a href='admin2.php' class='nav-link'>Add serie</a> </li>";
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
                  $quer2 = $bdd->prepare("SELECT * FROM series WHERE sid in (SELECT sid from user1 where id =:id)");
                  $quer2->bindValue('id',$id, PDO::PARAM_INT);
                  $quer2->execute();
                  $rel2 = $quer2->fetch(PDO::FETCH_ASSOC);

              echo"<h1 style='color:black;'>WELCOME </h1><h1 style = 'color: black;font-size: 25px'> ".ucwords($rel['firstname'])." !</h1>
                  </div>
                  </header>
                  <section>


                <div class='jumbotron' style='margin-top:15px;padding-top:30px;padding-bottom:30px;background-color:#1C1C1C;'>
                <div class='row'>
                  <div class='col'>
                    <form action='movie.php' method='POST'>
                    <h4 style='color:black;font-size:25px;color:white;'>Last series Seen :
                    <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($rel2['name'])."'/></h4>
                    </form>
                  </div>
                  <div class='col'>
                    <form action='search.php' method='POST'>
                    Search by
                      <select  name='option' style='padding:5px;'>
                        <option selected value='keywords'>Keywords</option>
                        <option value='name'>Name</option>
                        <option value='genre'>Genre</option>
                        <option value='rdate'>Release year</option>
                      </select>
                      <input type='text' placeholder='Enter..' name='textoption' style='margin-left:10px;margin-top:10px;padding:5px;'>

                      <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:100px;margin-left:20px;margin-right:20px;margin-top:5px;' value='Search'/></h4>
                    </form>
                  </div>
                </div>
                </div>";
                  ?>
      <div class="jumbotron" style="background-color:#1C1C1C;">
        <h2 style='margin-top:0px;padding-top:0px;color:white;'>Results : </h2>

            <?php
            include 'backend/search_control2.php';
            ?>

      </div>


  </section>
  <footer class="page-footer font-small blue">

    <div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="">ayrtongonsallo444@gmail.com</a>
    </div>

  </footer>
  </body>
</html>
