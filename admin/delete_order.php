<?php
include('partial/menu.php');
include('database_connection.php');

// Check if ID is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the order
    $sql = "DELETE FROM tbl_order WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        $_SESSION['delete'] = "<div class='success-message'><p>Order Deleted Successfully.</p></div>";
    } else {
        $_SESSION['delete'] = "<div class='error-message'><p>Failed to Delete Order.</p></div>";
    }

    header('Location: manage_order.php');
    exit();
} else {
    header('Location: manage_order.php');
    exit();
}
?>
