<?php
include('admin/database_connection.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from the form and escape special characters
    $food = mysqli_real_escape_string($conn, $_POST['food']);
    $price = floatval($_POST['price']);
    $qty = intval($_POST['qty']);
    $total = $price * $qty;

    $order_date = date("Y-m-d H:i:s"); // current date and time
    $status = "Ordered"; // default status

    // Customer data
    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

    // Ensure the data is valid
    if (empty($food) || empty($customer_name) || empty($customer_contact) || empty($customer_email) || empty($customer_address) || $qty <= 0) {
        echo "<script>
                alert('Please fill in all fields correctly.');
                window.history.back();
              </script>";
        exit();
    }

    // Prepare the SQL query to prevent SQL injection
    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
            VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'billing.php?order_id=" . mysqli_insert_id($conn) . "';
              </script>";
    } else {
        echo "<script>
                alert('Failed to place order. Please try again.');
                window.history.back();
              </script>";
    }
} else {
    // Redirect if accessed directly
    header('Location: index.php');
    exit();
}
?>
