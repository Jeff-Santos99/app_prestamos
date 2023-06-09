<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=$_POST['password'];
    //$password=md5($_POST['password']);

    
    $query=mysqli_query($con,"select id_user from usuario where  user='$adminuser' and password='$password' ");
    $ret=mysqli_fetch_array($query);


    if($ret>0){
      $_SESSION['bd_prestamos']=$ret['id_user'];
      header('location:index.php');
    }
    else{
    $msg="Información Inválida.";
    }
  }
  ?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Login | Prestamos</title>
      <meta name="robots" content="noindex, nofollow">
      <meta content="" name="description">
      <meta content="" name="keywords">
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <link href="assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
      <link href="assets/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/css/quill.snow.css" rel="stylesheet">
      <link href="assets/css/quill.bubble.css" rel="stylesheet">
      <link href="assets/css/remixicon.css" rel="stylesheet">
      <link href="assets/css/simple-datatables.css" rel="stylesheet">
      <link href="assets/css/style.css" rel="stylesheet">
   </head>
   <body>
      <main>
         <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4"> <a href="index.php" class="logo d-flex align-items-center w-auto"> <img src="assets/img/logo.png" alt=""> <span class="d-none d-lg-block">Admin</span> </a></div>
                        <div class="card mb-3">
                           <div class="card-body">
                              <div class="pt-4 pb-2">
                                 <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                 <p class="text-center small">Enter your username & password to login</p>
                              </div>

                              <form class="row g-3 needs-validation" novalidate method="POST">
                              
                              <center><h6 text-aling="center"><?php echo $msg ?></h5></center>
                              <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend">@</span> 
                                       <input type="text" name="username" class="form-control"  id="yourUsername" required="true">
                                       <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                 </div>

                                 <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label> 
                                    <input type="password" name="password" class="form-control" id="yourPassword" required="true">
                                    <div class="invalid-feedback">Please enter your password!</div>
                                 </div>

                                 <!-- <div class="col-12">
                                    <div class="form-check"> 
                                       <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe"> <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                 </div> -->

                                 <div class="col-12"> <button class="btn btn-primary w-100" type="submit" name="login">Login</button></div>

                              </form>
                           </div>
                        </div>
                        <div class="credits"> Loved by <a href="https://freeetemplates.com/">FreeeTemplates</a></div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </main>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> 
      <script src="assets/js/apexcharts.min.js"></script>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/chart.min.js"></script>
      <script src="assets/js/echarts.min.js"></script>
      <script src="assets/js/quill.min.js"></script>
      <script src="assets/js/simple-datatables.js"></script>
      <script src="assets/js/tinymce.min.js"></script>
      <script src="assets/js/validate.js"></script>
      <script src="assets/js/main.js"></script> 
   </body>
</html>
