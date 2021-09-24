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
  $req2 = $bdd->prepare("SELECT * FROM episods WHERE sid = :sid");
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

          echo "<br></div><h1 style='display: inline;color:#D8D8D8;'>".ucwords($res['name'])."</h1>";
          echo"<br><h5 style='display: inline;color:#D8D8D8;'>".ucfirst($res['description'])."</h5>";
            echo"<div class='jumbotron' style='background-color:#1C1C1C;margin-bottom: 0px;'>";
        echo"<div class='inner'>";
          while($result = $req2->fetch(PDO::FETCH_ASSOC)){
        

          echo"<br><div class='info'><h5 style='display: inline;color:#D8D8D8;'>".$result['name']."</h5>";
          echo" - ";
          echo"<h5 style='display: inline;color:orange;' >Runtime : </h5><h5 style='display: inline;color:#D8D8D8;'>".$result['runtime']." mins </h5>";
          echo" - ";
          echo"<h5 style='display: inline;color:orange;' >Views : </h5><h5 style='display: inline;color:#D8D8D8;'>".$result['viewers']."</h5></div>";
            




            echo"</div>";
            
          ?>

<div class="video-container">

<video
        id="my-video"
        class="video-js vjs-theme-forest"
        controls
        preload="auto"
        width="960"
        height="540"
        poster="uploads/<?php echo $res['imgpath']; ?>"
        data-setup="{}"
>


    <source src="video-uploads/<?php echo $result['videopath']; ?>" type="video/webm">


    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
        >
    </p>
</video>
</div>
          


       <?php
        }

        echo '<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>';

    echo"</body>";


  echo"</html>";


}
?>
