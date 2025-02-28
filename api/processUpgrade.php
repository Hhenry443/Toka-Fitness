<?php
require '../helpers.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../partials/db.php';

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);
    // Set error mode to exception to catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the user is logged in. We will need to use the user ID 
        if (!isset($_SESSION['userID'])) {
            $_SESSION['error'] = "You must be logged in to upgrade.";
            redirect('/login.php');
            die;
        }

        // Check user is already a premium user
        if (isset($_SESSION['user_tier']) && $_SESSION['user_tier'] == 'premium') {
            $_SESSION['error'] = "You are already a premium user!";
            redirect('/checkout.php');
            die;
        }

        // If the user is logged in and has a free account prepare to insert the new data 
        $stmt = $pdo->prepare("UPDATE tbl_users SET tier = 'premium' WHERE user_id = :user_id");

        // Bind parameters to the query
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        // Execute the statement
        if ($stmt->execute()) {

            // Set session variables
            $_SESSION["user_tier"] = 'premium';

            // Redirect to the home page
            redirect('/');

        } else {
            echo "Failed to update data.";
        }
    }
} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}
