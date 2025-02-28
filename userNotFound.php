<?php include "./partials/head.php";

include './helpers.php';
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8">

        <div class="flex items-center justify-center w-3/4 mx-auto ">
            <hr class="flex-grow border-t border-DarkGrey border-2">
            <span class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold">
            🔒 User not found! 🔒
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2">
        </div>

        <p class="text-xl mt-12">Invalid user ID provided.</p>

        <button onclick="window.location='index.php'" class="p-4 mt-8 bg-gradient-45-red font-bold text-white rounded-3xl">Go home!</button>
    
        <button onclick="window.location='forum.php'" class="p-4 mt-8 bg-gradient-45 font-bold text-white rounded-3xl"><- Go to the forum</button>
    </div>
</body>
</html>
