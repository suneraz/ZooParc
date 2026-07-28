<?php
session_start();
include 'db_connect.php';

// Fetch educational uploads from the database
$sql = "SELECT title, description, upload_date FROM education_uploads ORDER BY upload_date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/css/education.css?v=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Education | ZooParc</title>
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

            <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])): ?>
                <li><a href="../admin/admin_login.php">Admin</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="../admin/upload.php">Upload</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="member_dashboard.php">My Area</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <form class="search-bar" action="../search.php" method="get">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>

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

<div class="content">
    <div class="upload-header">
        <h1>Educational Content</h1>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <table class="education-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($row['upload_date'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No educational content found.</p>
    <?php endif; ?>
</div>

</body>
</html>
