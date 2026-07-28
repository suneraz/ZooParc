<?php
session_start();

//establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "zooparc_db");
//verifying the connection
if(!$connection){
    die("Connection failed : " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us - ZooParc Zoological Park</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- header start -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-paw"></i>ZooParc</a>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about/about.php">About</a></li>
                <li><a href="../animals/animals.php">Animals</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Events</a>
                    <div class="dropdown-content">
                        <a href="../admin/events.php">Programs</a>
                        <a href="../admin/education.php">Education</a>
                    </div>
                </li>
                <li><a href="../contact/contact.php">Contact</a></li>

                <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])): ?>
                    <li><a href="../admin/admin_login.php">Admin</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../admin/upload.php">Upload</a></li>
                <?php endif; ?>
                
                <!-- My Area link for logged-in members -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../admin/member_dashboard.php">My Area</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <form class="search-bar" action="../search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>

        <!-- User Info and Logout -->
        <?php if (isset($_SESSION['admin_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></a>
                <a href="../admin/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php elseif (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></a>
                <a href="../login/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php else: ?>
            <a href="../login/login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
    </div>
    <!-- header end -->

    <!-- contact start -->
    <section class="contact">
        <div class="content">
            <h1>Contact Us</h1>
            <p>If you have any questions, comments, or suggestions, we would love to hear from you. Please use the form below to get in touch with us, or use the contact information provided to reach us directly.</p>
            
            <h1>Our Location</h1>
            <p>ZooParc Zoological Park<br>
               1234 Nature City, AA 45</p>
            
            <h1>Contact Information</h1>
            <p>Email: contact@zooparc.com<br>
               Phone: +1 (234) 567-8900</p>
            
            <h1>Get in Touch</h1>
            <form action="#" method="post">
                <label for="name"></label>
                <input type="text"  name="name" placeholder="Enter your name" required>
                
                <label for="email"></label>
                <input type="email"  name="email" placeholder="Enter your email" required>
                
                <label for="message"></label>
                <textarea id="message" name="message" rows="6" placeholder="Enter your message" required></textarea>
                
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </section>
    <!-- contact section end -->

    <script src="script.js"></script>

    <footer>
    <div class="footer">
        <div class="footer-col">
            <h5>About Us</h5>
            <ul>
                <li><a href="#">Our Story</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Programs</h5>
            <ul>
                <li><a href="#">Education</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Community</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Follow Us</h5>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
            </div>
            <a href="#" class="footer-btn">Donate Now</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 All Rights Reserved By ZooParc</p>
    </div>
</footer>
