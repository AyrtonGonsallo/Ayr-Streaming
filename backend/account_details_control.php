<?php
  session_start();
  include 'dbh.php';

if(isset($_POST['sub'])){

    $fnam = strtolower($_POST['fname']);
    $lnam=strtolower($_POST['lname']);
    $phn =  $_POST['phn'];
    $rid = $_SESSION['id'];
    $date = $_POST['dob'];

    $req = $bdd->prepare("UPDATE user1 SET firstname= :fnam,lastname= :lnam, DOB= :date,phone= :phn WHERE id=:rid");
    $req->bindValue("rid",$rid, PDO::PARAM_INT );
    $req->bindValue("fnam",$fnam, PDO::PARAM_STR );
    $req->bindValue("lnam",$lnam, PDO::PARAM_STR );
    $req->bindValue("date",$date, PDO::PARAM_STR );
    $req->bindValue("phn",$phn, PDO::PARAM_STR );
    $req->execute();
    
    header("Location: ../account_details.php");
   }
?>
