<?php
session_start();
if (isset($_POST['upload'])) {

  include 'dbh.php';
  $targetimg = "../image-uploads2/".basename($_FILES['image']['name']);
  $image = $_FILES['image']['name'];
  $name=$_POST['serie'];
  $sql="SELECT sid as sid from series where name LIKE '%".$name."%'";
  $ser = $bdd->prepare($sql);
  $ser->execute();
  $res1=$ser->fetch(PDO::FETCH_ASSOC);
  if(!$res1){
    header("Location: ../admin2.php");
    exit();
  }
  $serie= $res1['sid'];
  $desc=$_POST['desc'];
  $noe=$_POST['nep'];
  $name = "Season ".strtolower($_POST['sname']);


  $req = $bdd->prepare("INSERT INTO seasons (name, sid, description,imgpath,NEP) VALUES(:name ,:sid , :desc,:img,:nep )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue('sid',$serie, PDO::PARAM_INT);
  $req->bindValue('desc',$desc, PDO::PARAM_STR);
  $req->bindValue('nep',$noe, PDO::PARAM_INT);
  $req->bindValue('img',$targetimg, PDO::PARAM_STR);
  $req->execute();


  if (move_uploaded_file($_FILES['image']['tmp_name'],$targetimg) ) {
    header("Location: ../admin3.php");
  }else {
    echo "error uploading";
  }
  
}
  
