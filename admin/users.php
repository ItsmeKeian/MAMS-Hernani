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
                    <a class="nav-link " href="beneficiary.php">
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
                    <a class="nav-link active" href="users.php">
                        <i class="fas fa-user-shield"></i>
                        Users
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
                <div>
                    <h1 class="header-title mb-1">Users</h1>
                    <p class="header-subtitle mb-0">Welcome back, Administrator. Here's what's happening today.</p>
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


        <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUser">
                        <i class="fas fa-user-plus"></i> Create User
                    </button>
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
                Users Accounts
            </h5>
        </div>


        <div class="table-responsive">

        <table id="userTable" class="table">

                <thead>

                        <tr>

                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th>Action</th>

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


 
    <div class="modal fade" id="createUser" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Create User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="userForm">

                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Role</label>

                        <select name="role" class="form-control">
                            <option value=""></option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>

                        </select>

                    </div>

                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                         Cancel
                    </button>

                    <button class="btn btn-primary" id="saveUser">
                         Save
                    </button>

                </div>

            </div>
        </div>
</div>


    <div class="modal fade" id="editUser">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="editForm">

                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="text" name="email" id="edit_email" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>New Password</label>
                        <input type="password" name="password" id="edit_password" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Confirm Password</label>
                        <input type="password" id="edit_confirm" class="form-control">
                    </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                    </button>

                    <button class="btn btn-primary" id="updateUser">
                    Update
                    </button>

                </div>

            </div>
        </div>
    </div>



<script src="../assets/js/jquery-4.0.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../js/users.js"></script>

</body>
</html>