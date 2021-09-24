<?php
include 'backend/dbh.php';
include_once "functions.php";

  $req = $bdd->prepare("SELECT * FROM movies ORDER BY name ASC");
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




    ?>
