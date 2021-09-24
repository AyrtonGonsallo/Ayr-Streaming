<?php
  session_start();
  include 'dbh.php';




    $email =  $_POST['mail'];
    $password =  $_POST['pass'];


    $req = $bdd->prepare("SELECT * FROM user1 WHERE email =:email AND passwd = :passwd ");
    $req->bindValue('passwd',$password, PDO::PARAM_STR);
    $req->bindValue('email',$email, PDO::PARAM_STR);
    $req->execute();


    if(!$row = $req->fetch(PDO::FETCH_ASSOC)) {
      echo "incorrect username or password";
    }else {

        $_SESSION['admin'] = $row['admin'];
        $_SESSION['id'] = $row['id'];
        header("Location: ../homepage.php");
      }

    

?>
