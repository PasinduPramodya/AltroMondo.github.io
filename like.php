<?php
$pdo = new PDO("mysql:host=localhost;dbname=tour_booking_db", username: "root", password: "");
$packageId = $_GET['package_id'];

// Check if like record exists
$stmt = $pdo->prepare("SELECT * FROM likes WHERE package_id = ?");
$stmt->execute([$packageId]);
$like = $stmt->fetch();

if ($like) {
    $stmt = $pdo->prepare("UPDATE likes SET like_count = like_count + 1 WHERE package_id = ?");
    $stmt->execute([$packageId]);
} else {
    $stmt = $pdo->prepare("INSERT INTO likes (package_id, like_count) VALUES (?, 1)");
    $stmt->execute([$packageId]);
}

// Return updated count
$stmt = $pdo->prepare("SELECT like_count FROM likes WHERE package_id = ?");
$stmt->execute([$packageId]);
$count = $stmt->fetchColumn();

echo json_encode(['likes' => $count]);
