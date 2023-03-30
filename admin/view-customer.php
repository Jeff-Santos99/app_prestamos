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
      <title>Detalles préstamos</title>
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
            <h1>Ver cliente</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                  <li class="breadcrumb-item">Préstamos</li>
                  <li class="breadcrumb-item active"><a href="list-customer.php">Lista de clientes</a></li>
                  <li class="breadcrumb-item active">Ver</li>
               </ol>
            </nav>
         </div>

<?php 
$id =$_GET['viewid'];
$ret=mysqli_query($con,"SELECT * from tblcustomer where id_customer='$id' ");
$row=mysqli_fetch_array($ret)
?>
        <section class="section profile">
            <div class="row">
               <div class="col-xl-6">
                  <div class="card">
                     <div class="card-body pt-3">
                        
                        <div class="tab-content pt-2">
                           <div class="tab-pane fade show active profile-overview" id="profile-overview">

                              <h5 class="card-title">Datos del cliente</h5>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label ">DNI</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['dni'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label ">Cliente</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['name']; echo " ";echo  $row['surname'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Celular</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['phone'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Dirección</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['adress'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Observación</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['details'];?></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body profile-card pt-4 d-flex flex-column ">
                     <h5 class="card-title">Historial de préstamos </h5>
                     <table class="table datatable">
                        <thead>
                               <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Cod</th>
                                 <th scope="col">Monto</th>
                                 <th scope="col">(%)</th>
                                 <th scope="col">Fecha</th>
                                 <th scope="col">Estado</th>
                                 <th scope="col">Acción</th>
                              </tr>
                        </thead>

                        <tbody>
<?php 
   $ret=mysqli_query($con,"SELECT id_prest,id_customer, p.cod_prest,p.monto,tp.percentage,p.date_prest,tp.nameType,p.state 
   FROM tblprest p
   INNER JOIN tblpresttype tp ON p.id_type=tp.id_type where id_customer='$id' ");
   $cnt=1;
   while ($row=mysqli_fetch_array($ret)) {
?>       
                           <tr>
                              <th scope="row"><?php echo $cnt;?></th>
                              <td><?php echo $row['cod_prest'];?></td>
                              <td><?php echo "s/. ".$row['monto'];?></td>
                              <td><?php echo $row['percentage']."%";?></td>
                              <td><?php $fecha = $row['date_prest']; echo date("d/m/Y",strtotime($fecha));?></td>
                              <td><?php 
                              switch ($row['state']) {
                                 case 1:
                                    echo "Pagado";
                                    break;
                                 default:
                                    echo "Pendiente";
                                    break;
                              }
                              ?></td>
                              <td class="text-end">
                                 <div class="btn-group" role="group" aria-label="Basic example"> 
                                 <a href="view-prest.php?prestid=<?php echo $row['id_prest'];?>"><button type="button" class="btn btn-success rounded-pill"><i class="bx bx-show"></i></button></a>
                                 </div>
                              </td>
                           </tr>
<?php $cnt=$cnt+1; 
   }
?>

                        </tbody>
                     </table>   
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