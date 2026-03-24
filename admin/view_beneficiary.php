<?php

require "../php/dbconnect.php";
require "../php/admin_only.php";

$id = $_GET["id"];

/* BENEFICIARY */

$stmt = $conn->prepare("
SELECT * FROM beneficiaries
WHERE id = ?
");

$stmt->execute([$id]);

$b = $stmt->fetch(PDO::FETCH_ASSOC);


/* FAMILY */

$famStmt = $conn->prepare("
SELECT * FROM family_members
WHERE beneficiary_id = ?
");

$famStmt->execute([$id]);

$family = $famStmt->fetchAll(PDO::FETCH_ASSOC);


/* ASSISTANCE RECORDS */

$recStmt = $conn->prepare("
SELECT * FROM assistance_records
WHERE beneficiary_id = ?
ORDER BY date_received ASC
");

$recStmt->execute([$id]);

$records = $recStmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../assets/css/print_dswdform.css">
    

   
  
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
                    <a class="nav-link active" href="beneficiary.php">
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
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-user-shield"></i>
                        Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logs.php">
                    <i class="fas fa-clipboard-list"></i>
                        Logs
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
                        <h1 class="header-title mb-1">Print Beneficiary</h1>
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

            



            <div class="d-flex justify-content-between mb-3">

                <div>
                    <a href="beneficiary.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div>
                    <button class="btn btn-primary" onclick="printForm()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>

            </div>


                <div class="print-preview">


               <!-- FRONT PAGE -->

                <div class="print-page">

                <div class="form-copy">
                <div class="form">
                <?php include "form_front.php"; ?>
                </div>
                </div>

                <div class="form-copy">
                <div class="form">
                <?php include "form_back.php"; ?>
                </div>
                </div>

                </div>





                    </div>



                </div>


           

    </div> <!-- main-content -->


 



<script src="../assets/js/jquery-4.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../js/beneficiary.js"></script>

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



function printForm() {
    window.print();
}

$("#menuToggle").click(function () {
    $(".sidebar").toggleClass("show");
});

</script>

</body>
</html>