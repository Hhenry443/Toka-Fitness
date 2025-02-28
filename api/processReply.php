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
        $reply_content = $_POST['reply_content'];
        $username = $_POST['username'];
        $postId = $_POST['postId'];

        // Insert the new comment into tbl_comments
        $stmt = $pdo->prepare("INSERT INTO tbl_comments (post_id, comment_author, comment) VALUES (:postId, :username, :reply_content)");

        // Bind parameters to the query
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':reply_content', $reply_content);

        // Execute the INSERT statement
        if ($stmt->execute()) {
            // Update the 'post_replies' column in tbl_forum_posts
            $updateStmt = $pdo->prepare("
                UPDATE tbl_forum_posts 
                SET post_replies = post_replies + 1 
                WHERE post_id = :postId
            ");

            // Bind the postId parameter
            $updateStmt->bindParam(':postId', $postId);

            // Execute the UPDATE statement
            if ($updateStmt->execute()) {
                // Redirect to the post page after successful update
                redirect('/post.php?id=' . $postId);
            } else {
                echo "Failed to update post replies.";
            }
        } else {
            echo "Failed to insert comment.";
        }
    }
} catch (PDOException $e) {
    // Handle any errors during the connection or execution
    echo "Database error: " . $e->getMessage();
}
