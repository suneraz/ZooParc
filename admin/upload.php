<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}
include 'db_connect.php';

// Handle form submission
if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $upload_date = $_POST['upload_date'];
    $uploaded_by = $_SESSION['username'];

    // Prepare and execute SQL query to insert the educational content
    $sql = "INSERT INTO education_uploads (title, description, upload_date, uploaded_by) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssss', $title, $description, $upload_date, $uploaded_by);
        if ($stmt->execute()) {
            echo "<script>alert('Event added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }
}

// Delete Information
if (isset($_POST['delete'])) {
    $title = $_POST['delete_title'];

    // Prepare SQL statement to delete educational content by title
    $sql = "DELETE FROM education_uploads WHERE title=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $title);
        if ($stmt->execute()) {
            echo "<script>alert('Educational content deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/css/admin_dashbaord.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Upload Educational | ZooParc</title>
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
            </ul>
        </nav>
        <!-- User Info and Logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-info">
                <a href="#" class="user-btn"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></a>
                <a href="../login/logout.php" class="logout-btn">LOGOUT</a>
            </div>
        <?php else: ?>
            <a href="../login/login.php" class="login-btn">LOGIN</a>
        <?php endif; ?>
        </div>

        <div class="content">
            <div class="upload-header">
                <h1>Upload Educational Content</h1>
            </div>

        <div class="upload-content">
            <section class="admin-section">
                <form method="POST" action="upload.php">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required><br>
                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" rows="4" required></textarea><br>
                    <label for="upload_date">Date:</label><br>
                    <input type="date" id="upload_date" name="upload_date" required><br><br>
                    <button type="submit" name="upload">Upload</button>
                </form>
            </section>

            <section class="admin-section">
                <h2>Delete Information for Education</h2>
                <form method="POST" action="upload.php">
                    <label for="delete_title">Title:</label><br>
                    <input type="text" id="delete_title" name="delete_title" required><br><br>
                    <button type="submit" name="delete">Delete</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
