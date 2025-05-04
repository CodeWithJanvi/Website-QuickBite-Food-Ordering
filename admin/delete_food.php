<?php
include('database_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get image name
    $get_query = "SELECT image_name FROM tbl_food WHERE id = $id";
    $result = mysqli_query($conn, $get_query);
    $row = mysqli_fetch_assoc($result);

    // Delete image if exists
    if ($row['image_name'] != "" && file_exists("images/food/" . $row['image_name'])) {
        unlink("images/food/" . $row['image_name']);
    }

    // Delete food
    $delete_query = "DELETE FROM tbl_food WHERE id = $id";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Food deleted successfully'); window.location.href='manage_food.php';</script>";
    } else {
        echo "<script>alert('Failed to delete food'); window.location.href='manage_food.php';</script>";
    }
} else {
    echo "<script>window.location.href='manage_food.php';</script>";
}
?>
