<?php

    session_start();


    if(!isset($_SESSION["user"])){

        header("Location: index.html");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Municipal Aid Monitoring System - Municipality of Hernani</title>
    <link href="assets/img/logo.jpg" rel="icon">
    <!-- Bootstrap 5 CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    
  
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <!-- Philippine Municipality Logo Placeholder -->
            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 12px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; color: #1e3a8a; font-weight: bold;">
                <img class="logo" src="assets/img/logo.jpg" alt="logo">
            </div>
            <h4 class="sidebar-title mb-1">Municipality of Hernani</h4>
            
        </div>

        <nav class="sidebar-nav mt-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-users"></i>
                        Beneficiaries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-boxes"></i>
                        Aid Distribution
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-file-alt"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user-shield"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link" href="php/logout.php">
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
                    <h1 class="header-title mb-1">Dashboard</h1>
                    <p class="header-subtitle mb-0">Welcome back, Administrator. Here's what's happening today.</p>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="assets/img/logo.jpg" class="rounded-circle me-2" width="40" height="40" alt="Admin">
                            <span class="d-none d-md-inline fw-semibold">Administrator</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="php/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
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
                            <h3 class="stat-number">1,247</h3>
                            <p class="stat-label">Total Beneficiaries</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card yellow">
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <h3 class="stat-number">892</h3>
                            <p class="stat-label">Aid Packages</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card green">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="stat-number">756</h3>
                            <p class="stat-label">Distributed</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card red">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3 class="stat-number">136</h3>
                            <p class="stat-label">Pending</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Records & Summary Cards -->
            <div class="row g-4">
                <!-- Recent Aid Distribution -->
                <div class="col-12">
                    <div class="table-container">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2 text-gold"></i>Recent Aid Distribution</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Beneficiary</th>
                                        <th>Aid Type</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Barangay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                    JR
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Juan R. Santos</div>
                                                    <small class="text-muted">ID: BEN-001247</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fw-semibold">Food Pack</span></td>
                                        <td>2024-01-15</td>
                                        <td>₱2,500</td>
                                        <td><span class="badge badge-completed"><i class="fas fa-check me-1"></i>Completed</span></td>
                                        <td>Barangay 1</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                    MP
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Maria P. Reyes</div>
                                                    <small class="text-muted">ID: BEN-001246</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fw-semibold">Financial Aid</span></td>
                                        <td>2024-01-14</td>
                                        <td>₱5,000</td>
                                        <td><span class="badge badge-approved"><i class="fas fa-check-circle me-1"></i>Approved</span></td>
                                        <td>Barangay 5</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                    AG
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Ana G. Lopez</div>
                                                    <small class="text-muted">ID: BEN-001245</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fw-semibold">Medical Aid</span></td>
                                        <td>2024-01-13</td>
                                        <td>₱3,200</td>
                                        <td><span class="badge badge-pending"><i class="fas fa-clock me-1"></i>Pending</span></td>
                                        <td>Barangay 3</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; font-size: 0.85rem;">
                                                    PC
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">Pedro C. Garcia</div>
                                                    <small class="text-muted">ID: BEN-001244</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fw-semibold">Food Pack</span></td>
                                        <td>2024-01-12</td>
                                        <td>₱2,500</td>
                                        <td><span class="badge badge-completed"><i class="fas fa-check me-1"></i>Completed</span></td>
                                        <td>Barangay 7</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        