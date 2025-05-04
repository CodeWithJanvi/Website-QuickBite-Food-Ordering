<?php
session_start();
include('partial/menu.php');
include('database_connection.php'); // Include DB connection

// Check if the ID is passed via URL
if (isset($_GET['id'])) {
    $admin_id = $_GET['id'];

    // Fetch the admin data from the database based on the ID
    $query = "SELECT * FROM tbl_admin WHERE id = '$admin_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $admin = mysqli_fetch_assoc($result);

    if (!$admin) {
        die("Admin not found.");
    }

    // If the form is submitted, update the admin details
    if (isset($_POST['update_admin'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Update the admin details
        $update_query = "UPDATE tbl_admin 
                         SET full_name = '$full_name', username = '$username', password = '$password' 
                         WHERE id = '$admin_id'";

        if (mysqli_query($conn, $update_query)) {
            $_SESSION['success'] = "Admin updated successfully!";
            header("Location: manage_admin.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    die("Invalid request. Admin ID not specified.");
}
?>

<!-- Edit Admin Form -->
<div class="main">
    <div class="wrapper">
        <h1>Edit Admin</h1>

        <!-- Edit Admin Form -->
        <form method="POST" style="max-width: 400px;">
            <label>Full Name:</label><br>
            <input type="text" name="full_name" value="<?php echo $admin['full_name']; ?>" placeholder="Full Name" required><br><br>

            <label>Username:</label><br>
            <input type="text" name="username" value="<?php echo $admin['username']; ?>" placeholder="Username" required><br><br>

            <label>New Password:</label><br>
            <input type="password" name="password" placeholder="Password" required><br><br>

            <button type="submit" name="update_admin" style="padding: 8px 16px; background-color: coral; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Update Admin
            </button>
        </form>
    </div>
</div>

<?php include('partial/footer.php'); ?>
