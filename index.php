<?php include "./partials/head.php" ?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>
 
    <!-- Background Image -->
    <div id="backgroundImage" class="relative w-full h-[70vh]" aria-labelledby="imageStrapline">
        <div id="imageStrapline" class="absolute inset-0 flex items-center justify-center">
            <p class="text-white text-6xl font-bold bg-LightGrey rounded-xl drop-shadow-xl p-4" id="imageDescription">We do the heavy lifting!</p>
        </div>
        <img src="/images/homeMainImage.jpg" class="w-full h-full object-cover" alt="Man loading weights onto a barbell" />
    </div>

    <!-- Information Container -->
    <div id="informationContainers" class="relative w-full grid grid-cols-3 place-items-center mt-[-7rem] z-10">
        <div id="container1" class="w-4/5 h-72 bg-gradient-325 rounded-3xl flex flex-col items-center" aria-labelledby="container1Title container1Description">
            <p class="text-3xl font-bold text-white mt-8" id="container1Title">Way More Choice</p>
            <p class="text-2xl text-white text-wrap text-center mt-8 w-4/5" id="container1Description">Get more than you pay for with lots of content!</p>
            <a href="/information.php" class="h-16 w-2/4 mt-8 bg-LightRed flex flex-col justify-center items-center rounded-xl" aria-label="Explore Information">
                <p class="text-xl text-white font-bold">Explore Information</p>
            </a>
        </div>
        <div id="container2" class="w-4/5 h-72 bg-gradient-325 rounded-3xl flex flex-col items-center" aria-labelledby="container2Title container2Description">
            <p class="text-3xl font-bold text-white mt-8" id="container2Title">Way more flexibility</p>
            <p class="text-2xl text-white text-wrap text-center mt-8 w-4/5" id="container2Description">Flexible hours ensure you can always get what you need!</p>
            <a href="/opening-hours.php" class="h-16 w-2/4 mt-8 bg-LightRed flex flex-col justify-center items-center rounded-xl" aria-label="View Opening Hours">
                <p class="text-xl text-white font-bold">Opening Hours</p>
            </a>
        </div>
        <div id="container3" class="w-4/5 h-72 bg-gradient-325 rounded-3xl flex flex-col items-center" aria-labelledby="container3Title container3Description">
            <p class="text-3xl font-bold text-white mt-8" id="container3Title">Way more for Premium</p>
            <p class="text-2xl text-white text-wrap text-center mt-8 w-4/5" id="container3Description">Membership discounts available - Up to 15% off!</p>
            <a href="/upgrade.php" class="h-16 w-2/4 mt-8 bg-LightRed flex flex-col justify-center items-center rounded-xl" aria-label="Upgrade to Premium">
                <p class="text-xl text-white font-bold">Premium Upgrade</p>
            </a>
        </div>
    </div>
</body>
</html>
