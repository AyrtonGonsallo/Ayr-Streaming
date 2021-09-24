<?php
session_start();
if (isset($_POST['upload'])) {

  include 'dbh.php';

  
  $targetimg = "../image-uploads2/".basename($_FILES['image']['name']);
  $name = strtolower($_POST['mname']);
  $rdate = $_POST['release'];
  $seasons = $_POST['seasons'];
  $episods = $_POST['episods'];
  $genre = strtolower($_POST['genre']);
  $rtime = $_POST['rtime'];
  $desc = $_POST['desc'];
  $image = $_FILES['image']['name'];

  $req = $bdd->prepare("INSERT INTO series (name, rdate, genre, runtime, description,seasons,episods, imgpath) VALUES(:name , :rdate , :genre , :run , :desc ,:sea,:ep, :img )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue("rdate",$rdate, PDO::PARAM_STR );
  $req->bindValue('genre',$genre, PDO::PARAM_STR);
  $req->bindValue('run',$rtime, PDO::PARAM_INT);
  $req->bindValue('desc',$desc, PDO::PARAM_STR);
  $req->bindValue('sea',$seasons, PDO::PARAM_INT);
  $req->bindValue('ep',$episods, PDO::PARAM_INT);
  $req->bindValue('img',$targetimg, PDO::PARAM_STR);
  $req->execute();



  if (move_uploaded_file($_FILES['image']['tmp_name'],$targetimg) ) {
    header("Location: ../admin3.php");
  }else {
    echo "error uploading";
  }
}


?>
