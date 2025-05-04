<?php 
// Include the menu and footer
include ('partial/menu.php');

// Database connection
$servername = "localhost"; // Change to your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "food_order"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching the count of categories from the database
$category_count_sql = "SELECT COUNT(*) as total FROM tbl_categories";
$result = $conn->query($category_count_sql);
$category_count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $category_count = $row['total'];
}

// Fetching other data if necessary (e.g., food count, order count, etc.)
// For example, you can fetch the count of foods
$food_count_sql = "SELECT COUNT(*) as total FROM tbl_food";
$result_food = $conn->query($food_count_sql);
$food_count = 0;
if ($result_food->num_rows > 0) {
    $row_food = $result_food->fetch_assoc();
    $food_count = $row_food['total'];
}

// For orders
$order_count_sql = "SELECT COUNT(*) as total FROM tbl_order";
$result_order = $conn->query($order_count_sql);
$order_count = 0;
if ($result_order->num_rows > 0) {
    $row_order = $result_order->fetch_assoc();
    $order_count = $row_order['total'];
}

// For customers (you may need to change this based on your database structure)
$customer_count_sql = "SELECT COUNT(*) as total FROM tbl_admin";
$result_customer = $conn->query($customer_count_sql);
$customer_count = 0;
if ($result_customer->num_rows > 0) {
    $row_customer = $result_customer->fetch_assoc();
    $customer_count = $row_customer['total'];
}

// Close the database connection
$conn->close();
?>

<!-- Main Section Start -->
<div class="main">
    <div class="wrapper">
        <h1>Dashboard</h1> 
        
        <div class="col-4">
            <h1><?php echo $category_count; ?></h1>
            Categories
        </div>
        
        <div class="col-4">
            <h1><?php echo $food_count; ?></h1>
            Foods
        </div>
        
        <div class="col-4">
            <h1><?php echo $order_count; ?></h1>
            Orders
        </div>
        
        <div class="col-4">
            <h1><?php echo $customer_count; ?></h1>
            Customers
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Section End -->

<?php include('partial/footer.php'); ?>
</body>
</html>
