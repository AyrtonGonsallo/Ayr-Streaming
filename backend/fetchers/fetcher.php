<?php
include 'backend/dbh.php';
include_once "functions.php";

  $maxaffiches=8;
  @$page=$_GET["page"];
  $i=0;
  $deb=0;
  $fin=$maxaffiches;
    if($page){
      $deb=($page-1)*$maxaffiches;
      $fin=$deb+$maxaffiches;
    }
   
    $req2 = $bdd->prepare("SELECT count(*) as total FROM movies");
  $req2->execute();
    $nombre_de_pages=($req2->fetchAll()[0]["total"])/$maxaffiches;


  $req = $bdd->prepare("SELECT * FROM movies ORDER BY name ASC limit $deb,$maxaffiches ");
  $req->execute();
  
  
echo "<div class='container d-flex justify-content-center'><nav> <ul class='pagination'>";
    for($p=0;$p<=$nombre_de_pages;$p++){
      $num=$p+1;
      echo "<li class='page-item'><a href='?page=$num' class='page-link'>$num</a></li>";
    }
  echo "</ul></nav></div>";

  echo"<div class='row'>";
  
    
    while($result = $req->fetch(PDO::FETCH_ASSOC)){
    
      echoMovie($result['name'], $result['imgpath']);
    
      $i++;
    }
    echo"</div>";




    ?>
