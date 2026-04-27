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
                    <a class="nav-link active" href="dashboard.php">
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
                    <a class="nav-link" href="aid_distribution.php">
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
                        <h1 class="header-title mb-1">Dashboard</h1>
                        <p class="header-subtitle mb-0">
                            Welcome back, User Name.
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
            <!-- Stats Cards Row -->
            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card blue">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 id="totalBen" class="stat-number">0</h3>
                            <p class="stat-label">Total Registered Beneficiaries</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card yellow">
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <h3 id="totalAid" class="stat-number">0</h3>
                            <p class="stat-label">Total Assistance Records</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card green">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 id="totalQty" class="stat-number">0</h3>
                            <p class="stat-label">Total Quantity Released</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card red">
                        <div class="stat-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <h3 id="totalCost" class="stat-number">0</h3>
                            <p class="stat-label">Total Assistance Cost</p>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Charts Row -->
                <div class="row g-4">

                <!-- Chart 1 -->
                <div class="col-lg-6">
                    <div class="card p-3">
                        <h5>Beneficiaries per Barangay</h5>

                        <div style="height:300px">
                            <canvas id="brgyChart"></canvas>
                        </div>

                    </div>
                </div>

                <!-- Chart 2 -->
                <div class="col-lg-6">
                    <div class="card p-3">
                        <h5>Aid Distribution per Month</h5>

                        <div style="height:300px">
                            <canvas id="monthChart"></canvas>
                        </div>

                    </div>
                </div>

                </div>


                <!-- Full Width Chart -->
                <div class="row g-4 mt-1">

                <!-- Items -->
                <div class="col-lg-6">

                    <div class="card p-3">

                        <h5>Items Distribution</h5>

                        <div style="height:300px">
                            <canvas id="itemsChart"></canvas>
                        </div>

                    </div>

                </div>


                <!-- Disaster -->
                <div class="col-lg-6">

                    <div class="card p-3">

                        <h5>Assistance per Disaster Type</h5>

                        <div style="height:300px">
                            <canvas id="disasterChart"></canvas>
                        </div>

                    </div>

                </div>

                </div>
           
            </div>

        </div> <!-- page-content -->

    </div> <!-- main-content -->
    
<script src="../assets/js/jquery-4.0.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/dashboard.js"></script>

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