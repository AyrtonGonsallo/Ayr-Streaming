<?php
include 'backend/dbh.php';
include_once "functions.php";

  $req1 = $bdd->prepare("SELECT max(sid) as max FROM series");
  $req1->execute();
  $res1=$req1->fetch(PDO::FETCH_ASSOC);
  $fin= $res1['max'];
  $debut=$fin -3;

  $req2 = $bdd->prepare("SELECT * FROM series WHERE sid BETWEEN :deb AND :fin");
  $req2->bindValue('deb',$debut, PDO::PARAM_INT);
  $req2->bindValue('fin',$fin, PDO::PARAM_INT);
  $req2->execute();
  
    while($res2=$req2->fetch(PDO::FETCH_ASSOC)){

      echoSerie($res2['name'], $res2['imgpath']);


    }

    ?>
