<?php
include('partial/menu.php');
include('database_connection.php');

// Handle Add Food submission
if (isset($_POST['add_food'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category_id = $_POST['categories_id']; // Form input field name is 'categories_id', but DB column is 'category_id'
    $feature = $_POST['feature'];
    $active = $_POST['active'];
    $description = $_POST['description']; // Get description from form

    // Handle image upload
$image_name = ""; // Default to no image
$image_dir = "images/food/";

// Create directory if not exists
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


    // Insert food into database
    $insert_query = "INSERT INTO tbl_food (title, price, image_name, description, category_id, feature, active)
                     VALUES ('$title', '$price', '$image_name', '$description', '$category_id', '$feature', '$active')";

    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Food added successfully');</script>";
    } else {
        echo "<script>alert('Failed to add food');</script>";
    }
}

// Fetch all food items
$query = "SELECT * FROM tbl_food";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <div class="wrapper">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>Manage Food</h1>
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
                + Add Food
            </button>
        </div>

        <!-- Add Food Form -->
        <div id="addFoodForm" style="display: none; margin-top: 20px;">
            <h2 style="text-align: center; margin-bottom: 20px;">Add New Food</h2>
            <form method="POST" enctype="multipart/form-data">
                <label>Title</label>
                <input type="text" name="title" placeholder="Food Title" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

                <label>Price</label>
                <input type="number" step="0.01" name="price" placeholder="Price" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

                <label>Image</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

                <label>Category ID</label>
                <input type="number" name="categories_id" placeholder="Category ID" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;">

                <label>Featured</label>
                <div style="margin-bottom: 15px;">
                    <input type="radio" name="feature" value="Yes" required> Yes
                    <input type="radio" name="feature" value="No"> No
                </div>

                <label>Active</label>
                <div style="margin-bottom: 20px;">
                    <input type="radio" name="active" value="Yes" required> Yes
                    <input type="radio" name="active" value="No"> No
                </div>

                <label>Description</label>
                <textarea name="description" placeholder="Description" required style="width: 100%; padding: 10px; border: 1px solid #ccc; margin-bottom: 15px;"></textarea>

                <button type="submit" name="add_food" style="padding: 12px 24px; background-color: coral; color: white; border: none; border-radius: 6px; width: 100%; cursor: pointer;">
                    Add Food
                </button>
            </form>
        </div>

        <!-- Food List -->
        <h2 style="margin-top: 40px;">Food List</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category ID</th>
                    <th>Featured</th>
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
                        echo "<td>₹" . number_format($row['price'], 2) . "</td>";
                        echo "<td>";
                        // Display image if exists, otherwise show fallback message
                        if (!empty($row['image_name']) && file_exists("images/food/" . $row['image_name'])) {
                            echo "<img src='images/food/" . $row['image_name'] . "' width='50' height='50'>";
                        } else {
                            echo "<span style='color: gray;'>Image missing</span>";
                        }
                        echo "</td>";
                        echo "<td>" . (empty($row['description']) ? "No description" : $row['description']) . "</td>";
                        echo "<td>" . $row['category_id'] . "</td>"; // Display category_id as fetched from DB
                        echo "<td>" . $row['feature'] . "</td>";
                        echo "<td>" . $row['active'] . "</td>";
                        echo "<td><a href='edit_food.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_food.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align: center;'>No food items found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleForm() {
        var form = document.getElementById("addFoodForm");
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
    }
</script>

<?php include('partial/footer.php'); ?>
