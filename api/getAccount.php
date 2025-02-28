<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require './partials/db.php';

// Sanitize and fetch the user ID
$userID = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

try {
    // Ensure database credentials are defined
    if (!isset($dsn, $user, $pass)) {
        throw new Exception("Database configuration is missing.");
    }

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($userID) {
        // Prepare an SQL statement to select the user
        $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE user_id = :userID");
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Fetch the user data
        $Account = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // User not found
            header('Location: ../userNotFound.php');
            exit;
        }
    } else {
        // User not found
        header('Location: ../userNotFound.php');
        exit;
    }
} catch (PDOException $e) {
    // Handle any database-related errors
    echo "Database error: " . $e->getMessage();
    exit;
} catch (Exception $e) {
    // Handle general errors
    echo "Error: " . $e->getMessage();
    exit;
}
