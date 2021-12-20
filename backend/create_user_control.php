<?php
  session_start();
  include 'dbh.php';


    $fname = strtolower($_POST['fname']);
    $lname =  strtolower($_POST['lname']);
    $phn =  $_POST['phn'];
    $email =  $_POST['mail'];
    $password =  $_POST['pass'];
    $date = $_POST['date'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $dob = $date."/".$month."/".$year;

    $req = $bdd->prepare("INSERT INTO user1(passwd, firstname, lastname, phone, email, DOB) values(:passwd,:fname,:lname,:phn,:email,:dob)");
    $req->bindValue('passwd',$password, PDO::PARAM_STR);
    $req->bindValue('fname',$fname, PDO::PARAM_STR);
    $req->bindValue('lname',$lname, PDO::PARAM_STR);
    $req->bindValue('phn',$phn, PDO::PARAM_STR);
    $req->bindValue('email',$email, PDO::PARAM_STR);
    $req->bindValue('dob',$dob, PDO::PARAM_STR);
    $req->execute();

    header("Location: ../user-login.php");
?>
