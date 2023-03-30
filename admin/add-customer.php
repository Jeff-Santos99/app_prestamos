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
   $fecha_creacion=date("Y-m-d h:i:s");

   $dni      =$_POST['dni'];
   $name     =$_POST['name'];
   $surname  =$_POST['surname'];
   $phone    =$_POST['phone'];
   $adress   =$_POST['adress'];
   $details  =$_POST['details'];
   $fecha =$fecha_creacion;
  
   $query=mysqli_query($con, "insert into tblcustomer (dni,name,surname,phone,adress,details,created_at) 
   values('$dni','$name','$surname','$phone','$adress','$details','$fecha')");

    if ($query) {
            
            echo "<script>alert('Cliente agregado corrrectamente')</script>"; 
        
            echo "<script>window.location.href = 'list-customer.php'</script>";
            
      } else {
         echo "<script>var valor=0; save($valor);</script>"; 
} }
  ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Agregar clientes</title>
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

      <main id="main" class="main">
         <div class="pagetitle">
            <h1>Registrar Clientes</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                  <li class="breadcrumb-item">Clientes</li>
                  <li class="breadcrumb-item active"><a href="list-customer.php">Lista de clientes</a></li>
                  <li class="breadcrumb-item active">Agregar clientes</li>
               </ol>
            </nav>
         </div>

         <section class="section">
            <div class="row">
               <div class="">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Ingresar datos del cliente</h5>
                        <form class="row g-3" method="post">
                           <div class="col-2"> <label for="inputNanme" class="form-label">DNI</label> <input type="text" class="form-control" id="dni" name="dni" required="true" minlength="8" maxlength="8" pattern="[0-9]+"></div>
                           <div class="col-5"> <label for="inputNanme" class="form-label">Nombres</label> <input type="text" class="form-control" id="name" name="name" required="true" ></div>
                           <div class="col-5"> <label for="inputNanme" class="form-label">Apellidos</label> <input type="text" class="form-control" id="surname" name="surname" required="true" ></div>
                           <div class="col-4"> <label for="inputPhone" class="form-label">Celular</label> <input type="phone" class="form-control" id="phone" name="phone" placeholder="966326598" required="true" minlength="9" maxlength="9" pattern="[0-9]+"></div>
                           <div class="col-8"> <label for="inputAddress" class="form-label">Dirección</label> <input type="text" class="form-control" id="adress" name="adress" placeholder="1234 Main St" required="true"></div>
                           <div class="form-floating mb-3"><textarea class="form-control" placeholder="Leave a comment here" id="details" name="details" style="height: 100px;"></textarea><label for="floatingTextarea">Observación</label></div>
                           <div class="text-center"> <button type="submit" name="submit" class="btn btn-primary">Guardar</button> 
                           <button type="reset" class="btn btn-secondary">Reset</button></div>
                        </form>
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
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      
       <script src="sweetalert2.all.min.js"></script>
       <script src="sweetalert2.min.js"></script>
       <link rel="stylesheet" href="sweetalert2.min.css">
       
            
  </body>
</html>

<?php } ?>
<script>
  
</script>