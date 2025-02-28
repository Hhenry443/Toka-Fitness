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

    // Get the category id from request GET 
    $category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($category_id) {
        // Prepare the statement to fetch content by its ID
        $stmt = $pdo->prepare("SELECT * FROM tbl_cat_content WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the  content
        $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$contents) {
            $error_message = "Category not found.";
        }
    } else {
        $error_message = "Invalid category ID.";
    }
} catch (PDOException $e) {
    $error_message = "Connection failed: " . $e->getMessage();
}
