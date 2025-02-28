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
        // Get the submitted form data
        $password = $_POST['password'];
        $email = $_POST['email'];
        $name = $_POST['name'];

        // Check if password is less than 6 characters
        if (strlen($password) < 6) {
            $_SESSION['error'] = "Password must be greater than 6 characters.";
            redirect('/signup.php');
            die;
        }

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // User or email already exists
            $_SESSION['error'] = "Email already taken. Please choose a different one.";
            redirect('../signup.php');
            die;
        }

        // If no existing user, proceed to insert the data
        $stmt = $pdo->prepare("INSERT INTO tbl_users (password, email, name, created_at) VALUES (:password, :email, :name, :created_at)");

        // Bind parameters to the query
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':created_at', date('Y-m-d'));


        // Execute the statement
        if ($stmt->execute()) {
            // Get the ID of the last inserted row
            $lastInsertId = $pdo->lastInsertId();

            // Fetch the newly inserted user's tier
            $stmt = $pdo->prepare("SELECT tier FROM tbl_users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $lastInsertId);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Set session variables
                $_SESSION["name"] = $name;
                $_SESSION["userID"] = $lastInsertId;
                $_SESSION["user_tier"] = $user['tier']; // Assuming 'tier' is the column name

                // Redirect to the Users Profile
                redirect('/user.php?id=' . $lastInsertId);
            } else {
                echo "Failed to fetch user tier.";
            }
        } else {
            echo "Failed to insert data.";
        }
    }
} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}
