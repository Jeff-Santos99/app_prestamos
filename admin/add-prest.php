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
   
   $cod_prest   ="PR".rand(1,100);
   $id_customer =$_POST['cliente'];

   $type        =$_POST['type'];
   $tip=mysqli_query($con,"select * from tblpresttype where id_type='$type' ");
   $range=mysqli_fetch_array($tip);

   $monto       =$_POST['monto'];
   $interes     =$range['percentage'];
   $interes     =floatval($interes);
   $total       =$monto + $monto*($interes/100);

   $num_cuota   =$_POST['numCuota'];
   $mon_cuota   =$total/$num_cuota;

   $date_prest  =$_POST['date_prest'];
   $date_ini    =$_POST['date_ini'];
  
   $query=mysqli_query($con, "insert into tblprest (cod_prest,id_customer,id_type,monto,total_pago,num_cuotas,state,date_prest,date_ini,created_at) 
   values('$cod_prest','$id_customer ','$type','$monto','$total','$num_cuota','0','$date_prest','$date_ini','$fecha_creacion')");

    if ($query) {
      $consulta=mysqli_query($con,"select * from tblprest order by id_prest DESC");
		$id=mysqli_fetch_array($consulta);
		$index=$id['id_prest'];

      //Repartir fechas
		$duracion=$range['duration'];		
					//		
					$ind=0;
					while ($ind < $num_cuota	) {
						# code...
						$query=mysqli_query($con, "insert into tblprestdetails(id_prest,monto,date,state,created_at) 
                                value('$index','$mon_cuota','$date_ini','0','$fecha_creacion')");			
						$ind++;
                  $date_ini= date("Y-m-d",strtotime($date_ini."+".$duracion." days"));
					}

         if ($query) {
            echo "<script>alert('Prestamo registrado');</script>";
            echo "<script>window.location.href = 'list-prest.php'</script>";  
         } else {
            echo "<script>alert('error en sub consulta');</script>"; 
         }
            
      } else {
         echo "<script>alert('error en consulta 1');</script>"; 
} }
  ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Registrar Prestamo</title>
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
            <h1>Registrar préstamo</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                  <li class="breadcrumb-item">Préstamos</li>
                  <li class="breadcrumb-item active">Registar prestamo</li>
               </ol>
            </nav>
         </div>

         <section class="section">
            <div class="row">
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
<?php  ?>                        
                        <form class="row g-3 needs-validation" method="post" novalidate>
                        <h5 class="card-title">Datos del cliente</h5>
                           <div class="col-md-12">
                              <label for="validationCustom01" class="form-label">Seleccionar cliente</label> 
                              <select name="cliente" id="cliente" class="form-control">
                                 <?php 
                                    $ret=mysqli_query($con,"select * from  tblcustomer");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {
                                 ?>
                                 <option value="<?php echo $row['id_customer']; ?>"><?php echo $row['name']." ".$row['surname']; ?></option>
                                 <?php } ?>
                              </select>
                              <div class="valid-feedback"> Looks good!</div>
                           </div>

                           <!-- <div class="col-md-3">
                              <label for="validationCustom01" class="form-label">DNI</label> <input type="text" class="form-control" id="dni" name="dni"  disabled="true" required>
                              <div class="valid-feedback"> Looks good!</div>
                           </div>
                           <div class="col-md-3">
                              <label for="validationCustom02" class="form-label">Celular </label> <input type="text" class="form-control" id="phone" name="phone" disabled="true" required required>
                              <div class="valid-feedback"> Looks good!</div>
                           </div> -->
              

                        <h5 class="card-title">Datos del préstamo</h5>
                           
                           <div class="col-md-4">
                              <label for="validationCustom03" class="form-label">Monto</label> <input id="monto" name="monto" type="number" class="form-control" placeholder="s/." min="0" required>
                              <div class="invalid-feedback"> Please provide a valid city.</div>
                           </div>
                           <div class="col-md-4">
                              <label for="validationCustom04" class="form-label">Tipo de préstamo</label> 
                              <select name="type" id="type" class="form-control">
                                 <?php 
                                    $ret=mysqli_query($con,"select * from  tblpresttype");
                                    $cnt=1;
                                    while ($row=mysqli_fetch_array($ret)) {
                                 ?>
                                 <option value="<?php echo $row['id_type']; ?>" name="options"><?php echo $row['nameType']; ?></option>
                                 <?php } ?>
                              </select>
                              <div class="invalid-feedback"> Please select a valid state.</div>
                           </div>

                           <div class="col-md-4">
                              <label for="validationCustom03" class="form-label">Intereses (%)</label> 
                              <input type="text" class="form-control" id="interes" name="interes" disabled="true" placeholder="%" required>
                              <div class="invalid-feedback"> Please provide a valid city.</div>
                           </div>

                           <div class="col-md-4">
                              <label for="validationCustom05" class="form-label">Fecha de préstamo</label> <input type="date" class="form-control" id="date_prest" name="date_prest" min="<?php date_default_timezone_set('America/Lima'); $fecha=date('Y-m-d'); echo $fecha; ?>" value="<?php date_default_timezone_set('America/Lima'); $fecha=date('Y-m-d'); echo $fecha; ?>" required>
                              <div class="invalid-feedback"> Please provide a valid zip.</div>
                           </div>
                           <div class="col-md-4">
                              <label for="validationCustom05" class="form-label">Fecha de inicio</label> <input type="date" class="form-control" id="date_ini" name="date_ini" min="<?php date_default_timezone_set('America/Lima'); $fecha=date('Y-m-d'); echo $fecha; ?>" required>
                              <div class="invalid-feedback"> Please provide a valid zip.</div>
                           </div>
                           <div class="col-md-4">
                              <label for="validationCustom05" class="form-label">Numero de cuotas</label> <input type="number" class="form-control" id="numCuota" name="numCuota" min="0" required>
                              <div class="invalid-feedback"> Please provide a valid zip.</div>
                           </div>
                           <div class="col-12 text-center"> <button type="button" class="btn btn-secondary"  id="calcular" name="calcular">Calcular cuota</button></div>
                           
                           <!--Cálculo de cuota-->
                           <div class="col-md-4">
                              <label for="validationCustom03" class="form-label">Monto por cuota</label> <input type="text" class="form-control" id="monCuota" name="monCuota"" placeholder="s/. 100" disabled="true">
                           </div>
                           <div class="col-md-4">
                              <label for="validationCustom03" class="form-label">Intereses</label> <input type="text" class="form-control" id="monInteres" name="monInteres"   placeholder="s/. 100" disabled="true">
                           </div>
                           <div class="col-md-4">
                              <label for="validationCustom03" class="form-label">Total a pagar</label> <input type="text" class="form-control" id="monTotal" name="monTotal" placeholder="s/. 100" disabled="true">
                           </div>


                           <button  type="submit" id="submit" name="submit" class="btn btn-primary">Registrar préstamo</button></div>

                        </form>
                        </div>
                     </div>

                     <!--lista de clientes-->
                  <div class="col-lg-6">
                      <div class="card">
                        <div class="card-body">
                           <!--include de table customer-->
                           <?php include_once('details-prest.php');?>
                           <label for="" class="prueba" id="prueba"></label>
                        </div>
                     </div>
                  </div>
                  <!--Fin lista de clientes-->

               </div> 
            </div>
         </section>
         
      </main>
      
      <footer id="footer" class="footer">
        <div class="copyright"> &copy; Copyright <strong><span>Préstamos al instante</span></strong>. All Rights Reserved</div>
        <div class="credits"> with love <a href="https://freeetemplates.com/">FreeeTemplates</a></div>
     </footer>

     <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>  
       <script src="assets/js/apexcharts.min.js"></script>
       <script src="assets/js/bootstrap.bundle.min.js"></script>
       <script src="assets/js/chart.min.js"></script>
       <script src="assets/js/echarts.min.js"></script>
       <script src="assets/js/quill.min.js"></script>
       <script src="assets/js/tinymce.min.js"></script>
       <script src="assets/js/validate.js"></script>
       <script src="assets/js/main.js"></script> 
       <script src="assets/js/jquery-3.6.3.js"></script> 
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            
  </body>
</html>
<?php }?>

<script>
//Mostrar datos del cliente
$(document).ready(function(){

$('#cliente').change(function(){
   detailcustomer()
});
})
// //Aquí me quedé
// function detailcustomer() {

//    
//    $ret=mysqli_query($con,"select * from  tblcustomer");
//    $row=mysqli_fetch_array($ret);

//    $cant=mysqli_query($con,"SELECT COUNT(id_customer) cantidad from tblcustomer");
//    $cont=mysqli_fetch_array($cant);
//   

//    var idCliente = document.getElementById("cliente").value;
//    var elementData =[];
//    for (let i = 0; i < ; i++) {
//       let objeto    = {};
//       objeto.dni  = ;
//       objeto.celular  = ;
//       elementData.push(objeto);
//    }
//    console.log(elementData);

//    document.getElementById("dni").value   = elementData[idCliente].dni; 
//    document.getElementById("phone").value = elementData[idCliente].celular;
// }


// Calcular cuota
$(document).ready(function (){
   $(calcular).click(function (){
         calmonto()
   });
});

function calmonto() 
{
   var monto     =document.getElementById("monto").value;
   var numCuotas =document.getElementById("numCuota").value;
   
   //Interes
   var indice = document.getElementById("type").value;
   
   switch (indice) {
      case "1": 
          interes = 0.1;   
         break;
      case "2": 
          interes = 0.15;   
         break;
      case "3": 
          interes = 0.2;   
         break;
   
      default:  interes=0;
         break;
   }

   monto=parseFloat(monto);
   cuota=parseInt(numCuotas);

   var inter=interes*monto;
   var total=monto+inter;
   var cuota=total/numCuotas;
   cuota=parseFloat(cuota);

   //Muestra los montos calculados
   document.getElementById("monCuota").value = "s/. " + cuota; 
   document.getElementById("monInteres").value = "s/. " + inter; 
   document.getElementById("monTotal").value = "s/. " + total; 

   //Mostrar las cuotas en la tabla
   let data = [];

   //Captura de fecha de inicio de cobro y pago
   //var fecha = document.getElementById("date_ini").value;
   var fecha = new Date(document.getElementById("date_ini").value);

   console.info(fecha);


   //Captura del tipo de prestamo
   var tipo     =document.getElementById("type").value;

   switch (tipo) {
      case "1": 
         var dia = 1;   
         break;
      case "2": 
         var dia = 7; 
         break;
      case "3": 
         var dia = 30;
         break;
      default: var dia=0;
         break;
   }
   

   for (let i = 0; i < numCuotas; i++) {
      let objeto    = {};
      objeto.fecha  = fecha.toISOString().slice(0,10);
      objeto.cuota  = "s/. "+cuota;
      data.push(objeto);
      fecha.setDate(fecha.getDate() + dia);
      }
   console.log(data);

   eliminarRegistros();
   
   var table =document.getElementById("table-cuotas");
   var tbody =table.getElementsByTagName("tbody")[0];

   for (var i = 0; i < data.length; i++) 
   {
         var row = document.createElement("tr");

         var cell1 = document.createElement("td");
         cell1.innerHTML = i+1;
         row.appendChild(cell1);
  
         var cell2 = document.createElement("td");
         cell2.innerHTML = data[i].fecha;
         row.appendChild(cell2);
  
         var cell3 = document.createElement("td");
         cell3.innerHTML = data[i].cuota;
         row.appendChild(cell3);
  
  
         tbody.appendChild(row);
   }
}

//Limpiar campos de tabla cuotas
function eliminarRegistros() {
  var tabla = document.getElementById("table-cuotas");
  var tbody = tabla.getElementsByTagName("tbody")[0];
  
  while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
  }
}

//Mostrar los intereses
$(document).ready(function(){
 $('#type').change(function(){
   
   var indice = document.getElementById("type").value;
   
   switch (indice) {
      case "1": 
          interes = 10;   
         break;
      case "2": 
          interes = 15;   
         break;
      case "3": 
          interes = 20;   
         break;
   
      default:  interes=0;
         break;
   }

   document.getElementById("interes").value = interes +" %"; 

 });
 })



// function mostrarInt() 
// {
//       var indice = document.getElementById("type").value;

//       

//       $id= $_GET['opcion'];
//       $ret=mysqli_query($con,"select * from  tblpresttype where id_type='$id' ");
//       $row=mysqli_fetch_array($ret);
//       

//       document.getElementById("interes").value = ; 
// }  


</script>

