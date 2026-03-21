<?php
require "../php/admin_only.php";
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
                        <h1 class="header-title mb-1">Beneficiaries</h1>
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


        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">

                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-user-plus"></i> Add Beneficiary
                    </button>
                 

                </div>

                <div class="d-flex flex-column flex-md-row gap-2">

                       
                <input
                    id="searchInput"
                    type="text"
                    class="form-control"
                    placeholder="Search name...">

                    <select id="filterBarangay" class="form-select">

                            <option value="">All Barangay</option>
                            <option value="nagaja">Nagaja</option>
                            <option value="padang">Padang</option>
                            <option value="poblacion">Poblacion</option>

                         </select>

                        

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
                                Beneficiary Records
                            </h5>
                        </div>


                        <div class="table-responsive">

                        <table id="beneficiaryTable" class="table">

                                <thead>

                                        <tr>

                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Age</th>
                                                <th>Contact</th>
                                                <th>Occupation</th>
                                                <th>Ownership</th>
                                                <th>Damage</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                        </tr>

                                </thead>

                            <tbody>

                            </tbody>

                            </table>


                            <div class="modal-dialog modal-xl modal-fullscreen-md-down modal-dialog-scrollable">

                        <div id="recordCount"></div>

                        </div>

                        <ul class="pagination justify-content-center"></ul>

                        </div>

                    </div>

                </div>

        </div>
                    

        </div> <!-- page-content -->

    </div> <!-- main-content -->


        <!-- ADD BENEFICIARY MODAL -->
        <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-scrollable">
                <div class="modal-content">

                <div class="modal-header">
                    <h5>Add Beneficiary</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">


                    <form id="beneficiaryForm">

                            <!-- ================= LOCATION ================= -->

                            <h5 class="mb-3 text-primary">
                                Location of Affected Family
                            </h5>

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label>Region</label>
                                    <input type="text" name="region" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Province</label>
                                    <input type="text" name="province" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Municipality</label>
                                    <input type="text" name="municipality" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Barangay</label>
                                    <input type="text" name="barangay" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>District</label>
                                    <input type="text" name="district" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Evacuation Site</label>
                                    <input type="text" name="evacuation" class="form-control">
                                </div>

                            </div>

                            <hr>
                            <!-- ================= HEAD ================= -->

                <h5 class="mb-3 text-primary">
                    Head of Family
                </h5>

                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Name Extension</label>
                                <input type="text" name="name_ext" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Birthdate</label>
                                <input type="date" name="birthdate" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Age</label>
                                <input type="number" name="age" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Place of Birth</label>
                                <input type="text" name="place_of_birth" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Sex</label>
                                    <select name="sex" class="form-select">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Civil Status</label>
                                <input type="text" name="civil_status" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Mother's Maiden Name</label>
                                <input type="text" name="mothers_maiden_name" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Religion</label>
                                <input type="text" name="religion" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Occupation</label>
                                <input type="text" name="occupation" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Monthly Income</label>
                                <input type="number" name="monthly_income" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>ID Card Presented</label>
                                <input type="text" name="id_card_presented" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>ID Number</label>
                                <input type="text" name="id_number" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control">
                            </div>

                    </div>


                            <hr>


                            <!-- ================= ADDRESS ================= -->

                    <h5 class="mb-3 text-primary">
                        Permanent Address
                    </h5>

                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label>House No</label>
                                <input type="text" name="house_no" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Sitio</label>
                                <input type="text" name="sitio" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Barangay</label>
                                <input type="text" name="addr_barangay" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="addr_city" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Province</label>
                                <input type="text" name="addr_province" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Zip Code</label>
                                <input type="text" name="zip_code" class="form-control">
                            </div>

                    </div>


                            <hr>

                    <h5 class="mb-3 text-primary">
                    Others
                    </h5>

                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label>
                                <input type="checkbox" name="is_4ps" value="1">
                                4Ps Beneficiary
                                </label>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>IP Type</label>
                                <input type="text" name="ip_type" class="form-control">
                            </div>

                        </div>

                            <hr>


                            <!-- ================= FAMILY MEMBERS ================= -->

                            <h5 class="mb-3 text-primary">
                                Family Information
                                </h5>
                             <div class="table-responsive">
                                <table class="table table-bordered" id="familyTable">

                                <thead>

                                <tr>

                                <th>Family Member</th>
                                <th>Relation</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Education</th>
                                <th>Occupation</th>
                                <th>Vulnerability</th>
                                <th></th>

                                </tr>

                                </thead>

                                <tbody>

                                </tbody>

                                </table>
                             </div>

                                <button
                                type="button"
                                class="btn btn-sm btn-primary"
                                id="addFamilyRow">

                                Add Member

                                </button>

                                <hr>


                            <!-- ================= ACCOUNT ================= -->

                            <h5 class="mb-3 text-primary">
                                Account Information
                            </h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Bank / E-wallet</label>
                                    <input type="text" name="bank" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Account Name</label>
                                    <input type="text" name="account_name" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Account Type</label>
                                    <input type="text" name="account_type" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Account Number</label>
                                    <input type="text" name="account_number" class="form-control">
                                </div>

                            </div>


                            <hr>


                            <!-- ================= DAMAGE ================= -->
                            <h5 class="mb-3 text-primary">
                            House Damage Info
                            </h5>

                            <div class="row">

                                <div class="col-md-6">

                                    <label>Ownership</label><br>

                                    <input type="radio" name="ownership" value="Owner"> Owner
                                    <input type="radio" name="ownership" value="Renter"> Renter
                                    <input type="radio" name="ownership" value="Sharer"> Sharer

                                </div>

                            <div class="col-md-6">

                                    <label>Damage</label><br>

                                    <input type="radio" name="damage" value="Partially Damage"> Partially Damaged
                                    <input type="radio" name="damage" value="Totally Damage"> Totally Damaged

                            </div>

                        </div>


                            <hr>

                            <div class="col-md-12 mb-3">
                                <label>Date Registered</label>
                                <input type="date" name="date_registered" class="form-control">
                            </div>


                            <div class="mt-3">

                                <button type="button" id="saveBeneficiary" class="btn btn-success">
                                    Save Beneficiary
                                </button>

                                <a href="beneficiary.php" class="btn btn-secondary">
                                    Cancel
                                </a>

                            </div>

                            </form>


                    </div>

                </div>
            </div>
        </div>
 



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

</script>

</body>
</html>