<?php
include 'db_connect.php';

// Admin credentials
$username = 'admin';
$password = 'admin123';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into the database
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param('ss', $username, $hashed_password);
    $stmt->execute();
    echo "Admin user created successfully!";
    $stmt->close();
} else {
    echo "Error preparing the query.";
}

$conn->close();
?>

