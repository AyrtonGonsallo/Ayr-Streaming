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
  $key_f = $_POST['keywords_fr'];
  $key_e = $_POST['keywords_en'];
  $desc = $_POST['desc'];
  $image = $_FILES['image']['name'];

  $req = $bdd->prepare("INSERT INTO series (name, rdate, genre, runtime, description,keywords_en,keywords_fr,seasons,episods, imgpath) VALUES(:name , :rdate , :genre , :run , :desc,:key_e,:key_f, :sea,:ep, :img )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue("rdate",$rdate, PDO::PARAM_STR );
  $req->bindValue('genre',$genre, PDO::PARAM_STR);
  $req->bindValue('run',$rtime, PDO::PARAM_INT);
  $req->bindValue('desc',$desc, PDO::PARAM_STR);
  $req->bindValue('key_e',$key_e, PDO::PARAM_STR);
  $req->bindValue('key_f',$key_f, PDO::PARAM_STR);
  $req->bindValue('sea',$seasons, PDO::PARAM_INT);
  $req->bindValue('ep',$episods, PDO::PARAM_INT);
  $req->bindValue('img',$targetimg, PDO::PARAM_STR);
  $req->execute();



  if (move_uploaded_file($_FILES['image']['tmp_name'],$targetimg) ) {
    header("Location: ../admin4.php");
  }else {
    echo "error uploading";
  }
}


?>
