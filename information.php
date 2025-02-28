<?php include "./partials/head.php";

include './helpers.php';
include "./api/getCategories.php";

?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <div id="informationContainer" class="grid grid-cols-1 space-y-4 lg:grid-cols-5 md:grid-cols-3 w-full font-semibold place-items-center mt-8" role="list">
        <?php foreach($categories as $category): ?>
            <a 
                id="container<?= $category['category_id'] ?>" 
                class="h-96 w-72 bg-DarkBlue rounded-2xl drop-shadow-2xl" 
                href="/category.php?id=<?= $category['category_id'] ?>" 
                aria-label="Go to <?= $category['category_title'] ?> Exercises" 
                role="listitem">
                
                <img 
                    class="w-full h-2/3 rounded-t-2xl drop-shadow-2xl object-cover" 
                    src="./images/categories/<?= $category['category_title'] ?>.png" 
                    alt="<?= $category['category_title'] ?> category image">
                
                <div class="flex items-center justify-center h-1/3 bg-gradient-to-t rounded-2xl from-black via-transparent to-transparent">
                    <p class="text-white text-3xl"><?= $category['category_title'] ?> Exercises</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
