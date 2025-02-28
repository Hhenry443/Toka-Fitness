<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "./partials/head.php";
include './helpers.php';
include './partials/db.php';
include './api/getAccount.php';
include './api/getAccountPosts.php';
?>

<body class="bg-OffWhite h-screen">
    <?php include "./partials/navbar.php" ?>
    <?php include "./partials/errorBox.php" ?>

    <div id="informationContainer" class="w-full flex flex-col items-center space-y-8">
        <!-- Profile Section -->
        <div class="w-full max-w-6xl bg-lightBlue flex justify-between items-center p-6 rounded-md shadow-lg" role="region" aria-labelledby="profileHeader">
            <h2 id="profileHeader" class="sr-only">User Profile</h2>
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 bg-red-500 rounded-full" aria-label="Profile Picture"></div>
                <div>
                    <h1 class="text-2xl font-bold" aria-labelledby="accountName"><?= $Account['name'] ?></h1>
                    <p class="text-sm text-gray-600" id="accountBio" aria-describedby="bioDescription"><?= $Account['bio'] ?></p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600" for="accountCreation">Account created:</p>
                <p class="text-lg font-semibold" id="accountCreation"><?= $Account['created_at'] ?></p>
            </div>
        </div>

        <!-- Recent Posts Section -->
        <div class="w-full max-w-6xl" role="region" aria-labelledby="recentPostsHeader">
            <h2 id="recentPostsHeader" class="text-lg font-bold text-gray-800 border-b pb-2">Recent Posts</h2>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="h-40 bg-white p-4 rounded-md shadow-md flex flex-col justify-between" role="article" aria-labelledby="postTitle<?= $post['post_id'] ?>" aria-describedby="postDescription<?= $post['post_id'] ?>">
                            <div>
                                <a href='post.php?id=<?= $post['post_id'] ?>' aria-labelledby="postTitle<?= $post['post_id'] ?>">
                                    <h3 id="postTitle<?= $post['post_id'] ?>" class="text-xl font-bold text-gray-800"><?= htmlspecialchars($post['post_title']) ?></h3>
                                </a>
                                <p class="text-sm text-gray-600" id="postCategory<?= $post['post_id'] ?>" aria-describedby="postCategoryDescription<?= $post['post_id'] ?>"><?= htmlspecialchars($post['post_category']) ?></p>
                                <span id="postCategoryDescription<?= $post['post_id'] ?>" class="sr-only">Category of the post</span>
                            </div>
                            <p class="text-sm text-gray-700 overflow-hidden" id="postDescription<?= $post['post_id'] ?>" aria-describedby="postExcerptDescription<?= $post['post_id'] ?>"><?= htmlspecialchars(substr($post['post_content'], 0, 60)) ?>...</p>
                            <span id="postExcerptDescription<?= $post['post_id'] ?>" class="sr-only">Excerpt of the post content</span>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-xs text-gray-500"><?= htmlspecialchars($post['post_date']) ?></p>
                                <p class="text-xs text-gray-500"><?= $post['post_replies'] ?> replies</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-span-3 text-center text-gray-600">No posts found for this Account.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
