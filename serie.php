<?php
session_start();
if (isset($_POST['submit'])) {

  $title = $_POST['submit'];
  $id=$_GET['episod'];
  include 'backend/dbh.php';
  $req = $bdd->prepare("SELECT * FROM episods WHERE id = :id");
  $req->bindValue('id',$id , PDO::PARAM_INT);
  $req->execute();

 

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

        echo"<div class='jumbotron' style='background-color:#1C1C1C;margin-bottom: 0px;'>";
        echo"<div class='inner'>";
        while($result = $req->fetch(PDO::FETCH_ASSOC)){
            $ename = $result['name'];
            $person = $_SESSION['id'];
            $eid = $result['id'];
            $current = $result['viewers'];
            $newcount = $current + 1;
            $req2 = $bdd->prepare("UPDATE episods SET viewers = :newcount WHERE name=:mname");
            $req2->bindValue('newcount',$newcount , PDO::PARAM_INT);
            $req2->bindValue('mname',$ename , PDO::PARAM_STR);
            $req2->execute();

            $req22 = $bdd->prepare("UPDATE user1 SET eid = :eid WHERE id =:person ");
            $req22->bindValue('eid',$eid , PDO::PARAM_INT);
            $req22->bindValue('person',$person , PDO::PARAM_INT);
            $req22->execute();

            $req4 = $bdd->prepare("SELECT * FROM series WHERE sid = :sid");
            $req4->bindValue('sid',$result['sid'] , PDO::PARAM_INT);
            $req4->execute();
            $result2 = $req4->fetch(PDO::FETCH_ASSOC);

            $req3 = $bdd->prepare("UPDATE user1 SET sid = :eid WHERE id =:person ");
            $req3->bindValue('eid',$result2['sid'] , PDO::PARAM_INT);
            $req3->bindValue('person',$person , PDO::PARAM_INT);
            $req3->execute();

            $req5 = $bdd->prepare("SELECT * FROM seasons WHERE name = :name and sid=:sid");
            $req5->bindValue('name',"Season ".$result['season'] , PDO::PARAM_STR);
            $req5->bindValue('sid',$result['sid'] , PDO::PARAM_INT);
            $req5->execute();
            $result3 = $req5->fetch(PDO::FETCH_ASSOC);

            echo"<a href='homepage.php' style='font-size: 20px;color:orange;border:1px solid orange;border-radius:5px;padding:10px;text-decoration:none;'>Back to Home </a><br>";

          echo "<br></div><h1 style='display: inline;color:#D8D8D8;'>".ucwords($result['name'])."</h1>";
          echo"<br><h5 style='display: inline;color:#D8D8D8;'>".ucfirst($result3['description'])."</h5>";


          echo"<br><div class='info'><h5 style='display: inline;color:#D8D8D8;'>".$result2['rdate']."</h5>";
          echo" - ";
          echo"<h5 style='display: inline;color:#D8D8D8;'>".ucwords($result2['genre'])."</h5>";
          echo" - ";
          echo"<h5 style='display: inline;color:orange;' >Runtime : </h5><h5 style='display: inline;color:#D8D8D8;'>".$result['runtime']." mins </h5>";
          echo" - ";
          echo"<h5 style='display: inline;color:orange;' >Views : </h5><h5 style='display: inline;color:#D8D8D8;'>".$result['viewers']."</h5></div>";





            echo"</div>";
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
                    poster="uploads/<?php echo $result2['imgpath']; ?>"
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
//   file:///Movies and TV Shows/Movies/tom.and.jerry/tom_and_jerry.mkv
        }

        echo '<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>';

    echo"</body>";


  echo"</html>";


}
?>
