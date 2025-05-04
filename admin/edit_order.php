<?php
include('partial/menu.php');
include('database_connection.php');

// Check if the order ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get the order details
    $sql = "SELECT * FROM tbl_order WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows == 1) {
        $order = $result->fetch_assoc();
    } else {
        header('Location: manage_order.php');
        exit();
    }
} else {
    header('Location: manage_order.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo htmlspecialchars($order['food']); ?></b></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>₹<?php echo number_format($order['price'], 2); ?></td>
                </tr>

                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $order['qty']; ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="Ordered" <?php if ($order['status'] == "Ordered") echo "selected"; ?>>Ordered</option>
                            <option value="On Delivery" <?php if ($order['status'] == "On Delivery") echo "selected"; ?>>On Delivery</option>
                            <option value="Delivered" <?php if ($order['status'] == "Delivered") echo "selected"; ?>>Delivered</option>
                            <option value="Cancelled" <?php if ($order['status'] == "Cancelled") echo "selected"; ?>>Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo htmlspecialchars($order['customer_name']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo htmlspecialchars($order['customer_contact']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo htmlspecialchars($order['customer_email']); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" required><?php echo htmlspecialchars($order['customer_address']); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                        <button type="submit" name="submit" class="btn-update">Update Order</button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
// Update order in database
if (isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $qty = intval($_POST['qty']);
    $status = $_POST['status'];
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $total = $order['price'] * $qty;

    $sql_update = "UPDATE tbl_order SET
        qty = ?, 
        total = ?, 
        status = ?, 
        customer_name = ?, 
        customer_contact = ?, 
        customer_email = ?, 
        customer_address = ?
        WHERE id = ?";

    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('dssssssi', $qty, $total, $status, $customer_name, $customer_contact, $customer_email, $customer_address, $id);

    $res_update = $stmt_update->execute();

    if ($res_update) {
        $_SESSION['update'] = "<div class='success-message'><p>Order Updated Successfully.</p></div>";
    } else {
        $_SESSION['update'] = "<div class='error-message'><p>Failed to Update Order.</p></div>";
    }

    header('Location: manage_order.php');
    exit();
}
?>

<?php include('partial/footer.php'); ?>
