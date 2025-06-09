<?php
$host = "localhost";
$user = "root"; // default for XAMPP/WAMP
$pass = "";     // default is empty
$db   = "tour_booking_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and fetch POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$datetime = $_POST['datetime'] ?? '';
$destination = $_POST['destination'] ?? '';
$persons = $_POST['persons'] ?? 1;
$category = $_POST['category'] ?? '';
$message = $_POST['message'] ?? '';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (name, email, datetime, destination, persons, category, special_request) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $name, $email, $datetime, $destination, $persons, $category, $message);

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
