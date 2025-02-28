<?php include "./partials/head.php";
include './helpers.php';
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8" role="main">

        <!-- Header -->
        <div class="flex items-center justify-center w-3/4 mx-auto " aria-labelledby="upgradeHeading">
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
            <span id="upgradeHeading" class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold">
                Want to Upgrade?
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2" aria-hidden="true">
        </div>

        <!-- Upgrade Cards -->
        <div class="flex flex-row justify-center mt-8 space-x-8 w-3/4" aria-live="polite">
            <!-- Free Plan -->
            <div class="bg-gradient-45-grey rounded-lg shadow-lg flex flex-col items-center w-1/3" aria-labelledby="freePlanHeading">
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold text-2xl py-2 px-4 rounded-t-lg" role="banner">
                    Free
                </div>
                <ul class="flex-1 w-full mt-4 space-y-4 text-center" aria-labelledby="freePlanHeading">
                    <li class="border-b border-DarkGrey pb-2">Only Access Free Content</li>
                    <li class="border-b border-DarkGrey pb-2">Limited Forum Access</li>
                    <li class="border-b border-DarkGrey pb-2">Generic Plans</li>
                    <li class="border-b border-DarkGrey pb-2">Less Priority Support</li>
                </ul>
            </div>

            <!-- Premium Plan -->
            <div class="bg-gradient-45-grey rounded-lg shadow-lg flex flex-col items-center w-2/4" aria-labelledby="premiumPlanHeading">
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-red-500 to-red-700 text-white font-bold text-4xl py-2 px-4 rounded-t-lg" role="banner">
                    Premium
                </div>
                <ul class="flex-1 w-full mt-4 space-y-4 text-center" aria-labelledby="premiumPlanHeading">
                    <li class="border-b border-DarkGrey pb-2">Access PREMIUM Content</li>
                    <li class="border-b border-DarkGrey pb-2">Unlimited Access to Forums</li>
                    <li class="border-b border-DarkGrey pb-2">Personalised Plans</li>
                    <li class="border-b border-DarkGrey pb-2">24/7 Support</li>
                </ul>
            </div>
        </div>

        <!-- Upgrade Button -->
        <div class="mt-8">
            <form action="/checkout.php" aria-labelledby="upgradeButton">
                <button id="upgradeButton" class="bg-gradient-to-r from-DarkBlue to-DarkRed text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:scale-105 transform transition" type="submit" aria-label="Proceed to checkout for upgrade">
                    Upgrade Now!
                </button>
            </form>
        </div>
    </div>
</body>
</html>
