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

   $dni      =$_POST['dni'];
   $name     =$_POST['name'];
   $surname  =$_POST['surname'];
   $phone    =$_POST['phone'];
   $adress   =$_POST['adress'];
   $details  =$_POST['details'];
   
   $eid=$_GET['editid'];
  
   $query=mysqli_query($con, "update tblcustomer set dni='$dni', name='$name', 
                              surname='$surname', phone='$phone', adress='$adress', 
                              details='$details',update_at='$fecha_edit' where id_customer='$eid' ");

    if ($query) {
            echo "<script>alert('Cliente actualizado satisfactoriamente.');</script>"; 
            echo "<script>window.location.href = 'list-customer.php'</script>";
            
      } else {
            echo "<script>alert('error');</script>";	
        
} }
  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Editar clientes</title>
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
            <h1>Editar Clientes</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                  <li class="breadcrumb-item">Clientes</li>
                  <li class="breadcrumb-item"><a href="list-customer.php">Lista de clientes</a></li>
                  <li class="breadcrumb-item active">Actualizar datos</li>
               </ol>
            </nav>
         </div>

<?php
$cid=$_GET['editid'];
$ret=mysqli_query($con,"select * from  tblcustomer where id_customer='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
         <section class="section">
            <div class="row">
               <div class="">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Actualizar datos del cliente</h5>
                        <form class="row g-3" method="post">
                           <div class="col-2"> <label for="inputNanme" class="form-label">DNI</label> <input type="text" class="form-control" id="dni" name="dni" required="true" minlength="8" maxlength="8" pattern="[0-9]+" value="<?php echo $row['dni']?>"></div>
                           <div class="col-5"> <label for="inputNanme" class="form-label">Nombres</label> <input type="text" class="form-control" id="name" name="name" required="true" value="<?php echo $row['name']?>"></div>
                           <div class="col-5"> <label for="inputNanme" class="form-label">Apellidos</label> <input type="text" class="form-control" id="surname" name="surname" required="true" value="<?php echo $row['surname']?>"></div>
                           <div class="col-4"> <label for="inputPhone" class="form-label">Celular</label> <input type="phone" class="form-control" id="phone" name="phone" placeholder="966326598" required="true" minlength="9" maxlength="9" pattern="[0-9]+" value="<?php echo $row['phone']?>"></div>
                           <div class="col-8"> <label for="inputAddress" class="form-label">Dirección</label> <input type="text" class="form-control" id="adress" name="adress" placeholder="1234 Main St" required="true" value="<?php echo $row['adress']?>"></div>
                           <div class="form-floating mb-3"><textarea class="form-control" placeholder="Leave a comment here" id="details" name="details" style="height: 100px;" value=""><?php echo $row['details']?></textarea><label for="floatingTextarea">Observación</label></div>
<?php } ?>
                           <div class="text-center"> <button type="submit" id="submit" name="submit" class="btn btn-success">Actualizar</button> 
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
            
  </body>
</html>
<?php } ?>