<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

include 'db_connect.php';

// Redirect function
function redirectToEventsPage() {
    echo "<script>alert('Event not found!'); window.location.href = 'admin_dashboard.php';</script>";
    exit();
}

// Add Event
if (isset($_POST['add_event'])) {
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];

    $sql = "INSERT INTO events (event_name, event_description, event_date) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sss', $event_name, $event_description, $event_date);
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

// Update Event by Name
if (isset($_POST['update_event'])) {
    $event_name = $_POST['event_name'];
    $new_event_name = $_POST['new_event_name'];
    $new_event_description = $_POST['new_event_description'];
    $new_event_date = $_POST['new_event_date'];

    $sql = "UPDATE events SET event_name=?, event_description=?, event_date=? WHERE event_name=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssss', $new_event_name, $new_event_description, $new_event_date, $event_name);
        if ($stmt->execute()) {
            echo "<script>alert('Event updated successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }
}

// Delete Event by Name
if (isset($_POST['delete_event'])) {
    $event_name = $_POST['event_name'];

    $sql = "DELETE FROM events WHERE event_name=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $event_name);
        if ($stmt->execute()) {
            echo "<script>alert('Event deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing the query.');</script>";
    }
}

// Allocate Member to Event by Name
if (isset($_POST['allocate_member'])) {
    $event_name = $_POST['event_name'];
    $member_identifier = $_POST['member_identifier'];

    // Get event ID from name
    $event_sql = "SELECT id FROM events WHERE event_name=?";
    if ($stmt = $conn->prepare($event_sql)) {
        $stmt->bind_param('s', $event_name);
        $stmt->execute();
        $event_result = $stmt->get_result();
        if ($event_result->num_rows > 0) {
            $event_row = $event_result->fetch_assoc();
            $event_id = $event_row['id'];
        } else {
            redirectToEventsPage();
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing event query.');</script>";
        exit();
    }

    // Get member ID from username
    $member_sql = "SELECT id FROM users WHERE username=?";
    if ($stmt = $conn->prepare($member_sql)) {
        $stmt->bind_param('s', $member_identifier);
        $stmt->execute();
        $member_result = $stmt->get_result();
        if ($member_result->num_rows > 0) {
            $member_row = $member_result->fetch_assoc();
            $member_id = $member_row['id'];
        } else {
            redirectToEventsPage();
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing member query.');</script>";
        exit();
    }

    $sql = "INSERT INTO member_event_allocation (event_id, member_id) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ii', $event_id, $member_id);
        if ($stmt->execute()) {
            echo "<script>alert('Member allocated to event successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing allocation query.');</script>";
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
    <title>Admin Dashboard | ZooParc</title>
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

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="upload.php">Upload</a></li>
                <?php endif; ?>
                
                <?php if (!isset($_SESSION['admin_id'])): ?>
                    <li><a href="admin_login.php">Admin</a></li>
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
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <form action="logout.php" method="post">
                <button type="submit" name="logout">Logout (Admin)</button>
            </form>
        </div>

        <div class="admin-content">
            <section class="admin-section">
                <h2>Add Event</h2>
                <form method="POST" action="">
                    <label for="event_name">Event Name:</label><br>
                    <input type="text" id="event_name" name="event_name" required><br>
                    <label for="event_description">Event Description:</label><br>
                    <textarea id="event_description" name="event_description" rows="4" required></textarea><br>
                    <label for="event_date">Event Date:</label><br>
                    <input type="date" id="event_date" name="event_date" required><br><br>
                    <button type="submit" name="add_event">Add Event</button>
                </form>
            </section>

            <section class="admin-section">
                <h2>Update Event by Name</h2>
                <form method="POST" action="">
                    <label for="update_event_name">Event Name:</label><br>
                    <input type="text" id="update_event_name" name="event_name" required><br>
                    <label for="new_event_name">New Event Name:</label><br>
                    <input type="text" id="new_event_name" name="new_event_name"><br>
                    <label for="new_event_description">New Event Description:</label><br>
                    <textarea id="new_event_description" name="new_event_description" rows="4"></textarea><br>
                    <label for="new_event_date">New Event Date:</label><br>
                    <input type="date" id="new_event_date" name="new_event_date"><br><br>
                    <button type="submit" name="update_event">Update Event</button>
                </form>
            </section>

            <section class="admin-section">
                <h2>Delete Event by Name</h2>
                <form method="POST" action="">
                    <label for="delete_event_name">Event Name:</label><br>
                    <input type="text" id="delete_event_name" name="event_name" required><br><br>
                    <button type="submit" name="delete_event">Delete Event</button>
                </form>
            </section>

            <section class="admin-section">
                <h2>Allocate Member to Event by Name</h2>
                <form method="POST" action="">
                    <label for="allocate_event_name">Event Name:</label><br>
                    <input type="text" id="allocate_event_name" name="event_name" required><br>
                    <label for="member_identifier">Member Username:</label><br>
                    <input type="text" id="member_identifier" name="member_identifier" required><br><br>
                    <button type="submit" name="allocate_member">Allocate Member</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>


