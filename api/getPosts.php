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

    // Prepare an SQL statement with a JOIN to fetch post details and the username
    $stmt = $pdo->prepare("
        SELECT 
            p.*, 
            u.name AS post_author 
        FROM 
            tbl_forum_posts p
        LEFT JOIN 
            tbl_users u 
        ON 
            p.author_id = u.user_id
    ");

    // Execute the statement
    $stmt->execute();

    // Fetch the posts data with the author's username included
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}
