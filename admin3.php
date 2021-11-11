<?php
session_start();

 ?>


 <!DOCTYPE html>
 <head>
   <meta charset="utf-8">
   <title>NeonFlix-Admin</title>
   <link rel="stylesheet" href="css/user.css" type="text/css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 </head>
 <body>
   <header>
     <div class="container-fluid">
       <nav class="navbar navbar-expand-md navbar-dark bg-dark">
           <a href="homepage.php" class="navbar-brand"> <img src="images/logo.png" alt=""> </a>
           <span class="navbar-text">NeonFlix</span>

           <ul class="navbar-nav">
             <li class="nav-item"> <a href="homepage.php" class="nav-link"> Home </a> </li>
             <li class="nav-item"> <a href="backend/logout.php" class="nav-link"> Logout</a> </li>

           </ul>

       </nav>

       <div class="container">

         <div class="jumbotron">
           <h1> Enter the episod details</h1>
           <p> <b></b> </p> <br>

           <form class="" action="backend/admin_control3.php" method="POST" enctype="multipart/form-data">
            
            <input type="text" class="form-control" placeholder="episod Name" name="mname" value=""><br>
            <input type="number" class="form-control" placeholder="Season" name="season" value=""><br>
             <input type="number" class="form-control" placeholder="Runtime" name="rtime" value=""><br>
             <input type="text" class="form-control" placeholder="serie name" name="sname" value=""><br><br>
             <textarea type="text" class="form-control" rows="5"  placeholder="description" name="desc" value=""></textarea><br>
             <div class="row">
               <div class="col">
               <table>
                   <tr>
                     <td> <label for=""><b>Upload Video : </b></label> </td>
                     <td>
                          <div class="">
                              <input type="hidden" name="size" value="30000000">

                              <input type="file" name="video" value="">
                          </div>
                     </td>
                   </tr>
                 </table>
               </div>
               
             </div> <br><br>
             <div class="signupbutton">
               <input type="submit" class ="btn btn-success btn-lg" name="upload" value="Submit" >
             </div>


           </form>

        </div>


         </div>

       </div>


   </div>

 </header>
 <footer class="page-footer font-small blue">

   <div class="footer-copyright text-center py-3">© 2018 Copyright:
     <a href="">shubhamb756@gmail.com</a>
   </div>

 </footer>
   </body>
 </html>