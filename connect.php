<?php
$host = "localhost";
$db   = "minimal";
$user = "user_minimal";
$pass = "alma";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );
    echo '<br>' . "Sikeres csatlakozás az adatbázishoz.";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Adatbázis kapcsolat hiba: " . $e->getMessage());
}
