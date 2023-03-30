<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bd_prestamos']==0)) {
  header('location:logout.php');
  } else{



  ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Tables / Data - Admin Bootstrap Template</title>
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
      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Lista de clientes</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                  <li class="breadcrumb-item">Clientes</li>
                  <li class="breadcrumb-item active">Lista de clientes</li>
               </ol>
            </nav>
         </div>

         <section class="section">
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-body">
                        <!-- <h5 class="card-title">Clientes registrados </h5> -->
                        <h5 class="card-title" style="text-align: right;"><a class="nav-profile" href="add-customer.php"><button type="button"  class="btn btn-primary rounded-pill"><i class="bx bxs-user-plus"></i>  Agregar</button></a> </h5>
                        <table class="table datatable">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">DNI</th>
                                 <th scope="col">Nombres y Apellidos</th>
                                 <th scope="col">Celular</th>
                                 <th scope="col">Direccion</th>
                                 <th scope="col">Acción</th>
                              </tr>
                           </thead>

                           <tbody>
<?php 
   $ret=mysqli_query($con,"select * from  tblcustomer");
   $cnt=1;
   while ($row=mysqli_fetch_array($ret)) {
?>       
                           <tr>
                              <th scope="row"><?php echo $cnt;?></th>
                              <td><?php echo $row['dni'];?></td>
                              <td><?php echo $row['name'];echo " "; echo $row['surname']; ?></td>
                              <td><?php echo $row['phone'];?></td>
                              <td><?php echo $row['adress'];?></td>
                              <td class="text-end">
                                 <div class="btn-group" role="group" aria-label="Basic example"> 
                                 <a href="view-customer.php?viewid=<?php echo $row['id_customer'];?>><button type="button" class="btn btn-success rounded-pill"><i class="bx bx-show"></i></button></a>
                                 <a href="edit-customer.php?editid=<?php echo $row['id_customer'];?>"><button type="button" class="btn btn-secondary rounded-pill"> <i class="bx bx-edit"></i></button></a>
                                 </div>
                              </td>
                           </tr>
<?php $cnt=$cnt+1; 
   }
?>
                           </tbody>
                        </table>
                        <!--end table customer-->

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