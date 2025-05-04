<?php
include('partial/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <script src="script.js" defer></script>
</head>
<body>

<!-- Sidebar Start -->
<div class="sidebar">
  <div class="sidebar-header">
    <h2>Admin Dashboard</h2>
  </div>
  <ul class="sidebar-menu">
    <li><a href="index.php">Dashboard</a></li>
    <li><a href="manage-categories.php">Manage Categories</a></li>
    <li><a href="manage-food.php">Manage Food</a></li>
    <li><a href="orders.php">Orders</a></li>
    <li><a href="settings.php">Settings</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>

<!-- Toggle Button for Sidebar on Small Screens -->
<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
<!-- Sidebar End -->

<!-- Main Section Start -->
<div class="main">
    <div class="wrapper">
        <h1>Dashboard</h1> 
        <div class="col-4">
            <h1>5</h1>
            Categories
        </div>
        <div class="col-4">
            <h1>5</h1>
            Food Items
        </div>
        <div class="col-4">
            <h1>5</h1>
            Orders
        </div>
        <div class="col-4">
            <h1>5</h1>
            Active Users
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Section End -->

<?php include('partial/footer.php'); ?>

</body>
</html>
