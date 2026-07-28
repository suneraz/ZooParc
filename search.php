<?php
session_start();
include './admin/db_connect.php';

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
$stmt->close();
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
    <title>Events</title>
</head>
<body>
    <div class="content">
        <h2>Search Results</h2>

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
            <p>No events found matching your search query.</p>
        <?php endif; ?>
    </div>
</body>
</html>
