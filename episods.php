<?php
session_start();
if (isset($_POST['submit'])) {

  $title = $_POST['submit'];
  $sid=$_GET['serie'];
  $season=$_GET['season'];
  include 'backend/dbh.php';
  $req = $bdd->prepare("SELECT * FROM series WHERE sid = :sid");
  $req->bindValue('sid',$sid , PDO::PARAM_INT);
  $req->execute();
  $res = $req->fetch(PDO::FETCH_ASSOC);
    
    $req2 = $bdd->prepare("SELECT * FROM episods WHERE sid = :sid and season=:sea");
  $req2->bindValue('sid',$sid , PDO::PARAM_INT);
  $req2->bindValue('sea',$season , PDO::PARAM_INT);
  $req2->execute();


  echo"<!DOCTYPE html>";
  echo"<html lang='en' dir='ltr'>";
    echo"<head>";
      ?>
    <link
            href="https://unpkg.com/video.js@7/dist/video-js.min.css"
            rel="stylesheet"
    />
    <link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">

    <?php
      echo"<meta charset='utf-8'>";
      echo"<title>".$title."</title>";
      echo "<link rel='stylesheet' href='css/movie.css'>";
      echo"<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>";
    echo"</head>";
    echo"<body style='background-color:#000000;color:white;'>";

        
        
            $mname = $res['name'];
            $person = $_SESSION['id'];
            

           
            echo"<a href='homepage.php' style='font-size: 20px;color:orange;border:1px solid orange;border-radius:5px;padding:10px;text-decoration:none;'>Back to Home </a><br>";
            echo "<img src='".ucwords($res['imgpath'])."' height='250' width='200' style='margin-top: 30px;margin-left:30px;margin-right:20px;' />";
          echo "<br></div><h1 style='display: inline;color:#D8D8D8;'>".ucwords($res['name'])."</h1>";
          echo"<br><h5 style='display: inline;color:#D8D8D8;'>All Episods of Season ".$season."</h1><br><br>";
            
        
        while($result = $req2->fetch(PDO::FETCH_ASSOC)){
        
            echo "<div class='jumbotron' style='background-color:#1C1C1C;margin-bottom: 0px;'>
            <form action='serie.php?episod=".$result['id']."' method='POST'>
                    <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($result['name'])."'/>
            </form><br>
            <h4 style='font-size:25px;color:white;'><i style='font-size:35px;' >Viewers: </i> ".ucwords($result['viewers'])."</h4>
            <h4 style='font-size:25px;color:white;'><i style='font-size:35px;' >Runtime: </i> ".ucwords($result['runtime'])."</h4>
            
            </div><br><br>";
         
       


}
}
?>
