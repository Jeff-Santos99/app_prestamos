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
      <title>Dashboard - Admin Préstamo</title>
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
            <h1>Dashboard</h1>
            <nav>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </nav>
         </div>
<?php 
$ret=mysqli_query($con,"SELECT SUM(monto) Total_pres, SUM(total_pago) Pagos, SUM(total_pago)-SUM(monto) intereses,COUNT(id_customer) Clientes 
               FROM tblprest");
$row=mysqli_fetch_array($ret);
?>
         <section class="section dashboard">
            <div class="row">
               <div class="col-lg-8">
                  <div class="row">
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Total</a></li>
                                 <li><a class="dropdown-item" href="#">Este Mes</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Prestamos <span>| Total</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-dollar"></i></div>
                                 <div class="ps-3">
                                    <h6><?php echo "s/ ".$row['Total_pres'];?></h6>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Intereses <span>| Total</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-dollar"></i></div>
                                 <div class="ps-3">
                                    <h6><?php echo "s/ ".$row['Pagos'];?></h6>
                                    <span class="text-success small pt-1 fw-bold">Ganancia</span> <span class="text-muted small pt-2 ps-1"><?php echo "s/ ".$row['intereses'];?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Clientes <span>| Total</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-people"></i></div>
                                 <div class="ps-3">
                                    <h6><?php echo $row['Clientes'];?></h6>
                                    <span class="text-muted small pt-2 ps-1">Clientes</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12">
                        <div class="card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>

                           <!--Table reportes-->
                           <div class="card-body">
                              <h5 class="card-title">Reportes</h5>
                              <div id="reportsChart"></div>
                              <script>document.addEventListener("DOMContentLoaded", () => {
                                 new ApexCharts(document.querySelector("#reportsChart"), {
                                   series: [{
                                     name: 'Sales',
                                     data: [31, 40, 28, 51, 42, 82, 56],
                                   }, {
                                     name: 'Revenue',
                                     data: [11, 32, 45, 32, 34, 52, 41]
                                   }, {
                                     name: 'Customers',
                                     data: [15, 11, 32, 18, 9, 24, 11]
                                   }],
                                   chart: {
                                     height: 350,
                                     type: 'area',
                                     toolbar: {
                                       show: false
                                     },
                                   },
                                   markers: {
                                     size: 4
                                   },
                                   colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                   fill: {
                                     type: "gradient",
                                     gradient: {
                                       shadeIntensity: 1,
                                       opacityFrom: 0.3,
                                       opacityTo: 0.4,
                                       stops: [0, 90, 100]
                                     }
                                   },
                                   dataLabels: {
                                     enabled: false
                                   },
                                   stroke: {
                                     curve: 'smooth',
                                     width: 2
                                   },
                                   xaxis: {
                                     type: 'datetime',
                                     categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                   },
                                   tooltip: {
                                     x: {
                                       format: 'dd/MM/yy HH:mm'
                                     },
                                   }
                                 }).render();
                                 });
                              </script> 
                           </div>
                        </div>
                     </div>

                     <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Recent Sales <span>| Today</span></h5>
                              <table class="table table-borderless datatable">
                                 <thead>
                                    <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">Customer</th>
                                       <th scope="col">Product</th>
                                       <th scope="col">Price</th>
                                       <th scope="col">Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <th scope="row"><a href="#">#2457</a></th>
                                       <td>Brandon Jacob</td>
                                       <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                       <td>$64</td>
                                       <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                       <th scope="row"><a href="#">#2147</a></th>
                                       <td>Bridie Kessler</td>
                                       <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                       <td>$47</td>
                                       <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                       <th scope="row"><a href="#">#2049</a></th>
                                       <td>Ashleigh Langosh</td>
                                       <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                       <td>$147</td>
                                       <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                       <th scope="row"><a href="#">#2644</a></th>
                                       <td>Angus Grady</td>
                                       <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                       <td>$67</td>
                                       <td><span class="badge bg-danger">Rejected</span></td>
                                    </tr>
                                    <tr>
                                       <th scope="row"><a href="#">#2644</a></th>
                                       <td>Raheem Lehner</td>
                                       <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                       <td>$165</td>
                                       <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-lg-4">
                  <div class="card">
                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Today</a></li>
                           <li><a class="dropdown-item" href="#">This Month</a></li>
                           <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                     </div>
                  </div>

                  <div class="card">
                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Today</a></li>
                           <li><a class="dropdown-item" href="#">This Month</a></li>
                           <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                     </div>
                     <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>
                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                           var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                             legend: {
                               data: ['Allocated Budget', 'Actual Spending']
                             },
                             radar: {
                               // shape: 'circle',
                               indicator: [{
                                   name: 'Sales',
                                   max: 6500
                                 },
                                 {
                                   name: 'Administration',
                                   max: 16000
                                 },
                                 {
                                   name: 'Information Technology',
                                   max: 30000
                                 },
                                 {
                                   name: 'Customer Support',
                                   max: 38000
                                 },
                                 {
                                   name: 'Development',
                                   max: 52000
                                 },
                                 {
                                   name: 'Marketing',
                                   max: 25000
                                 }
                               ]
                             },
                             series: [{
                               name: 'Budget vs spending',
                               type: 'radar',
                               data: [{
                                   value: [4200, 3000, 20000, 35000, 50000, 18000],
                                   name: 'Allocated Budget'
                                 },
                                 {
                                   value: [5000, 14000, 28000, 26000, 42000, 21000],
                                   name: 'Actual Spending'
                                 }
                               ]
                             }]
                           });
                           });
                        </script> 
                     </div>
                  </div>


                  <div class="card">
                     <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                           <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                           </li>
                           <li><a class="dropdown-item" href="#">Today</a></li>
                           <li><a class="dropdown-item" href="#">This Month</a></li>
                           <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                     </div>
                     <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>
                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                        <script>document.addEventListener("DOMContentLoaded", () => {
                           echarts.init(document.querySelector("#trafficChart")).setOption({
                             tooltip: {
                               trigger: 'item'
                             },
                             legend: {
                               top: '5%',
                               left: 'center'
                             },
                             series: [{
                               name: 'Access From',
                               type: 'pie',
                               radius: ['40%', '70%'],
                               avoidLabelOverlap: false,
                               label: {
                                 show: false,
                                 position: 'center'
                               },
                               emphasis: {
                                 label: {
                                   show: true,
                                   fontSize: '18',
                                   fontWeight: 'bold'
                                 }
                               },
                               labelLine: {
                                 show: false
                               },
                               data: [{
                                   value: 1048,
                                   name: 'Search Engine'
                                 },
                                 {
                                   value: 735,
                                   name: 'Direct'
                                 },
                                 {
                                   value: 580,
                                   name: 'Email'
                                 },
                                 {
                                   value: 484,
                                   name: 'Union Ads'
                                 },
                                 {
                                   value: 300,
                                   name: 'Video Ads'
                                 }
                               ]
                             }]
                           });
                           });
                        </script> 
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