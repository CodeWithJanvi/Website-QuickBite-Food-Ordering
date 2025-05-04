<?php
include('partial/menu.php');
include('database_connection.php');

// Fetch all orders
$query = "SELECT * FROM tbl_order";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <div class="wrapper">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Manage Orders</h1>
        </div>

        <!-- Orders List -->
        <h2 style="margin-top: 40px;">Orders List</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Food Items</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['customer_name'] . "</td>";
                        echo "<td>" . $row['food'] . "</td>";
                        echo "<td>₹" . number_format($row['total'], 2) . "</td>";
                        echo "<td>
                                <a href='edit_order.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete_order.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partial/footer.php'); ?>
