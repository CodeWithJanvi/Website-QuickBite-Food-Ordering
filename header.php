<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Food Ordering Website | Quick Delivery & Delicious Meals</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>

    <!-- Navbar Section -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu-icon" id="menu-icon">
                <span>&#9776;</span> <!-- Hamburger icon -->
            </div>

            <div class="menu" id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="foods.php">Foods</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <!-- JS files loaded at the bottom for better speed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Your Menu Toggle Script -->
    <script>
        const menu = document.getElementById("menu");
        const menuIcon = document.getElementById("menu-icon");

        menuIcon.addEventListener("click", function() {
            menu.classList.toggle("show-menu");
        });

        const menuItems = document.querySelectorAll(".menu ul li a");
        menuItems.forEach(item => {
            item.addEventListener("click", function() {
                menu.classList.remove("show-menu");
            });
        });
    </script>

    <!-- If you want to initialize Owl Carousel here (optional) -->
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

</body>
</html>
