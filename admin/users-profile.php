<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bd_prestamos']==0)) {
    header('location:logout.php');
    } else{

   if(isset($_POST['submit']))
  {
    date_default_timezone_set('America/Lima');
    $fecha_edit=date("Y-m-d h:i:s");

   $name     =$_POST['name'];
   $country  =$_POST['country'];
   $adres    =$_POST['adres'];
   $phone    =$_POST['phone'];
   $email    =$_POST['email'];
     
   $query=mysqli_query($con, "update  usuario  set name='$name',country='$country', address='$adres', phone='$phone', 
                              email='$email',update_at='$fecha_edit' where id_user=1 ");

    if ($query) {
            echo "<script>alert('Datos actualizado satisfactoriamente.');</script>"; 
            echo "<script>window.location.href = 'users-profile.php'</script>";
            
      } else {
            echo "<script>alert('error');</script>";	
        
} }

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Usuario / Perfil </title>
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
      <!-- head area and nadBar -->
      <?php include_once('includes/header.php');?>
      <?php include_once('includes/slidebar.php');?>

       <!--contend page-->

       <?php 
       
$ret=mysqli_query($con,"select * from  usuario");
$row=mysqli_fetch_array($ret);  
       ?>
      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Perfil de usuario</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active">Perfil</li>
               </ol>
            </nav>
         </div>
         <section class="section profile">
            <div class="row">
               <div class="col-xl-4">
                  <div class="card">
                     <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2><?php echo $row['nombreUser'];?></h2>
                        <h3><?php echo $row['rol_user'];?></h3>
                     </div>
                  </div>
               </div>
               
               <div class="col-xl-8">
                  <div class="card">
                     <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                           <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Descripción</button></li>
                           <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar datos</button></li>
                           <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Campiar contraseña </button></li>
                        </ul>
                        <div class="tab-content pt-2">
                           <div class="tab-pane fade show active profile-overview" id="profile-overview">
                             
                           <h5 class="card-title">Datos del usuario</h5>
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                 <div class="col-lg-9 col-md-8"><?php echo $row['name'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label">País</div>
                                 <div class="col-lg-9 col-md-8"><?php echo $row['country'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label">Dirección</div>
                                 <div class="col-lg-9 col-md-8"><?php echo $row['address'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label">Celular</div>
                                 <div class="col-lg-9 col-md-8"><?php echo $row['phone'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-3 col-md-4 label">Email</div>
                                 <div class="col-lg-9 col-md-8"><?php echo $row['email'];?></div>
                              </div>
                           </div>
                           
                           <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                              <form method="post">
                                 <!-- <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                       <img src="assets/img/profile-img.jpg" alt="Profile">
                                       <div class="pt-2"> <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a> <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a></div>
                                    </div>
                                 </div> -->
                                 <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombres</label>
                                    <div class="col-md-8 col-lg-9"> <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name'];?>"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                    <div class="col-md-8 col-lg-9"> <input name="country" type="text" class="form-control" id="country" value="<?php echo $row['country'];?>"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Dirección</label>
                                    <div class="col-md-8 col-lg-9"> <input name="adres" type="text" class="form-control" id="adres" value="<?php echo $row['address'];?>"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Celular</label>
                                    <div class="col-md-8 col-lg-9"> <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $row['phone'];?>"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9"> <input name="email" type="email" class="form-control" id="email" value="<?php echo $row['email'];?>"></div>
                                 </div>

                                 <div class="text-center"> <button type="submit" class="btn btn-primary" id="submit" name="submit" >Guardar cambios</button></div>
                              </form>
                           </div>

                           <div class="tab-pane fade pt-3" id="profile-change-password">
                              <form>
                                 <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña actual</label>
                                    <div class="col-md-8 col-lg-9"> <input name="password" type="password" class="form-control" id="currentPassword"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva contraseña</label>
                                    <div class="col-md-8 col-lg-9"> <input name="newpassword" type="password" class="form-control" id="newPassword"></div>
                                 </div>
                                 <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-ingresa nueva contraseña</label>
                                    <div class="col-md-8 col-lg-9"> <input name="renewpassword" type="password" class="form-control" id="renewPassword"></div>
                                 </div>
                                 <div class="text-center"> <button type="submit" class="btn btn-primary">Cambiar contraseña</button></div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
      <footer id="footer" class="footer">
        <div class="copyright"> &copy; Copyright <strong><span>Compnay Name</span></strong>. All Rights Reserved</div>
        <div class="credits"> with love <a href="https://freeetemplates.com/">FreeeTemplates</a></div>
     </footer>
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
<?php } ?>