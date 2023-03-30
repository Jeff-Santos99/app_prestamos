<aside id="sidebar" class="sidebar">
         <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link " href="index.php"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>
            <!--options customers-->
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#customers-nav" data-bs-toggle="collapse" href="#"> 
                <i class="bi bi-person"></i><span>CLIENTES</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="customers-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li> <a href="list-customer.php"> <i class="bi bi-circle"></i><span>Lista de clientes</span> </a></li>
               </ul>
            </li>

            <!--options prestamos-->
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#prest-nav" data-bs-toggle="collapse" href="#"> 
                <i class="bi-journal-text"></i><span>PRÉSTAMOS</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="prest-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li> <a href="list-prest.php"> <i class="bi bi-circle"></i><span>Lista de préstamo</span> </a></li>
                  <li> <a href="add-typeprest.php"> <i class="bi bi-circle"></i><span>Tipo de préstamo</span> </a></li>
               </ul>
            </li>

             <!--options Reportes-->
            <!-- <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-layout-text-window-reverse"></i><span>Reportes</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li> <a href="tables-general.html"> <i class="bi bi-circle"></i><span>General Tables</span> </a></li>
                  <li> <a href="tables-data.html"> <i class="bi bi-circle"></i><span>Data Tables</span> </a></li>
               </ul>
            </li> -->

            <!--pages-->   
            <li class="nav-heading">Pages</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="users-profile.php"> <i class="bi bi-person"></i> <span>Profile</span> </a></li>
            </ul>
      </aside>