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

    // Prepare an SQL statement to select the user
    $stmt = $pdo->prepare("SELECT * FROM tbl_categories");

    // Execute the statement
    $stmt->execute();

    // Fetch the category data
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}

