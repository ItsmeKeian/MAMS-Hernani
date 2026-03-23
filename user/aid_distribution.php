<?php
require "../php/user_only.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipal Aid Monitoring System - Municipality of Hernani</title>
    <link href="../assets/img/logo.jpg" rel="icon">
    <!-- Bootstrap 5 CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->

    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    
  
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <!-- Philippine Municipality Logo Placeholder -->
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 12px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: #1e3a8a; font-weight: bold;">
                <img class="logo" src="../assets/img/logo.jpg" alt="logo">
            </div>
            <h4 class="sidebar-title mb-1">Municipality of Hernani</h4>
            
        </div>

        <nav class="sidebar-nav mt-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link " href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beneficiary.php">
                        <i class="fas fa-users"></i>
                        Beneficiaries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="aid_distribution.php">
                        <i class="fas fa-boxes"></i>
                        Aid Distribution
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">
                        <i class="fas fa-file-alt"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">
                    <i class="fas fa-gear"></i>
                        Settings
                    </a>
                </li>

                <li class="nav-item mt-auto">
                    <a class="nav-link" href="../php/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
         <header class="header">
            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <button class="btn btn-outline-primary d-lg-none me-2" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div>
                        <h1 class="header-title mb-1">Aid Distribution</h1>
                        <p class="header-subtitle mb-0">
                        Welcome back, Administrator. Here's what's happening today.
                        </p>
                    </div>

                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="../assets/img/logo.jpg" class="rounded-circle me-2" width="40" height="40" alt="Admin">
                            <span class="d-none d-md-inline fw-semibold">Administrator</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../php/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        

        <!-- Page Content -->
        <div class="page-content">


        


        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">

            <div class="d-flex flex-wrap gap-2">
                   
                    <a id="exportBtn"
                    href="../php/export/export_aid_distribution.php"
                    class="btn btn-success">
                    Export Excel
                    </a>

                    <a id="printBtn"
                    href="../php/print/print_aid_distribution.php"
                    target="_blank"
                    class="btn btn-primary ">
                    Print Report
                    </a>

                </div>

                <div class="d-flex flex-wrap gap-2">

                        <input
                            type="date"
                            id="dateFrom"
                            class="form-control" style="width:150px">

                        <input
                            type="date"
                            id="dateTo"
                            class="form-control" style="width:150px">

                <input
                        id="searchInput"
                        type="text"
                        class="form-control"
                        placeholder="Search name..." style="width:150px">

                        <select id="filterBarangay" class="form-select" style="width:150px">

                            <option value="">All Barangay</option>
                            <option value="Poblacion 01">Poblacion 01</option>
                            <option value="Poblacion 02">Poblacion 02</option>
                            <option value="Poblacion 03">Poblacion 03</option>
                            <option value="Poblacion 04">Poblacion 04</option>
                            <option value="Canciledes">Canciledes</option>
                            <option value="Padang">Padang</option>
                            <option value="Nagaja">Nagaja</option>
                            <option value="Carmen">Carmen</option>
                            <option value="San Isidro">San Isidro</option>
                            <option value="Batang">Batang</option>
                            <option value="Garawon">Garawon</option>
                            <option value="Cacatmonan">Cacatmonan</option>
                            <option value="San Miguel">San Miguel</option>

                         </select>


                       

                        

                </div>

            </div>


            <div class="row g-4 mb-4">

            <!-- Total Distribution -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card blue">

                    <div class="stat-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>

                    <div>
                        <h3 id="totalCount" class="stat-number">0</h3>
                        <p class="stat-label">Total Distribution</p>
                    </div>

                </div>
            </div>


            <!-- Total Items -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card yellow">

                    <div class="stat-icon">
                        <i class="fas fa-boxes"></i>
                    </div>

                    <div>
                        <h3 id="qtyCount" class="stat-number">0</h3>
                        <p class="stat-label">Total Items</p>
                    </div>

                </div>
            </div>


            <!-- Total Cost -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card red">

                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>

                    <div>
                        <h3 id="costCount" class="stat-number">0</h3>
                        <p class="stat-label">Total Cost</p>
                    </div>

                </div>
            </div>


            <!-- Beneficiaries Served -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card green">

                    <div class="stat-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>

                    <div>
                        <h3 id="beneficiaryCount" class="stat-number">0</h3>
                        <p class="stat-label">Beneficiaries Served</p>
                    </div>

                </div>
            </div>

            </div>

            
            <!-- Stats Cards Row -->
           

            <!-- Recent Records & Summary Cards -->
            <div class="row g-4">
                <!-- Recent Aid Distribution -->
               

<div class="col-12">

    <div class="table-container">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2 text-gold"></i>
                Aid Distribution
            </h5>
        </div>


        <div class="table-responsive">

        <table id="beneficiaryTable" class="table">

                <thead>

                        <tr>

                                
                                <th>Name Received</th>
                                <th>Disaster</th>
                                <th>Assistance</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                                <th>Provider</th>
                                <th>Date Received</th>
                               
                        </tr>

                </thead>

            <tbody>

            </tbody>

            </table>


            <div class="d-flex justify-content-between mt-2">

        <div id="recordCount"></div>

        </div>

        <ul class="pagination justify-content-center"></ul>

        </div>

    </div>

</div>

</div>
                    

</div> <!-- page-content -->
</div> <!-- main-content -->


 
<!-- 50% -->


<script src="../assets/js/jquery-4.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../js/aid_distribution.js"></script>

<script>

$("#menuToggle").click(function () {

    $(".sidebar").toggleClass("show");

});


// close sidebar when clicking outside (mobile)

$(document).click(function (e) {

    if (
        !$(e.target).closest(".sidebar").length &&
        !$(e.target).closest("#menuToggle").length
    ) {
        $(".sidebar").removeClass("show");
    }

});

</script>
</body>
</html>