<?php
include "./partials/head.php";
include './helpers.php';
include "./api/getExcersiseInformation.php";

if(!isset($_SESSION['user_tier'])) {
    $_SESSION['user_tier'] = 'notLoggedIn';
}

if ($_SESSION['user_tier'] == "free" && $information['exercise_tier'] == "premium") {
    header("Location: errorPage.php");
    exit();
}

if ($_SESSION['user_tier'] == "notLoggedIn" && $information['exercise_tier'] == "premium") {
    header("Location: login.php");
    exit();
}

// Split the exercise tips into an array, checking if 'exercise_tips' exists
$tips = isset($information['exercise_tips']) ? explode(',', $information['exercise_tips']) : ['null'];
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php"; ?>

    <?php if (isset($information['exercise_tier']) && $information['exercise_tier'] === 'premium'): ?>
        <!-- Premium Banner -->
        <div class="absolute left-0 right-0 z-10 bg-red-600 text-white text-lg font-bold py-2 text-center" role="banner" aria-live="assertive">
            Premium
        </div>
    <?php endif; ?>

    <div class="flex items-center justify-center w-3/4 mx-auto mt-12">
        <hr class="flex-grow border-t border-DarkGrey border-2">
        <span 
            class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold" 
            id="exerciseTitle"
            aria-labelledby="exerciseTitle">
            <?= isset($information['exercise_title']) ? $information['exercise_title'] : 'null' ?>
        </span>
        <hr class="flex-grow border-t border-DarkGrey border-2">
    </div>

    <div id="container" class="flex flex-col items-center justify-center space-y-10">
        <!-- Exercise Image -->
        <img 
            src="./images/content/<?= isset($information['exercise_title']) ? $information['exercise_title'] : 'null' ?>.png" 
            alt="<?= isset($information['exercise_title']) ? $information['exercise_title'] : 'null' ?>" 
            class="w-1/3 h-96 mt-8 rounded-lg shadow-lg"
            role="img"
            aria-label="<?= isset($information['exercise_title']) ? $information['exercise_title'] : 'Exercise image' ?>"
        >

        <!-- "What is it?" section -->
        <div class="text-center" role="region" aria-labelledby="whatIsIt">
            <p class="text-2xl text-DarkGrey font-bold underline mb-4" id="whatIsIt">What is it?</p>
            <p class="text-xl text-DarkGrey w-full md:w-2/3 mx-auto" aria-describedby="whatIsItDescription">
                <?= isset($information['exercise_what_is']) ? $information['exercise_what_is'] : 'null' ?>
            </p>
        </div>

        <!-- Tips Section -->
        <?php if (!empty($tips)): ?>
            <div class="w-full md:w-2/3 bg-white p-6 rounded-lg shadow-lg" role="region" aria-labelledby="tipsSection">
                <p class="text-2xl text-DarkGrey font-bold mb-6 underline text-center" id="tipsSection">Tips</p>
                <ol class="list-decimal list-inside space-y-4 text-lg text-DarkGrey" aria-live="polite">
                    <?php foreach ($tips as $tip): ?>
                        <li class="bg-OffWhite p-3 rounded-lg shadow-md" role="listitem">
                            <?= isset($tip) && !empty($tip) ? trim($tip) : 'null' ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
