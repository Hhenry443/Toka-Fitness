<?php include "./partials/head.php"; ?>
<body class="bg-OffWhite">
    <?php include "./partials/navbar.php"; ?>

    <div class="container mx-auto mt-12">
        <h1 class="text-3xl font-bold text-DarkGrey text-center mb-8">Website Sitemap</h1>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-DarkGrey mb-4">Home</h2>
                <ul class="list-disc list-inside text-lg text-DarkGrey">
                    <li><a href="index.php" class="text-DarkGrey hover:text-blue-500">Home Page</a></li>
                    <li><a href="login.php" class="text-DarkGrey hover:text-blue-500">Login</a></li>
                    <li><a href="errorPage.php" class="text-DarkGrey hover:text-blue-500">Profile Page</a></li>
                    <?php if (isset($_SESSION['userID'])) : ?>
                        <li><a href="profile.php?id=<?= $_SESSION['userID']?>" class="text-DarkGrey hover:text-blue-500">Profile Page</a></li>
                    <?php endif ?>


                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-DarkGrey mb-4">Information Navigation Page</h2>
                <ul class="list-disc list-inside text-lg text-DarkGrey">
                    <li><a href="Information.php" class="text-DarkGrey hover:text-blue-500">Muscle Groups</a></li>
                    <li><a href="category.php?id=1" class="text-DarkGrey hover:text-blue-500">Excersises</a></li>
                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-DarkGrey mb-4">Forum</h2>
                <ul class="list-disc list-inside text-lg text-DarkGrey">
                    <li><a href="forum.php" class="text-DarkGrey hover:text-blue-500">Forum Hub</a></li>
                    <li><a href="make-post.php?id=1" class="text-DarkGrey hover:text-blue-500">Make a Post</a></li>
                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-DarkGrey mb-4">Custom Plans</h2>
                <ul class="list-disc list-inside text-lg text-DarkGrey">
                    <li><a href="plans.php" class="text-DarkGrey hover:text-blue-500">Custom Plan</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
