<?php
$pdo = new PDO("mysql:host=localhost;dbname=tour_booking_db", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageId = $_POST['package_id'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare("INSERT INTO comments (package_id, comment) VALUES (?, ?)");
    $stmt->execute([$packageId, $comment]);

    echo "OK";
} else {
    $packageId = $_GET['package_id'];
    $stmt = $pdo->prepare("SELECT comment FROM comments WHERE package_id = ? ORDER BY created_at DESC");
    $stmt->execute([$packageId]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
