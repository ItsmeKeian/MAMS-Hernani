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
    
    <style>
        /* Modern AdminLTE Settings Styles */
        :root {
            --card-bg: #ffffff;
            --card-shadow: 0 0 20px 0 rgba(0,0,0,0.05);
            --card-shadow-hover: 0 10px 30px 0 rgba(0,0,0,0.1);
            --border-radius: 16px;
            --primary-blue: #007bff;
            --primary-blue-dark: #0056b3;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }

        .settings-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .settings-card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-4px);
        }

        .card-header-modern {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
            border: none;
            padding: 24px 28px;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .card-title-modern {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-title-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark));
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 12px;
        }

        .card-body-modern {
            padding: 28px;
        }

        /* Top Stats Cards */
        .stat-card {
            text-align: center;
            padding: 24px 16px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-dark));
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-primary .stat-number { color: var(--primary-blue); }
        .stat-success .stat-number { color: var(--success); }
        .stat-warning .stat-number { color: var(--warning); }
        .stat-info .stat-number { color: #17a2b8; }

        .stat-label {
            font-size: 14px;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-modern {
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            margin: 12px 0;
            overflow: hidden;
        }

        .progress-bar-modern {
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-dark));
            border-radius: 3px;
            transition: width 2s ease;
        }

        /* Info Items */
        .info-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .info-value {
            color: #6c757d;
            font-size: 15px;
        }

        /* Buttons */
        .btn-modern {
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,123,255,0.3);
        }

        .btn-modern i {
            font-size: 16px;
        }

        /* About Section */
        .about-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 40px 32px;
        }

        .about-logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .stat-number { font-size: 28px !important; }
            .card-body-modern { padding: 20px !important; }
        }
    </style>
</head>
<body>
    <!-- Sidebar [UNCHANGED] -->
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
                    <a class="nav-link active" href="settings.php">
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

    <!-- Main Content [UNCHANGED] -->
    <div class="main-content">
        <!-- Header [UNCHANGED] -->
        <header class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-primary d-lg-none me-2" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title mb-1">Settings</h1>
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

        <!-- Page Content [REDESIGNED] -->
        <div class="page-content p-4">
            <!-- TOP CARDS ROW -->
            <div class="row g-4 mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="settings-card stat-card stat-primary">
                        <div class="stat-number" id="dbSize">1.24 GB</div>
                        <div class="stat-label">Database Size</div>
                        <div class="progress-modern">
                            <div class="progress-bar-modern" style="width: 65%"></div>
                        </div>
                        <small class="text-success fw-bold">✓ Under limit</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="settings-card stat-card stat-success">
                        <div class="stat-number" id="lastBackup"></div>
                        <div class="stat-label">Last Backup</div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="settings-card stat-card stat-info">
                        <div class="stat-number" id="serverTime"></div>
                        <div class="stat-label">Server Time</div>
                        <small class="text-muted">UTC+8</small>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="settings-card stat-card stat-warning">
                        <div class="stat-number" id="backupCount">5</div>
                        <div class="stat-label">Total Backups</div>
                        <span id="backupSizeText">0 B</span> used
                    </div>
                </div>
            </div>

            <!-- SECOND ROW -->
            <div class="row g-4 mb-4">
                <!-- LEFT: Server Information -->
                <div class="col-lg-6">
                    <div class="settings-card h-100">
                        <div class="card-header-modern">
                            <h5 class="card-title-modern">
                                <div class="card-title-icon">
                                    <i class="fas fa-server"></i>
                                </div>
                                Server Information
                            </h5>
                        </div>
                        <div class="card-body-modern">
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, #6f42c1, #5a1f8e)">
                                    <i class="fab fa-php"></i>
                                </div>
                                <div>
                                    <div class="info-label">PHP Version</div>
                                    <div class="info-value" id="phpVersion">8.2.4</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, #28a745, #1e7e34)">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div>
                                    <div class="info-label">Database Name</div>
                                    <div class="info-value" id="dbName"></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg,rgb(45, 50, 126),rgb(0, 43, 160))">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div>
                                    <div class="info-label">MySQL Version</div>
                                    <div class="info-value" id="mysqlVersion"></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, #17a2b8, #117a8b)">
                                    <i class="fas fa-hdd"></i>
                                </div>
                                <div>
                                    <div class="info-label">Storage Used</div>
                                    <div class="info-value" id="storageUsed">Loading...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Maintenance -->
                <div class="col-lg-6">
                    <div class="settings-card h-100">
                        <div class="card-header-modern">
                            <h5 class="card-title-modern">
                                <div class="card-title-icon">
                                    <i class="fas fa-tools"></i>
                                </div>
                                Maintenance
                            </h5>
                        </div>
                        <div class="card-body-modern">
                            <button id="backupBtn" class="btn btn-primary btn-modern mb-3">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Create Backup Now
                            </button>
                            <button id="clearLogs" class="btn btn-outline-danger btn-modern mb-2">
                                <i class="fas fa-trash-alt"></i>
                                Clear Logs (47.2 MB)
                            </button>
                            <button id="clearBackup" class="btn btn-outline-warning btn-modern">
                                <i class="fas fa-archive"></i>
                                Clear Old Backups (<span id="backupSize">0 MB</span>)
                            </button>
                        </div>
                    </div>
                </div>
            </div>

         
        </div> <!-- page-content -->

    </div> <!-- main-content -->

    <script src="../assets/js/jquery-4.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../js/settings.js"></script>

    <script>
        // Keep your existing sidebar toggle
        $("#menuToggle").click(function () {
            $(".sidebar").toggleClass("show");
        });

        // Close sidebar when clicking outside (mobile)
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