<?php
include 'backend/dbh.php';
include_once "functions.php";

  $req1 = $bdd->prepare("SELECT max(mid) as max FROM movies");
  $req1->execute();
  $res1=$req1->fetch(PDO::FETCH_ASSOC);
  $fin= $res1['max'];
  $debut=$fin -3;

  $req2 = $bdd->prepare("SELECT * FROM movies WHERE mid BETWEEN :deb AND :fin");
  $req2->bindValue('deb',$debut, PDO::PARAM_INT);
  $req2->bindValue('fin',$fin, PDO::PARAM_INT);
  $req2->execute();
  
    while($res2=$req2->fetch(PDO::FETCH_ASSOC)){

      echoMovie($res2['name'], $res2['imgpath']);


    }

    ?>
