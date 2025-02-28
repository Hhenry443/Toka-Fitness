<?php include "./partials/head.php"; 
include './helpers.php'; 
include './api/getPosts.php'; 
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php"; ?>

    <?php include "./partials/errorBox.php"; ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8" role="main">

        <!-- Header -->
        <div class="flex items-center justify-center w-3/4 mx-auto" aria-labelledby="forumHeader">
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
            <span id="forumHeader" class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold">
                Forum
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
        </div>

        <!-- Forum Titles -->
        <div class="h-16 w-3/4 bg-DarkBlue mt-8 flex items-center border-b border-gray-500 text-white divide-x font-semibold" role="rowgroup">
            <!-- Category Text -->
            <div class="flex-none w-1/6 pl-4" role="columnheader" aria-sort="none">
                <p class="text-lg">Category</p>
            </div>

            <!-- Title Text -->
            <div class="flex-grow pl-4" role="columnheader" aria-sort="none">
                <p class="text-lg">Title</p>
            </div>

            <!-- Author Text -->
            <div class="flex-none w-1/6 pl-4" role="columnheader" aria-sort="none">
                <p class="text-lg">Author</p>
            </div>

            <!-- Date Text -->
            <div class="flex-none w-1/6 pl-4" role="columnheader" aria-sort="none">
                <p class="text-lg">Date</p>
            </div>

            <!-- Replies Text -->
            <div class="flex-none w-1/12 ml-2 pl-4" role="columnheader" aria-sort="none">
                <p class="text-lg">Replies</p>
            </div>
        </div>

        <?php foreach($posts as $post) : ?>
            <div class="h-16 w-3/4 bg-white mt-2 flex items-center border border-gray-500 text-black divide-black divide-x font-semibold rounded-xl" role="row">
                <!-- Category Text -->
                <div class="flex-none w-1/6 pl-4" role="cell">
                    <a href="/post.php?id=<?= $post['post_id'] ?>" class="text-lg block" aria-label="Go to <?= $post['post_category'] ?> category"><?= $post['post_category'] ?></a>
                </div>

                <!-- Title Text -->
                <div class="flex-grow pl-4" role="cell">
                    <a href="/post.php?id=<?= $post['post_id'] ?>" class="text-lg block" aria-label="Go to post titled <?= $post['post_title'] ?>"><?= $post['post_title'] ?></a>
                </div>

                <!-- Author Text -->
                <div class="flex-none w-1/6 pl-4" role="cell">
                    <a href="/user.php?id=<?= $post['author_id'] ?>" class="text-lg block" aria-label="View <?= $post['post_author'] ?>'s profile">
                        <p class="text-lg"><?= $post['post_author'] ?></p>
                    </a>
                </div>

                <!-- Date Text -->
                <div class="flex-none w-1/6 pl-4" role="cell">
                    <p class="text-lg"><?= $post['post_date'] ?></p>
                </div>

                <!-- Replies Text -->
                <div class="flex-none w-1/12 ml-2 pl-4" role="cell">
                    <p class="text-lg"><?= $post['post_replies'] ?></p>
                </div>
            </div>
        <?php endforeach ;?>

        <!-- "Make a Post" Button -->
        <div class="fixed bottom-10 right-10" role="complementary" aria-label="Create a new post">
            <a href="make-post.php" class="bg-LightRed text-white px-16 py-8 rounded-lg text-xl font-semibold shadow-lg hover:bg-DarkGrey" aria-label="Make a new post">
                Make a Post ✍️
            </a>
        </div>
    </div>
</body>
</html>
