<?php
session_start();
if (isset($_POST['upload'])) {

  include 'dbh.php';
  $name=$_POST['sname'];
  $sql="SELECT sid as sid from series where name LIKE '%".$name."%'";
  $ser = $bdd->prepare($sql);
  $ser->execute();
  $res1=$ser->fetch(PDO::FETCH_ASSOC);
  $serie= $res1['sid'];

  $targetvid = "../video-uploads/".basename($_FILES['video']['name']);
  $name = strtolower($_POST['mname']);
  $rtime = $_POST['rtime'];
  $video = $_FILES['video']['name'];

  $req = $bdd->prepare("INSERT INTO episods (name, videopath, sid, runtime) VALUES(:name , :video , :sid , :run )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue('run',$rtime, PDO::PARAM_INT);
  $req->bindValue('sid',$serie, PDO::PARAM_INT);
  $req->bindValue('video',$targetvid, PDO::PARAM_STR);
  $req->execute();



  if (move_uploaded_file($_FILES['video']['tmp_name'],$targetvid)) {
    header("Location: ../homepage.php");
  }else {
    echo "error uploading";
  }
}