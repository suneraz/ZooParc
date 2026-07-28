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
    <title>About Us - ZooParc Zoological Park</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="about.css">
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
                <li><a href="./about.php">About</a></li>
                <li><a href="../animals/animals.php">Animals</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Events</a>
                    <div class="dropdown-content">
                        <a href="../admin/events.php">Programs</a>
                        <a href="../admin/education.php">Education</a>
                    </div>
                </li>
                <li><a href="../contact/contact.php">Contact</a></li>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="../admin/admin_login.php">Admin</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])): ?>
                    <li><a href="../admin/upload.php">Upload</a></li>
                <?php endif; ?>

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

    <!-- about start -->
    <section class="about">
        </div>
        <div class="content">
            <h1>About ZooParc</h1>
            <p>The ZooParc offers a peaceful place for wildlife and, for people of any age to get close to nature. 
                The vision of protecting and conserving wildlife has always been the core reason behind the establishment of ZooParc. 
                The park has over 2,000 animals, belonging to 200 different species. 
                The whole stretch of the park is 70 hectares with all varieties of ecosystems imitating almost the natural environments of our animals.
            </p>
            
            <h1>Our Mission</h1>
            <p>At ZooParc, we inspire and educate our visitors about the importance of wildlife.
                We work hard to create an environment where animals can thrive and We give our visitors knowledge about the 
                important roles these animals have in our environment.
                We develop educational programs, conservation efforts, and community outreach activities that will 
                last and benefit both our immediate community and the global wildlife conservation effort.
            </p>
            
            <h1>Meet Our Residents</h1>
            <p>From the majestic lions and playful pandas to graceful eagles and exotic frogs, 
                ZooParc gives a taste of the immense diversity found in the animal kingdom. 
                Habitats are organized according to themes that take into consideration the natural environment of each species it shelters. 
                Visitors get to be very close to the animals while being informed about their specific behaviors, diets, and conservation status.
            </p>
            
            <h1>Our Conservation Efforts</h1>
            <p>ZooParc works on wildlife preservation through different conservation programs. 
                The local and global organizations team up for breeding programs, habitat restorations, 
                and research to help safeguard these endangered species. This goes beyond the park and contributes to wildlife conservation efforts around the world.
            </p>
            
            <h1>Join Our Community</h1>
            <p>Our online community would be an ideal place to learn, discuss, and share any kind of information regarding wildlife conservation. 
                Community members can see exclusive content, join discussions, and contribute to our cause by sharing their experiences and knowledge. 
                Volunteers are always welcomed, you can register your name on our website to participate in our mission. Never miss a chance to be a part.
            </p>
            
            <h1>Visit Us</h1>
            <p>Get closer to nature by visiting the ZooParc Zoological Park. 
                This park opens from 10 a.m. daily, offering a range of facilities from food outlets down to picnic areas. 
                Guided tours are available as well. Whether it's an adventurous day or just a peaceful afternoon with nature, ZooParc has it all.
            </p>
            
            <a href="programs.html" class="btn">LEARN MORE ABOUT OUR PROGRAMS</a>
        </div>
    </section>
    <!-- about end -->

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
                <div class="links">
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
