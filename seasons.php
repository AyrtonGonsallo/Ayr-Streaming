<?php
session_start();
if (isset($_POST['submit'])) {

  $title = $_POST['submit'];

  include 'backend/dbh.php';
  $req = $bdd->prepare("SELECT * FROM series WHERE name = :title");
  $req->bindValue('title',$title , PDO::PARAM_STR);
  $req->execute();
  $res = $req->fetch(PDO::FETCH_ASSOC);
    $sid=$res['sid'];
  $req2 = $bdd->prepare("SELECT * FROM seasons WHERE sid = :sid");
  $req2->bindValue('sid',$sid , PDO::PARAM_INT);
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
          echo"<br><h5 style='display: inline;color:#B8B8B8;'>".ucfirst($res['description'])."</h5>";
          echo"<br><br><h5 style='display: inline;color:#B8B8B8;'><u5 style='color:orange;' >genre:</u5> ".ucfirst($res['genre'])."</h5>";
          echo"<br><h5 style='display: inline;color:#B8B8B8;'><u5 style='color:orange;' >release date:</u5> ".ucfirst($res['rdate'])."</h5>";
          echo"<br><h5 style='display: inline;color:#B8B8B8;'><u5 style='color:orange;' >total seasons:</u5> ".ucfirst($res['seasons'])."</h5>";
          echo"<br><h5 style='display: inline;color:#B8B8B8;'><u5 style='color:orange;' >total episods:</u5> ".ucfirst($res['episods'])."</h5>";
          echo"<br><h5 style='display: inline;color:#B8B8B8;'><u5 style='color:orange;' >keywords:</u5> ".ucfirst($res['keywords_en'])."</h5>";
        
        
          echo"<br><br>----------------------------------------  <br><h1 style='background-color:gray;color:orange;'>All Seasons</h1><br>";
        
        
          while($result = $req2->fetch(PDO::FETCH_ASSOC)){
            $season=intval(substr($result['name'], 7));
            echo "
            <div class='jumbotron' style='background-color:#1C1C1C;margin-bottom: 0px;display:flex;flex-direction:row;'>
            <div >
                <img src='".ucwords($result['imgpath'])."' height='250' width='200' style='margin-top: 30px;margin-left:30px;margin-right:20px;'>
            </div>
            <div>
                <form action='episods.php?serie=".$sid."&season=".$season."' method='POST'>
                        <input type='submit' name='submit' class='btn btn-success' style='display:inline;width:200px;margin-left:20px;margin-right:20px;' value='".ucwords($result['name'])."'/>
                </form><br>
                <h4 style='font-size:25px;color:orange;'><u style='font-size:25px;' >Description:</u></h4><h5 style='display: inline;color:white;'>".ucwords($result['description'])."</h5>
                <br><br><h4 style='font-size:25px;color:white;'><i style='color:orange;' >total episods : </i>".ucwords($result['NEP'])."</h4>
            </div>
            </div><br><br>";
         
       


}
}
?>

