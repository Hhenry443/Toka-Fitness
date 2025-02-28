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
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $userID = $_POST['userID'];
        $currentTime = date('Y-m-d H:i:s'); // Get the current timestamp

        // Insert the new post into tbl_forum_posts
        $stmt = $pdo->prepare("INSERT INTO tbl_forum_posts (author_id, post_content, post_title, post_category, post_date) VALUES (:author_id, :post_content, :post_title, :post_category, :post_date)");

        // Bind parameters to the query
        $stmt->bindParam(':author_id', $userID);
        $stmt->bindParam(':post_content', $content);
        $stmt->bindParam(':post_title', $title);
        $stmt->bindParam(':post_category', $category);
        $stmt->bindParam(':post_date', $currentTime);

        // Execute the INSERT statement
        if ($stmt->execute()) {
            // Get the ID of the newly inserted post
            $postId = $pdo->lastInsertId();

            // Redirect to the post page after successful insertion
            redirect('/post.php?id=' . $postId);
        } else {
            $_SESSION['error'] = 'Failed to post!';
            redirect('/make-post.php');
        }
    }
} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}
?>
