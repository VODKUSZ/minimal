<?php
$host = "localhost";
$db   = "minimal";
$user = "user_minimal";
$pass = "alma";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // JSON API-nál jobb nem HTML-t kiírni
    http_response_code(500);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["error" => "Adatbázis kapcsolat hiba", "message" => $e->getMessage()]);
    exit;
}
