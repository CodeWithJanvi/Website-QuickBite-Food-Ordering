<?php

include('admin/database_connection.php');

if (!isset($_GET['order_id'])) {
    echo "Order not found!";
    exit();
}

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM tbl_order WHERE id = $order_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Billing | Quick Delivery & Delicious Meals</title>
    <style>
    /* Reset margin and padding for the whole page */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Header styles */
    header {
        background-color: coral; /* Coral background */
        color: white; /* White text */
        padding: 20px;
        text-align: center;
    }

    header h1 {
        margin: 0;
        font-size: 2.5em;
    }

    /* Container for the billing details */
    .container {
        max-width: 900px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .container p {
        font-size: 16px;
        margin: 10px 0;
    }

    .container .total-price {
        font-size: 18px;
        font-weight: bold;
        color: #28a745;
    }

    .container .btn {
        display: inline-block;
        background-color: #ff6f61;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 8px;
        margin-top: 20px;
        text-align: center;
        transition: background-color 0.3s;
    }

    .container .btn:hover {
        background-color: #e55c50;
    }

    /* Footer styles */
    footer {
        background-color: coral; /* Coral background */
        color: white; /* White text */
        padding: 20px;
        text-align: center;
        margin-top: 50px;
    }

    footer p {
        margin: 0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        header h1 {
            font-size: 2em;
        }

        .container p {
            font-size: 14px;
        }
    }
</style>


</head>
<body>

<header>
    <h1>Food Ordering System</h1>
    <p>Quick Delivery & Delicious Meals</p>
</header>

<div class="container">
    <h2>Billing Information</h2>
    <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
    <p><strong>Food:</strong> <?php echo $row['food']; ?></p>
    <p><strong>Quantity:</strong> <?php echo $row['qty']; ?></p>
    <p><strong>Total:</strong> ₹<?php echo $row['total']; ?></p>
    <p><strong>Name:</strong> <?php echo $row['customer_name']; ?></p>
    <p><strong>Contact:</strong> <?php echo $row['customer_contact']; ?></p>
    <p><strong>Address:</strong> <?php echo $row['customer_address']; ?></p>

    <form action="checkout.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <button type="submit" class="btn">Proceed to Checkout</button>
    </form>
</div>

<footer>
    <p>&copy; 2025 Food Ordering System. All rights reserved.</p>
</footer>

</body>
</html>


