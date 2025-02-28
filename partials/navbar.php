<?php
// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the current page name
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div id="navbar" class="w-full h-24 bg-DarkBlue grid grid-cols-3 items-center">
    <!-- Home link with logo -->
    <a href="/" aria-label="Home">
        <div id="LogoContainer" class="flex justify-start items-center h-full ml-8">
            <img src="./images/TokaLogo.png" class="h-12 md:h-16 w-auto" alt="Toka Logo" />
        </div>
    </a>

    <!-- Hamburger menu button for mobile -->
    <div id="HamburgerContainer" class="flex justify-end items-center mr-8 md:hidden">
        <button id="HamburgerButton" class="flex flex-col items-center justify-center w-10 h-10 bg-white rounded-lg" aria-label="Toggle mobile menu">
            <span class="block w-6 h-0.5 bg-DarkBlue mb-1"></span>
            <span class="block w-6 h-0.5 bg-DarkBlue mb-1"></span>
            <span class="block w-6 h-0.5 bg-DarkBlue"></span>
        </button>
    </div>

    <!-- Links container for desktop view -->
    <div id="LinksContainer" class="hidden md:flex justify-center items-center">
        <a class="text-lg font-bold text-white mx-2 hover:underline" href="/information.php" aria-label="Information Page">Information</a>
        <a class="text-lg font-bold text-white mx-2 hover:underline" href="/forum.php" aria-label="Forum Page">Forum</a>
        <a class="text-lg font-bold text-white mx-2 hover:underline" href="/plans.php" aria-label="Custom Plans Page">Custom Plans</a>
    </div>

    <?php if (!isset($_SESSION['userID'])) : ?>
        <!-- Show Login Button if user is not logged in -->
        <div id="LoginContainer" class="flex justify-end items-center mr-8">
            <a href="/login.php" id="LoginButton" class="flex justify-center items-center w-32 h-10 bg-white rounded-xl" aria-label="Login">
                <p class="text-lg font-bold text-DeepBlue">Login</p>
            </a>
        </div>
    <?php else : ?>
        <!-- Check if current page is user.php -->
        <?php if ($currentPage === 'user.php') : ?>
            <!-- Show Logout Button on the Account Page -->
            <div id="LogoutContainer" class="flex justify-end items-center mr-8">
                <a id="LogoutButton" class="flex justify-center items-center w-32 h-10 bg-DarkRed rounded-xl" href="/logout.php" aria-label="Logout">
                    <p class="text-lg font-bold text-OffWhite">Logout</p>
                </a>
            </div>
        <?php else : ?>
            <!-- Show Profile Button on Other Pages -->
            <div id="ProfileContainer" class="flex justify-end items-center mr-8">
                <a id="ProfileButton" class="flex justify-center items-center w-32 h-10 bg-DarkRed rounded-xl" href="/user.php?id=<?= $_SESSION['userID'] ?>" aria-label="Profile">
                    <p class="text-lg font-bold text-OffWhite">Profile</p>
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Mobile Menu -->
<div id="MobileMenu" class="absolute top-24 left-0 h-16 w-full bg-LightBlue md:hidden hidden flex justify-center" aria-label="Mobile navigation menu">
    <a class="text-lg font-bold text-white mx-2 py-4" href="/information.php" aria-label="Information Page">Information</a>
    <a class="text-lg font-bold text-white mx-2 py-4" href="/forum.php" aria-label="Forum Page">Forum</a>
    <a class="text-lg font-bold text-white mx-2 py-4" href="/plans.php" aria-label="Custom Plans Page">Custom Plans</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerButton = document.getElementById('HamburgerButton');
        const mobileMenu = document.getElementById('MobileMenu');

        // Toggle mobile menu visibility on hamburger button click
        hamburgerButton.addEventListener('click', function() {
            hamburgerButton.classList.toggle('active');
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>
