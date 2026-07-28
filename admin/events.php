<?php
session_start();
include 'db_connect.php';

$search_query = "";

// Check if a search term is submitted
if (isset($_GET['search'])) {
    $search_query = trim($_GET['search']);
}

// Fetch events from the database, with search filtering if a search term is provided
$sql = "SELECT * FROM events WHERE event_name LIKE ? OR event_description LIKE ? ORDER BY event_date DESC";
$stmt = $conn->prepare($sql);
$search_param = "%$search_query%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

// Close the database connection after fetching the results
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
    <title>Programs | ZooParc</title>
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
                <li><a href="admin_dashboard.php">Admin</a></li>

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
    <h2>Programs</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_description']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
