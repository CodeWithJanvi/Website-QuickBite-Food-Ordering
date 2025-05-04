
<?php
// Include database connection
include('header.php');
include('admin/database_connection.php');

// Initialize variables
$food = '';
$price = 0;
$error = '';
$success = '';

// Fetch food details by ID from URL
if (isset($_GET['food_id'])) {
    $food_id = intval($_GET['food_id']);

    $sql = "SELECT * FROM tbl_food WHERE id = $food_id AND active='Yes'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $food = $row['title'];
        $price = $row['price'];
    } else {
        $error = "Food item not found or inactive.";
    }
} else {
    $error = "No food ID provided.";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    // Insert order into database
    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
            VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    if (mysqli_query($conn, $sql)) {
        // Get the order ID of the recently inserted order
        $order_id = mysqli_insert_id($conn);

        // Redirect to the billing page with the order ID
        header("Location: billing.php?order_id=" . $order_id);
        exit();
    } else {
        $error = "Failed to place order.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Explore Categories | Quick Delivery & Delicious Meals</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fafafa;
            padding: 40px;
        }
        .order-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: coral;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            resize: vertical;
        }
        textarea {
            height: 100px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: coral;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: darkorange;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="order-container">
    <h2>Order Your Food</h2>

    <?php if (!empty($success)) echo "<div class='message'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='message error'>$error</div>"; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Food</label>
            <input type="text" name="food" value="<?php echo htmlspecialchars($food); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Price (₹)</label>
            <input type="number" name="price" value="<?php echo $price; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="qty" value="1" min="1" required>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full-name" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact" placeholder="Enter contact number" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email address" required>
        </div>

        <div class="form-group">
            <label>Delivery Address</label>
            <textarea name="address" placeholder="Enter your address" required></textarea>
        </div>

        <input type="submit" class="btn" value="Confirm Order">
    </form>
</div>

</body>
</html>
<?php include('footer.php'); ?>