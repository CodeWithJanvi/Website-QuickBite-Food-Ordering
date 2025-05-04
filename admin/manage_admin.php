<?php 
include('partial/menu.php');
include('database_connection.php'); // Include DB connection

// Initialize success message variable
$success_message = "";

// Add Admin
if (isset($_POST['add_admin'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $query = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
    if (mysqli_query($conn, $query)) {
        // Set success message
        $success_message = "Admin added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch All Admins
$query = "SELECT * FROM tbl_admin";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!-- Main Section Start -->
<div class="main">
    <div class="wrapper">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Manage Admin Panel</h1>
            <button onclick="toggleForm()" style="
    padding: 14px 28px;
    background-color: coral;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, transform 0.2s ease;
"
onmouseover="this.style.backgroundColor='#ff7f50'; this.style.transform='scale(1.05)';"
onmouseout="this.style.backgroundColor='coral'; this.style.transform='scale(1)';"
>
    + Add Admin
</button>


        </div>

        <!-- Add Admin Form (Initially Hidden) -->
        <div id="addAdminForm" style="display: none; margin-top: 20px;">
            <h2>Add New Admin</h2>
            <form method="POST">
                <input type="text" name="full_name" placeholder="Full Name" required><br><br>
                <input type="text" name="username" placeholder="Username" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <button type="submit" name="add_admin" style="padding: 8px 16px; background-color: coral; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Add Admin
                </button>
            </form>
        </div>

        <!-- Success Message (After Form Submission) -->
        <?php if (!empty($success_message)) { ?>
            <div class="success-message" style="margin-top: 15px; padding: 10px; background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 4px;">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php } ?>

        <!-- Admin List Table -->
        <h2 style="margin-top: 40px;">Admin List</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td><a href='edit_admin.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_admin.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this admin?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Main Section End -->

<!-- JavaScript for toggle functionality -->
<script>
    function toggleForm() {
        var form = document.getElementById("addAdminForm");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
</script>

<?php 
include('partial/footer.php');
?>
