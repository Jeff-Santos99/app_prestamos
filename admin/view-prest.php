<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bd_prestamos']==0)) {
  header('location:logout.php');
  } else{

    if(isset($_POST['submit']))
    {

     $presid =$_GET['prestid'];
     $idcuota=$_POST['cuota'];
    
     $query=mysqli_query($con, "update tblprestdetails set state='1' where id_prest='$presid' and id_details='$idcuota' ");
  
    }

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
            <h1>Registrar pagos</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                  <li class="breadcrumb-item">Préstamos</li>
                  <li class="breadcrumb-item active"><a href="list-prest.php">Lista de préstamos</a></li>
                  <li class="breadcrumb-item active">Ver</li>
               </ol>
            </nav>
         </div>

<?php 
$id =$_GET['prestid'];
$ret=mysqli_query($con,"SELECT id_prest,cod_prest,c.name,c.surname,c.phone,c.adress,p.monto,t.nameType,t.percentage,p.total_pago, p.state,p.date_prest FROM tblprest p 
INNER JOIN tblcustomer c ON p.id_customer=c.id_customer 
INNER JOIN tblpresttype t ON p.id_type=t.id_type where id_prest='$id' ");
$row=mysqli_fetch_array($ret)
?>
        <section class="section profile">
            <div class="row">
               <div class="col-xl-6">
                  <div class="card">
                     <div class="card-body pt-3">
                        
                        <div class="tab-content pt-2">
                           <div class="tab-pane fade show active profile-overview" id="profile-overview">

                              <h5 class="card-title">Detalles del préstamo</h5>
                              <div class="row">
                                 <div class="col-lg-4 col-md-5 label ">Código</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['cod_prest'];?></div>
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
                                 <div class="col-lg-4 col-md-4 label">Monto </div>
                                 <div class="col-lg-8 col-md-8">: <?php echo "s/. ".$row['monto'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Interés</div>
                                 <div class="col-lg-8 col-md-8">: <?php  echo "s/. ".$row['monto']*($row['percentage']/100);?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Total a pagar</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo "s/. ".$row['total_pago'];?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Fecha de préstamo</div>
                                 <div class="col-lg-8 col-md-8">: <?php $fecha = $row['date_prest']; echo date("d-m-Y",strtotime($fecha));?></div>
                              </div>
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 label">Tipo de cobro</div>
                                 <div class="col-lg-8 col-md-8">: <?php echo $row['nameType'];?></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
<?php 
   $CobMon=mysqli_query($con,"SELECT COUNT(*) Monto FROM tblprestdetails where id_prest=$id and state = 0 ");
   $row1=mysqli_fetch_array($CobMon);
   
   $PagMon=mysqli_query($con,"SELECT COUNT(*) Pagos FROM tblprestdetails where id_prest=$id and state = 1 ");
   $row2=mysqli_fetch_array($PagMon);

   $CopCu=mysqli_query($con,"SELECT SUM(monto) Pagados FROM tblprestdetails where id_prest=$id and state = 1 ");
   $row3=mysqli_fetch_array($CopCu); 

   $PagCu=mysqli_query($con,"SELECT SUM(monto) Faltantes FROM tblprestdetails where id_prest=$id and state = 0 ");
   $row4=mysqli_fetch_array($PagCu); 

?> 
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body profile-card pt-4 d-flex flex-column ">
                     <h5 class="card-title">Detalles de cuota </h5>
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <div class="row">
                           <div class="col-lg-3 col-md-3 label ">Monto cobrado</div>
                           <div class="col-lg-2 col-md-2">: s/.  <?php if ($row3['Pagados']==NULL) { echo "0"; } else { echo $row3['Pagados'];} ?></div>

                           <div class="col-lg-4 col-md-2 label ">Monto Restante</div>
                           <div class="col-lg-2 col-md-2">:s/ <?php echo $row4['Faltantes'];?></div>
                        </div>

                        <div class="row">
                           <div class="col-lg-3 col-md-3 label ">Cuotas pagada</div>
                           <div class="col-lg-2 col-md-2">: <?php echo $row2['Pagos'];?></div>

                           <div class="col-lg-4 col-md-2 label ">Cuotas Restante</div>
                           <div class="col-lg-2 col-md-2">: <?php echo $row1['Monto'];?></div>
                        </div>
                    </div>
                    <h5 class="card-title">Cuota a cancelar </h5>
<?php 
   $ret=mysqli_query($con,"select * from  tblprestdetails where id_prest='$id' ");
?>            
                   <form action="" class="row g-3" method="post">
                   <div class="col-md-12">
                              <label for="validationCustom01" class="form-label">Seleccionar Cuota</label> 
                              <select name="cuota" id="cuota" class="form-control">
                                 <?php 
                                    $ret=mysqli_query($con,"select * from  tblprestdetails where id_prest='$id' and state=0");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {
                                 ?>
                                 <option value="<?php echo $row['id_details']; ?>"><?php echo "Fecha:".$row['date']."   "." Monto a cancelar: s/.".$row['monto']; ?></option>
                                 <?php } ?>
                              </select>
                              <div class="valid-feedback"> Looks good!</div>
                     </div>
                     
                     <button  type="submit" id="submit" name="submit" class="btn btn-primary">Registrar Pago</button></div>
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
       <script src="assets/js/jquery-3.6.3.js"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            
  </body>
</html>
<?php } ?>

<script>
   $(document).ready(function (){
   $(submit).click(function (){
      Swal.fire(
      'Good job!',
      'You clicked the button!',
      'success'
      )
      });
   });   


   $(document).ready(function (){
   $(pagar).click(function (){
         Swal.fire({
         title: '¿Estas seguro?',
         text: "Registrar pago de cuota de préstamo",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Confirmar',
         cancelButtonText: 'Cancelar'

         }).then((result) => {
      if (result.isConfirmed) {
         Swal.fire(
         'Pagado',
         'Se registó pago de cuota',
         'success'
         )}
         })   
      
   });
});   

</script>
