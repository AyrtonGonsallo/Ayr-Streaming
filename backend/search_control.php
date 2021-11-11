<?php
include 'dbh.php';
include 'fetchers/functions.php';
if(isset($_POST['submit'])){

    $option = $_POST['option'];
    $text =  strtolower($_POST['textoption']);
    $person = $_SESSION['id'];
    if($option!="keywords" &&$option!="Keywords"){
      $sql="SELECT * FROM movies WHERE ".$option." LIKE '%".$text."%'";
      $req = $bdd->prepare($sql);
      $req->execute();

      start:
      $i=0;
      echo"<div class='row'>";
        while($final = $req->fetch(PDO::FETCH_ASSOC)){
          
          echoMovie($final['name'], $final['imgpath']);

          if ($i==4) {
            
            echo"</div>";

            goto start;
          }
          $i++;
        }
        echo"</div>";

    }
    else{
      $sql="SELECT * FROM movies WHERE keywords_fr LIKE '%".$text."%' or keywords_en LIKE '%".$text."%'";
      $req = $bdd->prepare($sql);
      $req->execute();

      start1:
      $i=0;
      echo"<div class='row'>";
        while($final = $req->fetch(PDO::FETCH_ASSOC)){
          
          echoMovie($final['name'], $final['imgpath']);

          if ($i==4) {
            
            echo"</div>";

            goto start1;
          }
          $i++;
        }
        echo"</div>";

      }
    
  }


 ?>
