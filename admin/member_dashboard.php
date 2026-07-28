<?php
session_start();
include 'db_connect.php'; // Ensure this file has the correct database connection

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch allocated events and member details
$sql = "SELECT events.event_name, users.username
        FROM events
        JOIN member_event_allocation ON events.id = member_event_allocation.event_id
        JOIN users ON member_event_allocation.member_id = users.id
        WHERE member_event_allocation.member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../admin/css/event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Member Dashboard</title>
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
                        <a href="events.php">Programs</a>
                        <a href="../admin/education.php">Education</a>
                    </div>
                </li>
                <li><a href="../contact/contact.php">Contact</a></li>
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <li><a href="../admin/admin_dashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="upload.php">Upload</a></li>
                <?php endif; ?>
            </ul>
        </nav>

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

    <div class="content">
        <h2>Allocated Events</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No events allocated.</p>
        <?php endif; ?>
    </div>
</body>
</html>
