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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooParc - Meet Our Amazing Animals</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="animals.css">
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

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="../admin/admin_login.php">Admin</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id'])): ?>
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

    <section class="animal-section">
        <h2>MEET OUR AMAZING ANIMALS</h2>
        <p>Discover the fascinating animals at ZooParc. Click on any animal to learn more about its habitat, diet, and unique characteristics.</p>
        
        <div class="animal-grid">
            <div class="animal-card">
                <img src="../images/asiaticlion.jpg" alt="Lion" class="animal-img">
                <h3>ASIATIC LION</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Panthera leo persica</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Gir Forest, India</p>
                    <p><strong>Characteristics:</strong> Asiatic lions are slightly smaller than African lions and have a distinctive fold of skin along their belly.</p>
                </div>                
            </div>
            
            <div class="animal-card">
                <img src="../images/bluefrog.jpg" alt="blue frog">
                <h3>BLUE POISON DART FROG</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Dendrobates tinctorius "azureus"</p>
                    <p><strong>Type:</strong> Amphibian</p>
                    <p><strong>Habitat:</strong> Rainforests of Suriname, South America</p>
                    <p><strong>Characteristics:</strong> Known for its vibrant blue color and toxic skin, which was used by indigenous people to poison blow darts.</p>
                </div>                
            </div>
            
            <div class="animal-card">
                <img src="../images/spotteddeer.jpg" alt="Deer">
                <h3>VISAYAN SPOTTED DEER</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Rusa alfredi</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Rainforests of the Visayan Islands, Philippines</p>
                    <p><strong>Characteristics:</strong> This endangered deer species is known for its small size and distinctive white spots on its dark brown coat.</p>
                </div>
            </div>
            
            <div class="animal-card">
                <img src="../images/slothbear.jpg" alt="bear">
                <h3>SLOTH BEAR</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Melursus ursinus</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Forests and grasslands in India and Sri Lanka</p>
                    <p><strong>Characteristics:</strong> Sloth bears have a shaggy coat and a unique diet focused on insects like termites and ants, which they suck up through their specially adapted lips.</p>
                </div>
            </div>
            
            <div class="animal-card">
                <img src="../images/redpanda.jpg" alt="Panda">
                <h3>RED PANDA</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Ailurus fulgens</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Temperate forests in the Himalayas</p>
                    <p><strong>Characteristics:</strong> Red pandas are arboreal animals with reddish-brown fur, known for their adorable appearance and bamboo diet.</p>
                </div>
            </div>
            
            <div class="animal-card">
                <img src="../images/steppeeagle.jpg" alt="Eagle">
                <h3>STEPPE EAGLE</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Aquila nipalensis</p>
                    <p><strong>Type:</strong> Bird</p>
                    <p><strong>Habitat:</strong> Open plains, steppes, and deserts of Eurasia</p>
                    <p><strong>Characteristics:</strong> The Steppe Eagle is a large raptor known for its broad wings and powerful flight, often migrating long distances.</p>
                </div>          
            </div>
            
            <div class="animal-card">
                <img src="../images/asiaelephant.jpg" alt="aelepahnt">
                <h3>ASIAN ELEPHANT</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Elephas maximus</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Forests and grasslands in South and Southeast Asia</p>
                    <p><strong>Characteristics:</strong> Asian elephants are smaller than African elephants, with smaller ears and a high-domed head. They are known for their intelligence and strong social bonds.</p>
                </div>               
            </div>
            
            <div class="animal-card">
                <img src="../images/chimpanzee.jpg" alt="Chimpanzee">
                <h3>CHIMPANZEE</h3>
                <a href="javascript:void(0);" class="btn view-more">View More</a>
                <div class="animal-info">
                    <p><strong>Scientific Name:</strong> Pan troglodytes</p>
                    <p><strong>Type:</strong> Mammal</p>
                    <p><strong>Habitat:</strong> Tropical forests and savannas in Central and West Africa</p>
                    <p><strong>Characteristics:</strong> Chimpanzees are highly intelligent primates, known for their use of tools, complex social structures, and genetic closeness to humans.</p>
                </div>                
            </div>
            
        </div>
    </section>
    <script src="animal.js"></script>

    <!-- footer -->
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
