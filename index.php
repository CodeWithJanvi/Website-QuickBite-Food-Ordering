<?php include('header.php'); ?>
<?php include('admin/database_connection.php'); ?>

<!-- Slider -->
<section class="slider">
    <div class="container">
        <div id="food-slider" class="owl-carousel">
            <div class="slider-item">
                <img src="images/food_banner1.png" alt="Food Banner 1" class="img-responsive">
            </div>
            <div class="slider-item">
                <img src="images/food_banner2.png" alt="Food Banner 2" class="img-responsive">
            </div>
            <div class="slider-item">
                <img src="images/food_banner3.png" alt="Food Banner 3" class="img-responsive">
            </div>
        </div>
    </div>
</section>

<!-- Explore Foods -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php 
        $sql = "SELECT * FROM tbl_categories WHERE active='Yes' AND feature='Yes' ";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>
                <a href="category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php 
                        if($image_name != ""){
                            echo "<img src='images/category/$image_name' alt='$title' class='img-responsive img-curve'>";
                        } else {
                            echo "<div class='error'>Image not available</div>";
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class='error'>Category not found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<!-- Food Menu -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND feature='Yes' LIMIT 6 ";
        $res2 = mysqli_query($conn, $sql2);

        if(mysqli_num_rows($res2) > 0){
            while($row2 = mysqli_fetch_assoc($res2)){
                $id          = $row2['id'];
                $title       = $row2['title'];
                $price       = $row2['price'];
                $description = $row2['description'];
                $image_name  = $row2['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                        if($image_name != ""){
                            echo "<img src='images/food/$image_name' alt='$title' class='img-responsive img-curve'>";
                        } else {
                            echo "<div class='error'>Image not available</div>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">&#8377; <?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">
                            <center>Order Now</center>
                        </a>
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

    <p class="text-center">
        <a href="foods.php">See All Foods</a>
    </p>
</section>

<!-- tighten up gaps -->
<style>
  .slider, .categories, .food-menu {
    padding-top: 15px !important;
    padding-bottom: 15px !important;
  }
  .categories h2, .food-menu h2 {
    margin-bottom: 10px !important;
  }
  .food-menu-box {
    margin: 10px auto !important;
  }
  .text-center {
    padding-top: 10px !important;
    padding-bottom: 10px !important;
  }
</style>

<script>
    $(document).ready(function(){
        $("#food-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            dots: true,
            nav: true
        });
    });
</script>

<?php include('footer.php'); ?>
