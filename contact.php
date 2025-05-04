<?php
// Database connection setup
$DB_HOST = 'localhost';
$DB_USER = 'root';         // Change this if needed
$DB_PASS = '';             // Change this if needed
$DB_NAME = 'food_order'; // Change this to your actual database name

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO tbl_contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $successMessage = "✅ Thank you! Your message has been sent successfully.";
        } else {
            $successMessage = "<span style='color: red;'>❌ Failed to send message. Please try again.</span>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Best Food Ordering Website</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
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
            <span>&#9776;</span>
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

<!-- Contact Section -->
<section class="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you. Please fill out the form below to get in touch with us.</p>

        <?php if (!empty($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form action="" method="post" class="contact-form table-form">
            <table>
                <tr>
                    <td><label for="name">Your Name:</label></td>
                    <td><input type="text" id="name" name="name" placeholder="Enter your name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Your Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="Enter your email" required></td>
                </tr>
                <tr>
                    <td><label for="subject">Subject:</label></td>
                    <td><input type="text" id="subject" name="subject" placeholder="Subject" required></td>
                </tr>
                <tr>
                    <td><label for="message">Your Message:</label></td>
                    <td><textarea id="message" name="message" placeholder="Enter your message" rows="6" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit" class="btn-primary">Send Message</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</section>

<!-- Footer -->
<section class="footer">
    <p>&copy; 2025 Best Food Ordering Website. All rights reserved.</p>
</section>

<script>
    const menu = document.getElementById("menu");
    const menuIcon = document.getElementById("menu-icon");

    menuIcon.addEventListener("click", function () {
        menu.classList.toggle("show-menu");
    });

    const menuItems = document.querySelectorAll(".menu ul li a");
    menuItems.forEach(item => {
        item.addEventListener("click", function () {
            menu.classList.remove("show-menu");
        });
    });
</script>

</body>
</html>
