<?php
include('database_connection.php');

// Check if the category ID is provided
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Delete the category from the database
    $query = "DELETE FROM tbl_categories WHERE id = '$category_id'";

    if (mysqli_query($conn, $query)) {
        // Redirect back to the manage categories page after successful deletion
        header("Location: manage_categories.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Category ID not provided.";
}
?>
