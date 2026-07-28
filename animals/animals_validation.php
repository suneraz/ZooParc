<?php
// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "zooparc_db");

// Verify the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch animal details from the database
$query = "SELECT * FROM animals";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals | ZooParc</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Animals at ZooParc Zoological Park</h1>
        <div class="animals-list">
            <?php
            // Check if there are any animals in the database
            if (mysqli_num_rows($result) > 0) {
                // Output data for each animal
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="animal">';
                    echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p><strong>Species:</strong> ' . $row["species"] . '</p>';
                    echo '<p><strong>Habitat:</strong> ' . $row["habitat"] . '</p>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No animals found.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>

