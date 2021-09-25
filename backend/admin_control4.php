<?php
session_start();
if (isset($_POST['upload'])) {

  include 'dbh.php';
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


  $req = $bdd->prepare("INSERT INTO seasons (name, sid, description,NEP) VALUES(:name ,:sid , :desc,:nep )");
  $req->bindValue('name',$name, PDO::PARAM_STR);
  $req->bindValue('sid',$serie, PDO::PARAM_INT);
  $req->bindValue('desc',$desc, PDO::PARAM_STR);
  $req->bindValue('nep',$noe, PDO::PARAM_INT);
  $req->execute();



    header("Location: ../homepage.php");
  
}