<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "./partials/head.php";
include './helpers.php';
include './api/getSinglePost.php';
include './api/getComments.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['userID']); 
?>

<body class="bg-OffWhite h-screen">
    <?php include "./partials/navbar.php" ?>
    <?php include "./partials/errorBox.php" ?>

    <div id="informationContainer" class="w-full flex flex-col items-center space-y-8">

        <!-- Post Container -->
        <div class="bg-DarkBlue h-fit w-2/3 border border-4 border-gray-400 mx-auto mt-8" role="article" aria-labelledby="postTitle">
            <p id="postTitle" class='text-4xl text-white mt-2 ml-8' aria-live="polite"><?= $post['post_title'] ?></p>
            <a href='/user.php?id=<?= $post['author_id'] ?>' aria-label="View author profile of <?= $post['post_author'] ?>">
                <p class='text-md text-white mt-2 ml-8'>By: <?= $post['post_author'] ?></p>
            </a>
            <p class='text-xl text-white mt-8 mx-8' aria-describedby="postContent"><?= $post['post_content'] ?></p>

            <button 
                class="bg-LightRed hover:bg-DarkRed text-white font-bold py-1 px-4 rounded my-4 ml-8"
                onclick="handleReplyButton(<?= $isLoggedIn ? 'true' : 'false' ?>)"
                aria-label="Reply to this post"
            >
                Reply
            </button>

        </div>

        <!-- Comments Container -->
        <?php 
        $counter = 1; // Initialize counter
        foreach($comments as $comment) : 
        ?>
            <div class="bg-DarkBlue h-fit w-2/3 border border-4 border-gray-400 mx-auto" role="listitem">
                <p class="text-sm text-white mt-2 ml-8 break-words" id="comment-<?= $counter ?>" aria-live="polite">Reply <?= $counter ?></p>
                <p class="text-md text-white mt-2 ml-8 break-words">By: <?= $comment['comment_author'] ?></p>
                <p class="text-xl text-white my-4 mx-8 break-words" aria-describedby="commentContent-<?= $counter ?>"><?= $comment['comment'] ?></p>
            </div>
        <?php 
            $counter++; // Increment counter
        endforeach; 
        ?>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="bg-white w-1/2 p-6 rounded shadow-md">
            <h2 id="modalTitle" class="text-2xl font-bold mb-4">Post Your Reply</h2>
            <form action="./api/processReply.php" method="POST">
                <textarea 
                    required 
                    name="reply_content" 
                    class="w-full h-32 p-2 border rounded" 
                    placeholder="Write your reply..." 
                    maxlength="255"
                    oninput="updateCharacterCount(this)"
                    aria-describedby="charCount"
                ></textarea>
                <p class="text-sm text-gray-600" id="charCount">255 characters remaining</p>
                <input type="hidden" name="postId" value="<?= $post['post_id'] ?>"> 
                <input type="hidden" name="username" value="<?= $_SESSION['name'] ?>"> 
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded mr-2" onclick="closeModal()" aria-label="Cancel reply">Cancel</button>
                    <button type="submit" class="bg-LightRed hover:bg-DarkRed text-white py-2 px-4 rounded" aria-label="Submit reply">Post Reply</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Update character count dynamically
        function updateCharacterCount(textarea) {
            const maxLength = 255;
            const remaining = maxLength - textarea.value.length;
            document.getElementById('charCount').textContent = `${remaining} characters remaining`;
        }
    </script>

    <script>
        // Handle the Reply button click
        function handleReplyButton(isLoggedIn) {
            if (!isLoggedIn) {
                window.location.href = './loginRedirect.php';
                return;
            }
            document.getElementById('replyModal').classList.remove('hidden');
            document.getElementById('replyModal').setAttribute('aria-hidden', 'false');
        }

        // Close modal
        function closeModal() {
            document.getElementById('replyModal').classList.add('hidden');
            document.getElementById('replyModal').setAttribute('aria-hidden', 'true');
        }
    </script>
</body>
</html>
