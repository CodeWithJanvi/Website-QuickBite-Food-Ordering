<?php
include('partial/menu.php');
include('database_connection.php');

$success_message = "";

if (isset($_POST['add_category'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $feature = $_POST['feature'];
    $active = $_POST['active'];

    $image_name = "";
    $image_dir = "images/Category/";

    if (!is_dir($image_dir)) {
        mkdir($image_dir, 0777, true);
    }

    if (!empty($_FILES['image']['name'])) {
        $original_name = basename($_FILES['image']['name']);
        $original_name = preg_replace("/[^A-Za-z0-9.\-_]/", "", $original_name); // sanitize filename
        $target_path = $image_dir . $original_name;

        if (file_exists($target_path)) {
            $success_message = "Image with the same name already exists. Please rename your image and try again.";
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $image_name = $original_name;
            } else {
                $success_message = "Failed to upload image.";
            }
        }
    }

    if ($success_message == "") {
        $sql = "INSERT INTO tbl_categories (title, image_name, feature, active) 
                VALUES ('$title', '$image_name', '$feature', '$active')";

        if (mysqli_query($conn, $sql)) {
            $success_message = "Category added successfully!";
        } else {
            $success_message = "Database error: " . mysqli_error($conn);
        }
    }
}

// Fetch categories
$query = "SELECT * FROM tbl_categories";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <div class="wrapper">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Manage Categories</h1>
            <button onclick="toggleForm()" style="padding: 14px 28px; background-color: coral; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 50px; cursor: pointer; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); transition: background-color 0.3s ease, transform 0.2s ease;" onmouseover="this.style.backgroundColor='#ff7f50'; this.style.transform='scale(1.05)';" onmouseout="this.style.backgroundColor='coral'; this.style.transform='scale(1)';">
                + Add Categories
            </button>
        </div>

        <!-- Add Category Form -->
        <div id="addCategoryForm" style="display: none; margin-top: 20px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Add New Category</h2>
            <form method="POST" enctype="multipart/form-data">
                <label>Title</label>
                <input type="text" name="title" placeholder="Category Title" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">
                
                <label>Image</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

                <label>Feature</label>
                <div style="margin-bottom: 15px;">
                    <input type="radio" name="feature" value="Yes" required> Yes
                    <input type="radio" name="feature" value="No"> No
                </div>

                <label>Active</label>
                <div style="margin-bottom: 20px;">
                    <input type="radio" name="active" value="Yes" required> Yes
                    <input type="radio" name="active" value="No"> No
                </div>

                <button type="submit" name="add_category" style="padding: 12px 24px; background-color: coral; color: white; border: none; border-radius: 6px; width: 100%; cursor: pointer;">
                    Add Category
                </button>
            </form>
        </div>

        <!-- Success Message -->
        <?php if (!empty($success_message)) { ?>
            <div class="success-message" style="margin-top: 15px; padding: 10px; background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 4px;">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php } ?>

        <!-- Category Table -->
        <h2 style="margin-top: 40px;">Category List</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Feature</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>";
                        if (!empty($row['image_name'])) {
                            echo "<img src='images/Category/" . $row['image_name'] . "' width='50' height='50'>";
                        } else {
                            echo "No Image";
                        }
                        echo "</td>";
                        echo "<td>" . $row['feature'] . "</td>";
                        echo "<td>" . $row['active'] . "</td>";
                        echo "<td>
                            <a href='edit_category.php?id=" . $row['id'] . "'>Edit</a> | 
                            <a href='delete_category.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>
                          </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No categories found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Toggle Form Script -->
<script>
    function toggleForm() {
        var form = document.getElementById("addCategoryForm");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
</script>

<?php include('partial/footer.php'); ?>
