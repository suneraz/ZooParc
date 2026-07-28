<?php
session_start();
include '../admin/db_connect.php'; 

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // User is already logged in, show a message and option to go back
    echo "<p>You're already logged in as " . htmlspecialchars($_SESSION['email']) . ".</p>";
    echo "<a href='../index.php'>Go to Homepage</a>"; // Redirect to homepage or any other page
    exit(); // Stop further execution of the page
}

// Initialize an error message variable
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT id, email, username, password FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email']; // Store the email in session
                $_SESSION['username'] = $row['username']; // Store the username in session
                
                // Output the alert message and redirect
                echo "<script>alert('Login successful!'); window.location.href='../index.php';</script>";
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No account found with that email.";
        }

        $stmt->close();
    } else {
        $error_message = "Error preparing the query.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login | ZooParc</title>
</head>
<body>
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
                <li><a href="../admin/admin_login.php">Admin</a></li>

                <!-- Upload Educational Content link for logged-in users -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="upload.php">Upload</a></li>
            <?php endif; ?>
            
            </ul>
        </nav>
        <form class="search-bar" action="../search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
        <!-- User Info and Logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['email'] ?? 'Guest'); ?></a>
                <a href="logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <form class="login-form" action="" method="post">
            <h1>Login</h1>
            <?php if (!empty($error_message)): ?>
                <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <div class="box">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <i class='bx bxs-envelope'></i>
            </div>
            
            <div class="box">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div>
                <label><input type="checkbox" name="remember_me"> Remember me</label>
            </div>

            <button type="submit" class="btn">LOGIN</button>

            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div> 
</body>
</html>
