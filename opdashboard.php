<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body {
    background: #f1f3f6;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    position: fixed;
    background: #0d3b66;
    color: white;
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 12px 20px;
}

.sidebar a:hover {
    background: #0b2f52;
}

/* CONTENT */
.content {
    margin-left: 240px;
}

/* CARD */
.card {
    border-radius: 10px;
}

.topbar {
    background: white;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.logo {
    width: 40px;
    border-radius: 50px;
}

</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="text-center py-4">
        <img src="img/logo.jpg" class="logo mb-2">
        <h6>Hernani LGU</h6>
    </div>

    <a href="#"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="#"><i class="fas fa-users me-2"></i> Beneficiaries</a>
    <a href="#"><i class="fas fa-hand-holding-heart me-2"></i> Aid Distribution</a>
    <a href="#"><i class="fas fa-file-alt me-2"></i> Reports</a>
    <a href="#"><i class="fas fa-user-cog me-2"></i> Users</a>
    <a href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>

</div>

<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Dashboard</h5>

        <div>
            <strong>Admin</strong>
        </div>

    </div>

    <!-- MAIN -->
    <div class="container-fluid mt-4">

        <!-- CARDS -->
        <div class="row g-3">

            <div class="col-md-3">
                <div class="card p-3 text-white" style="background:#0d3b66;">
                    <h6>Total Beneficiaries</h6>
                    <h3>120</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-white" style="background:#f4c430;">
                    <h6>Total Aid Distributed</h6>
                    <h3>350</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-white" style="background:#2a9d8f;">
                    <h6>Barangays Covered</h6>
                    <h3>15</h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 text-white" style="background:#d62828;">
                    <h6>Pending Requests</h6>
                    <h3>8</h3>
                </div>
            </div>

        </div>

        <!-- TABLE / CONTENT -->
        <div class="card mt-4 p-3">
            <h6>Recent Distributions</h6>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Aid Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan Dela Cruz</td>
                        <td>Barangay 1</td>
                        <td>Cash</td>
                        <td>2026-03-18</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>