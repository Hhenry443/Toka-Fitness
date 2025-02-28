<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require './partials/db.php';

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    // Set error mode to exception to catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the content id from request GET 
    $content_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($content_id) {
        // Prepare the statement to fetch content by its ID
        $stmt = $pdo->prepare("SELECT * FROM tbl_exercise WHERE exercise_id = :content_id");
        $stmt->bindParam(':content_id', $content_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the  content
        $information = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$information) {
            $error_message = "content not found.";
        }
    } else {
        $error_message = "Invalid content ID.";
    }
} catch (PDOException $e) {
    $error_message = "Connection failed: " . $e->getMessage();
}
