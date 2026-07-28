<?php
// Start the session
session_start();

// Establish a MySQL connection
$connection = mysqli_connect("localhost", "root", "", "zooparc_db");

// Verify the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

// Check if form data is set
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = isset($_POST['first-name']) ? $_POST['first-name'] : '';
    $last_name = isset($_POST['last-name']) ? $_POST['last-name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $connection->prepare("INSERT INTO users (first_name, last_name, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('ssssss', $first_name, $last_name, $username, $email, $phone, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            header('Location: login.php'); 
            exit(); 
        } else {
            echo 'Error: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Error preparing the query: ' . $connection->error;
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Register | ZooParc</title>
</head>
<body>
    <div class="header">
        <a href="../index.php" class="logo"><i class="fas fa-paw"></i>ZooParc</a>
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
                <li><a href="../admin/admin_login.php">Admin</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="upload.php">Upload</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <form class="search-bar" action="../search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                <a href="../login/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php else: ?>
            
            <a href="../login/login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
    </div>
    <section></section>
    <div class="container">
        <form class="register-form" action="register.php" method="post">
            <h1>Register</h1>
            <div class="box">
                <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="box">
                <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="box">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="box">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="box">
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                <i class='bx bxs-phone'></i>
            </div>
            <div class="box">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="box">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn">REGISTER</button>
            <div class="login"><p>Already have an account? <a href="login.php">Login</a></p></div>
        </form>
    </div>
    </section> 
</body>
</html>
