<?php
session_start();
include 'db_connect.php';

// Redirect to dashboard if admin is already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: admin_dashboard.php');
    exit();
}

$error_message = ''; // Variable to hold error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT id, password FROM admin WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['id'];
                header('Location: admin_dashboard.php');
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No account found with that username.";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/css/admin_login.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Login | ZooParc</title>
</head>
<body>
    <!-- Navbar -->
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

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="upload.php">Upload</a></li>
                <?php endif; ?>

                <?php if (!isset($_SESSION['admin_id'])): ?>
                        <li><a href="admin_login.php">Admin</a></li>
                <?php endif; ?>   

                <?php if (isset($_SESSION['admin_id'])): ?>
                        <li><a href="logout.php">Logout (Admin)</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php if (!isset($_SESSION['admin_id'])): ?>
            <a href="../login/login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
    </div>


    <div class="content">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
    <?php if (!empty($error_message)): ?>
        <div class="error-message-container">
            <p class="error-message"><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>

</body>
</html>
