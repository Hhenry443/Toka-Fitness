<?php include "./partials/head.php";

include './helpers.php';
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8" role="main">

        <div class="flex items-center justify-center w-3/4 mx-auto " aria-live="assertive">
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
            <span class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold" role="alert" aria-live="assertive">
                🔒 You do not have the right account tier! 🔒
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
        </div>

        <p class="text-xl mt-12" id="accessRequirement">To access this content you must</p>

        <button 
            onclick="window.location='upgrade.php'" 
            class="p-4 mt-8 bg-gradient-45-red font-bold text-white rounded-3xl" 
            aria-label="Upgrade your account to access premium content">
            Upgrade Now!
        </button>
    
        <button 
            onclick="window.location='information.php'" 
            class="p-4 mt-8 bg-gradient-45 font-bold text-white rounded-3xl" 
            aria-label="Go back to previous page">
            <- Go Back
        </button>
    </div>
</body>
</html>
