<?php
session_start();

// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "zooparc_db");

// Verify the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ZooParc</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- header start -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-paw"></i>ZooParc</a>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about/about.php">About</a></li>
                <li><a href="animals/animals.php">Animals</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Events</a>
                    <div class="dropdown-content">
                        <a href="./admin/events.php">Programs</a>
                        <a href="./admin/education.php">Education</a>
                    </div>
                </li>
                <li><a href="contact/contact.php">Contact</a></li>

                <!-- Admin link only shown if no member is logged in -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="admin/admin_login.php">Admin</a></li>
                <?php endif; ?>

                <!-- Upload Educational Content link for logged-in users -->
                <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])): ?>
                    <li><a href="admin/upload.php">Upload</a></li>
                <?php endif; ?>

                <!-- My Area link for logged-in members -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="admin/member_dashboard.php">My Area</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <form class="search-bar" action="search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>

        <!-- User Info and Logout -->
        <?php if (isset($_SESSION['admin_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></a>
                <a href="admin/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php elseif (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></a>
                <a href="./login/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php else: ?>
            <a href="login/login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
    </div>
    <!-- header end -->

    <!-- slider start -->
    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="images/parrot.jpg" alt="parrot">
                <div class="text">
                    <h1>BEGIN YOUR EPIC JOURNEY THROUGH</h1>
                    <h2>OUR ZOO</h2>
                    <p>Step into our zoo and embark on an incredible adventure. Explore a variety of animal exhibits and lush habitats. 
                        Each visit brings new and exciting experiences, with stunning sights and sounds that showcase the beauty of nature.</p>
                    <a href="login/register.php" class="btn">VOLUNTEER REGISTER</a>
                    <a href="login/login.php" class="btn">MEMBER LOGIN</a>
                </div>
            </div>
            <div class="item">
                <img src="images/elephant.jpg" alt="elephant">
                <div class="text">
                    <h1>DISCOVER NATURE'S MOST REMARKABLE</h1>
                    <h2>ANIMALS</h2>
                    <p>Experience the thrill of getting up close to some of nature’s most amazing animals. 
                        Our interactive exhibits allow you to see them in their natural habitats and observe their unique behaviors. 
                        Discover fascinating details about their lives and conservation efforts.</p>
                    <a href="animals/animals.php" class="btn">OUR ANIMALS</a>
                </div>
            </div>
            <div class="item">
                <img src="images/bear.jpg" alt="bear">
                <div class="text">
                    <h1>MAKE UNFORGETTABLE MEMORIES WITH YOUR</h1>
                    <h2>LOVED ONES</h2>
                    <p>Create lasting memories with your family and friends during a fun-filled day at our zoo. 
                        Enjoy engaging activities, interactive displays, and educational programs designed for all ages. 
                        Spend quality time together and experience moments that you’ll cherish forever.</p>
                    <a href="admin/events.php" class="btn">PROGRAMMES & MORE</a>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <img src="images/wave.png" alt="wave" class="wave">
    </div>
    <!-- slider end -->

    <!--animals-->
    <section class="animal">
        <h3>A Wonderful Day with a Purpose</h3>
        <p>Experience nature up close at Zooparc, a conservation-focused zoo right in the heart of the city. 
            Explore fascinating wildlife, see how we’re working to protect their future, and make unforgettable memories with our amazing animals.
        </p>
            <a href="#" class="btn long">OPEN DAILY FROM 10 AM</a>
            <a href="#" class="btn">OPENING HOURS</a>
            <a href="#" class="btn">BOOK TICKETS</a><br>
            <a href="https://www.google.com/maps" class="btn" target="_blank">LOCATION</a>
            <a href="#" class="btn">EVENTS</a>
            <a href="#" class="btn long">FOOD & DRINKS</a>
            <div class="image">
                <img src="images/about.jpg" alt="about">
            </div>
            <div class="content">
                <h4>MEET OUR INCREDIBLE ANIMALS</h4>
                <p>With approximately 2,000 animals representing 200 different species, ZooParc offers a rich tapestry of wildlife. From majestic lions and playful pandas to graceful eagles and exotic frogs, immerse yourself in diverse habitats and experience the wonders of nature up close.</p>
                <a href="animals/animals.php" class="btn">OUR ANIMALS</a>
            </div>
    </section>

    <!--gallery-->
    <section class="gallery">
        <h3>GALLERY</h3>
        <div class="wrapper">
            <div class="box">
                <img src="images/lion.jpg" alt="img">
                <img src="images/parrot1.jpg" alt="img">
                <img src="images/giraf.jpg" alt="img">
                <img src="images/elephant1.jpg" alt="img">
                <img src="images/tiger.jpg" alt="img">
                <img src="images/monkey.jpg" alt="img">
                <img src="images/giannino.jpg" alt="img">
                <img src="images/zebra.jpg" alt="img">
                <img src="images/panda.jpg" alt="img">
                <img src="images/bird.jpg" alt="img">
            </div>
            <div class="buttons">
                <button id="gallery-prev"><</button>
                <button id="gallery-next">></button>
            </div>
        </div>
    </section>

    <!--home-event-->
    <section class="event">
        <h2>Explore Our Exciting Programs</h2>
        <p>ZooParc offers a range of entertaining yet informative programs from educational guided tours to animal encounters, workshops, and special events for all age brackets.
            Experience unforgettable wildlife with us!
        </p>
        
        <div class="eventh">
            <div class="event-card">
                <img src="images/tour.jpg" alt="Educational Tours">
                <h3>Educational Tours</h3>
                <p>Join our guided tours to learn fascinating facts about our animals and conservation efforts. Perfect for students and families.</p>
            </div>
            <div class="event-card">
                <img src="images/Encount.jpg" alt="Animal Encounters">
                <h3>Interactive Animal Encounters</h3>
                <p>Get up close with our animals through interactive sessions designed for an unforgettable experience. Meet our giant pandas, eagles, and more!</p>
            </div>
            <div class="event-card">
                <img src="images/Workshop.jpg" alt="Workshops">
                <h3>Hands On Workshops</h3>
                <p>Participate in workshops that offer hands on experiences with animal care, conservation practices, and more. Great for all ages!</p>
            </div>
            <div class="event-card">
                <img src="images/event.jpg" alt="Special Events">
                <h3>Special Events</h3>
                <p>Join us for special events throughout the year, including animal-themed festivals, conservation talks, and more.</p>
            </div>
        </div>
        <a href="admin/events.php" class="btn">DISCOVER EVENTS</a>
    </section>

    <!-- Food Outlets Section -->
    <section class="food">
        <h2>Delicious Food & Refreshments</h2>
        <p>Visitors can choose from a variety of food outlets throughout ZooParc, or bring their own picnic to enjoy in our scenic picnic areas. Here’s what we offer:</p>
        
        <div class="outlet-grid">
            <div class="outlet">
                <div>
                    <h3>Safari Cafe</h3>
                    <p>Enjoy a range of gourmet sandwiches, salads, and beverages at our Safari Cafe, located near the entrance.</p>
                </div>
                <img src="images/cafe.jpg" alt="Safari Cafe">
            </div>
            <div class="outlet">
                <img src="images/junglesnacks.jpg" alt="Jungle Snacks">
                <div>
                    <h3>Jungle Snacks</h3>
                    <p>Quick bites and refreshing drinks available at Jungle Snacks, perfect for a quick stop during your zoo visit.</p>
                </div>
            </div>
            <div class="outlet">
                <div>
                    <h3>Asian Delights</h3>
                    <p>Enjoy a variety of Asian-inspired dishes, including noodles and rice bowls, at our food stall near the giraffe habitat.</p>
                </div>
                <img src="images/delight.jpg" alt="Asian Delights">
            </div>
            <div class="outlet">
                <img src="images/picnic.jpg" alt="Picnic Areas">
                <div>
                    <h3>Picnic Areas</h3>
                    <p>Prefer bringing your own food? Relax and enjoy your meal in one of our beautiful picnic areas scattered around the park.</p>
                </div>
            </div>
        </div>
        <a href="#" class="btn">EXPLORE FOOD OUTLETS</a>
    </section>
    
    <script src="script.js"></script>

    <footer>
        <div class="footer">
            <div class="footer-col">
                <h5>About Us</h5>
                <ul>
                    <li><a href="about/about.php">Our Story</a></li>
                    <li><a href="about/about.php">Careers</a></li>
                    <li><a href="about/about.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Programs</h5>
                <ul>
                    <li><a href="events/events.php">Education</a></li>
                    <li><a href="events/events.php">Events</a></li>
                    <li><a href="events/events.php">Community</a></li>
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
</body>
</html>
