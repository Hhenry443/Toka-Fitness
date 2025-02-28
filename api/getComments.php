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

    // Get the postID from request (e.g., GET or POST)
    $postID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($postID) {
        // Prepare the statement to fetch a single post by its ID
        $stmt = $pdo->prepare("SELECT * FROM tbl_comments WHERE post_id = :postID");
        $stmt->bindParam(':postID', $postID, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the single post
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$post) {
            $error_message = "Post not found.";
        }
    } else {
        $error_message = "Invalid post ID.";
    }
} catch (PDOException $e) {
    $error_message = "Connection failed: " . $e->getMessage();
}
