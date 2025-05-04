<?php
session_start();  // Start the session

include('database_connection.php'); // Include DB connection

// Check if the ID is passed via URL
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Delete the admin from the database
    $delete_query = "DELETE FROM tbl_admin WHERE id = '$admin_id'";

    if (mysqli_query($conn, $delete_query)) {
        // Set a success message in the session
        $_SESSION['message'] = "Admin deleted successfully!";
        header("Location: manage_admin.php"); // Redirect back to the admin management page
        exit();  // Ensure no further code is executed after redirect
    } else {
        // Set an error message in the session
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: manage_admin.php"); // Redirect back to the admin management page
        exit();  // Ensure no further code is executed after redirect
    }
} else {
    // Set an error message if the ID is not valid
    $_SESSION['error'] = "Invalid admin ID.";
    header("Location: manage_admin.php");
    exit();
}
?>
