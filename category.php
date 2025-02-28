<?php include "./partials/head.php";

include './helpers.php';
include "./api/getContent.php";

?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <div id="informationContainer" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 w-full gap-8 place-items-center mt-8 px-4" role="region" aria-labelledby="informationHeading">
        <h2 id="informationHeading" class="sr-only">Available Content</h2> <!-- Hidden heading for screen readers -->
        
        <?php foreach($contents as $content): ?>
            <a 
                id="container<?= $content['cat_content_id'] ?>" 
                class="relative h-96 w-72 bg-DarkBlue rounded-2xl overflow-hidden" 
                href="/content.php?id=<?= $content['cat_content_id'] ?>"
                aria-label="View <?= $content['cat_content_title'] ?> content"
                role="link">

                <!-- Image -->
                <img 
                    class="w-full h-2/3 rounded-t-2xl drop-shadow-2xl object-cover" 
                    src="./images/categories/<?= $content['cat_content_title'] ?>.png" 
                    alt="<?= $content['cat_content_title'] ?> image">

                <!-- Title -->
                <div class="flex items-center justify-center h-1/3 bg-gradient-to-t from-black via-transparent to-transparent">
                    <p class="text-white text-3xl font-semibold"><?= $content['cat_content_title'] ?></p>
                </div>

                <!-- Tier Label -->
                <div 
                    class="absolute top-0 right-0 bg-red-600 text-white text-sm font-bold px-3 py-1 rounded-bl-lg 
                    <?= $content['cat_content_tier'] === 'premium' ? 'bg-red-600' : 'bg-green-500' ?>"
                    aria-label="<?= $content['cat_content_tier'] === 'premium' ? 'Premium content' : 'Free content' ?>"
                    role="status">
                    <?= $content['cat_content_tier'] === 'premium' ? 'Premium' : 'Free' ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
