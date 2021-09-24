<?php
  session_start();
  include 'dbh.php';

if(isset($_POST['subpass'])){

    $oldpass = $_POST['oldp'];
    $newpass =  $_POST['newp'];
    $rid = $_SESSION['id'];

   
    $req = $bdd->prepare("UPDATE user1 SET passwd = :newpass WHERE id=:rid AND passwd=:oldpass");
    $req->bindValue("rid",$rid, PDO::PARAM_INT );
    $req->bindValue("newpass",$newpass, PDO::PARAM_STR );
    $req->bindValue("oldpass",$oldpass, PDO::PARAM_STR );
    $req->execute();
    header("Location: ../account_password.php");
}
?>
