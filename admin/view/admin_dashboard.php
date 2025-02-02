<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location:../../layout/view/login.php"); // Redirect to login page if not logged in
}
$adminUsername = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>


    

<div class="main-content">
    <h1>Welcome, <?php echo $adminUsername; ?></h1>
    
        <a href="../view/admin_info.php">View Admin Info</a>
        <a href="../view/admin_profile.php">Admin Profile</a>
       
       


    <h2>Dashboard Features</h2>
    <p>Here you can manage admins, view reports, and perform other administrative tasks.</p>
    <div class="navbar">
        <a href="../view/admin_dashboard.php">Admin</a>
        <a href="../view/seller_info.php">Seller Info</a>
        <a href="../view/buyer_info.php">Buyer Info</a>
        <a href="../view/employee_info.php">Employee Info</a>
        <a href="../view/delivery_info.php">Delivery Man Info</a>
        <a href="../../layout/view/login.php">Logout</a>
    </div>
    

    <form action="../../employee/view/employee_orders.php" method="GET">
        <button type="submit" name="viewAll" value="true">View All Sellers</button>
    </form>
   
    




























</div>
</body>
</html>
