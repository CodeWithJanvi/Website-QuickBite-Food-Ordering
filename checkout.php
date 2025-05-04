<?php
// Include database connection
include('admin/database_connection.php');

// Fetch order details
if (!isset($_POST['order_id'])) {
    echo "Order ID missing!";
    exit();
}

$order_id = $_POST['order_id'];
$sql = "SELECT * FROM tbl_order WHERE id = $order_id";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Quick Delivery & Delicious Meals</title>
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
            background-color: coral;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        /* Checkout container styles */
        .checkout-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .checkout-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .checkout-container .order-summary {
            font-size: 16px;
            margin: 20px 0;
        }

        .checkout-container .order-summary p {
            margin: 10px 0;
        }

        .checkout-container .thankyou-message {
            text-align: center;
            font-size: 22px;
            color: #28a745;
            font-weight: bold;
            margin: 30px 0;
        }

        .checkout-container .btn {
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

        .checkout-container .btn:hover {
            background-color: #e55c50;
        }

        /* Footer styles */
        footer {
            background-color: coral;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }

        footer p {
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .checkout-container {
                padding: 20px;
            }

            header h1 {
                font-size: 2em;
            }

            .checkout-container p {
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

<div class="checkout-container">
    <h2>Checkout Successful</h2>

    <div class="thankyou-message">
        <p>Thank you for your order!</p>
        <p>Your order has been successfully placed. We are processing it and will send you a confirmation soon.</p>
    </div>

    <div class="order-summary">
        <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
        <p><strong>Food:</strong> <?php echo $row['food']; ?></p>
        <p><strong>Quantity:</strong> <?php echo $row['qty']; ?></p>
        <p><strong>Total:</strong> ₹<?php echo $row['total']; ?></p>
        <p><strong>Name:</strong> <?php echo $row['customer_name']; ?></p>
        <p><strong>Contact:</strong> <?php echo $row['customer_contact']; ?></p>
        <p><strong>Delivery Address:</strong> <?php echo $row['customer_address']; ?></p>
    </div>

    <!-- You can add any post-checkout instructions here -->
    <div class="thankyou-message">
        <p>We will notify you once the order is on its way!</p>
        <p><a href="index.php" class="btn">Return to Home</a></p>
    </div>
</div>

<footer>
    <p>&copy; 2025 Food Ordering System. All rights reserved.</p>
</footer>

</body>
</html>
