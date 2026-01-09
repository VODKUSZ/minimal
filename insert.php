<?php
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/connect.php";

// JSON beolvasása
$json = file_get_contents("php://input");
$data = json_decode($json, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(["error" => "Érvénytelen JSON"]);
    exit;
}

$task = trim($data["task"] ?? "");
$finished = (bool)($data["finished"] ?? false);

if ($task === "") {
    http_response_code(422);
    echo json_encode(["error" => "A task mező kötelező"]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO todo (task, finished) VALUES (:task, :finished)");
    $stmt->execute([
        ":task" => $task,
        ":finished" => $finished ? 1 : 0
    ]);

    http_response_code(201);
    echo json_encode([
        "success" => true,
        "id" => (int)$pdo->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Adatbázis hiba",
        "message" => $e->getMessage()
    ]);
}
