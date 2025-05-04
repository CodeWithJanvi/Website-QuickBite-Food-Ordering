<?php 
include('partial/menu.php');
include('database_connection.php');

// Fetch the category details based on the category ID passed via the URL
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Fetch the category data from the database
    $query = "SELECT * FROM tbl_categories WHERE id = '$category_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch category data
    $category = mysqli_fetch_assoc($result);
    
    // Update category
    if (isset($_POST['update_category'])) {
        $title = $_POST['title'];
        $featured = $_POST['feature'];
        $active = $_POST['active'];

        // Handle image upload (optional, only update if a new image is uploaded)
        $image_name = $category['image_name']; // Keep existing image if no new one is uploaded

        if ($_FILES['image']['name'] != "") {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $src = $_FILES['image']['tmp_name'];
            $dst = "images/category/" . $image_name;
            if (move_uploaded_file($src, $dst)) {
                // Image upload successful
            } else {
                echo "Failed to upload image!";
            }
        }

        // Update the category in the database
        $update_query = "UPDATE tbl_categories 
                         SET title = '$title', image_name = '$image_name', feature = '$feature', active = '$active' 
                         WHERE id = '$category_id'";

        if (mysqli_query($conn, $update_query)) {
            // Redirect back to the manage categories page after successful update
            header("Location: manage_categories.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!-- Edit Category Form -->
<div class="main-content">
    <div class="wrapper">
        <h1>Edit Category</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $category['title']; ?>" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

            <label>Image</label>
            <input type="file" name="image" style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">
            
            <?php if ($category['image_name'] != ""): ?>
                <p>Current Image: <img src="images/category/<?php echo $category['image_name']; ?>" width="100"></p>
            <?php endif; ?>

            <label>Featured</label>
            <div style="margin-bottom: 15px;">
                <input type="radio" name="feature" value="Yes" <?php echo $category['feature'] == 'Yes' ? 'checked' : ''; ?> required> Yes
                <input type="radio" name="feature" value="No" <?php echo $category['feature'] == 'No' ? 'checked' : ''; ?>> No
            </div>

            <label>Active</label>
            <div style="margin-bottom: 20px;">
                <input type="radio" name="active" value="Yes" <?php echo $category['active'] == 'Yes' ? 'checked' : ''; ?> required> Yes
                <input type="radio" name="active" value="No" <?php echo $category['active'] == 'No' ? 'checked' : ''; ?>> No
            </div>

            <button type="submit" name="update_category" style="padding: 12px 24px; background-color: coral; color: white; border: none; border-radius: 6px; width: 100%; cursor: pointer;">
                Update Category
            </button>
        </form>
    </div>
</div>

<?php include('partial/footer.php'); ?>
