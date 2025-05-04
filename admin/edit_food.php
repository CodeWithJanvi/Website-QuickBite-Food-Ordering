<?php
include('partial/menu.php');
include('database_connection.php');

$id = $_GET['id'];
$query = "SELECT * FROM tbl_food WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// If form is submitted
if (isset($_POST['update_food'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $categories_id = $_POST['categories_id'];
    $feature = $_POST['feature'];
    $active = $_POST['active'];
    $image_name = $row['image_name']; // Default to old image

    // Handle new image upload if provided
    if ($_FILES['image']['name'] != "") {
        $image_dir = "images/food/";
        $new_image = time() . '_' . $_FILES['image']['name'];
        $src = $_FILES['image']['tmp_name'];
        $dst = $image_dir . $new_image;

        if (move_uploaded_file($src, $dst)) {
            // Remove old image
            if ($image_name != "" && file_exists($image_dir . $image_name)) {
                unlink($image_dir . $image_name);
            }
            $image_name = $new_image;
        } else {
            echo "<script>alert('Failed to upload new image.');</script>";
        }
    }

    // Update food
    $update_query = "UPDATE tbl_food SET 
                        title = '$title',
                        price = '$price',
                        image_name = '$image_name',
                        categories_id = '$categories_id',
                        feature = '$feature',
                        active = '$active'
                     WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Food updated successfully'); window.location.href='manage_food.php';</script>";
    } else {
        echo "<script>alert('Failed to update food');</script>";
    }
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Edit Food</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" value="<?= $row['title'] ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px;">

            <label>Price</label>
            <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px;">

            <label>Current Image</label><br>
            <img src="images/food/<?= $row['image_name'] ?>" width="100" height="100"><br><br>

            <label>New Image (Optional)</label>
            <input type="file" name="image" style="width: 100%; padding: 10px; margin-bottom: 15px;">

            <label>Category ID</label>
            <input type="number" name="categories_id" value="<?= $row['category_id'] ?>" required style="width: 100%; padding: 10px; margin-bottom: 15px;">

            <label>Featured</label>
            <div style="margin-bottom: 15px;">
                <input type="radio" name="feature" value="Yes" <?= ($row['feature'] == "Yes") ? "checked" : "" ?>> Yes
                <input type="radio" name="feature" value="No" <?= ($row['feature'] == "No") ? "checked" : "" ?>> No
            </div>

            <label>Active</label>
            <div style="margin-bottom: 20px;">
                <input type="radio" name="active" value="Yes" <?= ($row['active'] == "Yes") ? "checked" : "" ?>> Yes
                <input type="radio" name="active" value="No" <?= ($row['active'] == "No") ? "checked" : "" ?>> No
            </div>

            <button type="submit" name="update_food" style="padding: 12px 24px; background-color: coral; color: white; border: none; border-radius: 6px;">
                Update Food
            </button>
        </form>
    </div>
</div>

<?php include('partial/footer.php'); ?>
