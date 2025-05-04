<?php include('header.php'); ?>
<?php include('admin/database_connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foods by Category</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php
// Get category ID and title from URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Get the category title
    $sql = "SELECT title FROM tbl_categories WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    // Redirect to homepage if no category_id
    header("location: index.php");
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>
<!-- Food Search Section Ends Here -->

<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Get all foods from selected category
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND active='Yes'";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div class='error'>Image not available.</div>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">&#8377;<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<div class='error'>No food available in this category.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Food Menu Section Ends Here -->

</body>
</html>

<?php include('footer.php'); ?>
