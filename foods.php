<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu | Quick Delivery & Delicious Meals</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        include('admin/database_connection.php'); // DB connection

        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name != "") {
                            ?>
                            <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div class='error'>Image not available</div>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">&#8377;
                        <?php echo number_format($price, 2); ?></p>
                        <br>
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<div class='error'>Food not available.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Food Menu Section Ends Here -->

</body>
</html>
<?php include('footer.php'); ?>
