<?php
session_start();

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <title>NeonFlix-Account</title>
   <link rel="stylesheet" href="css/homepage.css" type="text/css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
   <body>
     <header>

         <nav class="navbar navbar-expand-md navbar-dark bg-dark">
             <a href="homepage.php" class="navbar-brand"> <img src="images/logo.png" alt=""> </a>
             <span class="navbar-text">NeonFlix</span>

             <ul class="navbar-nav">

               <li class="nav-item"> <a href="homepage.php" class="nav-link">Home</a> </li>

               <li class="nav-item"> <a href="backend/logout.php" class="nav-link">Logout</a> </li>
             </ul>


         </nav>

      </header>

      <div class="container">
        <?php
              include 'backend/dbh.php';
              $id = $_SESSION['id'];
              $req = $bdd->prepare("SELECT * FROM user1 WHERE id =:id");
              $req->bindValue("id",$id, PDO::PARAM_INT );
              $req->execute();
              $result = $req->fetch(PDO::FETCH_ASSOC);

      echo "  <form  action='backend/account_details_control.php' method='POST'>

          <br>firstname: <br><input type='text' class='form-control' placeholder='Enter full firstname' name='fname' value='" .ucwords($result['firstname'])."'>
          <br>lastname: <br><input type='text' class='form-control' placeholder='Enter full lastname' name='lname' value='" .ucwords($result['lastname'])."'>
          
          <br>email: <input type='text' class='form-control' placeholder='Enter full email' name='email' value='" .ucwords($result['email'])."'>
          <br>password: <input type='text' class='form-control' readonly='' placeholder='Enter password' name='password' value='" .ucwords($result['passwd'])."'>
          
          <br>phone number:
          <input type='text' class='form-control' placeholder='Enter mobile number' name='phn' value='".$result['phone']."'>
          <br>
          <label><b>Date of Birth : </b></label>
          <input type='text' class='from-control' placeholder='Enter Date of Birth' name='dob' value='".$result['DOB']."'><br>

              <div class='signupbutton'>
                <br><br>
                <button type='submit' class='btn btn-success' name='sub' value='submit'>Update Details</button>

              </div>
              </form>


              <br><br>
              <label><b>Email Id : </b>".$result['email']. "</label>
              <br><br>
              <a href='account_password.php'>Change Password</a>



              ";
         ?>




      </div>

    </body>

  </html>
