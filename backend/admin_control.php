<?php
session_start();
if (isset($_POST['upload'])) {

  include 'dbh.php';

  $targetvid = "../video-uploads/".basename($_FILES['video']['name']);
  $targetimg = "../image-uploads/".basename($_FILES['image']['name']);
  $name = strtolower($_POST['mname']);
  $rdate = $_POST['release'];
  $genre = strtolower($_POST['genre']);
  $rtime = $_POST['rtime'];
  $key_f = $_POST['keywords_fr'];
  $key_e = $_POST['keywords_en'];
  $desc = $_POST['desc'];
  $image = $_FILES['image']['name'];
  $video = $_FILES['video']['name'];

  $req = $bdd->prepare("INSERT INTO movies (name, rdate, genre, runtime, description,keywords_en,keywords_fr, imgpath, videopath) VALUES(:name , :rdate , :genre , :run , :desc ,:key_e,:key_f, :img , :video )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue("rdate",$rdate, PDO::PARAM_STR );
  $req->bindValue('genre',$genre, PDO::PARAM_STR);
  $req->bindValue('run',$rtime, PDO::PARAM_INT);
  $req->bindValue('desc',$desc, PDO::PARAM_STR);
  $req->bindValue('img',$targetimg, PDO::PARAM_STR);
  $req->bindValue('key_e',$key_e, PDO::PARAM_STR);
  $req->bindValue('key_f',$key_f, PDO::PARAM_STR);
  $req->bindValue('video',$targetvid, PDO::PARAM_STR);
  $req->execute();



  if (move_uploaded_file($_FILES['image']['tmp_name'],$targetimg) && move_uploaded_file($_FILES['video']['tmp_name'],$targetvid)) {
    header("Location: http://local.ayr-streaming.com/homepage.php");
  }else {
    echo "error uploading";
  }
}


?>
