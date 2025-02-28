<?php 
include "./partials/head.php";
session_start(); // Start the session to access session variables
?>

<body class="bg-OffWhite h-screen flex flex-col">
    <!-- Navbar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Error Box -->
    <?php include "./partials/errorBox.php"; ?>

    <!-- Centered Login Form -->
    <div class="flex-grow flex justify-center items-center">
        <div id="loginFormContainer" class="w-11/12 sm:w-8/12 md:w-6/12 lg:w-4/12 bg-white shadow-lg rounded-xl p-6" aria-labelledby="loginFormHeading">
            <h1 id="loginFormHeading" class="text-2xl font-bold text-center text-DarkBlue mb-6">Login</h1>

            <form action="/api/processLogin.php" method="POST" aria-describedby="loginFormDescription">
                <p id="loginFormDescription" class="sr-only">Please log in with your email and password. Fields marked as required must be completed.</p>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-DarkBlue mb-2">Email</label>
                    <input 
                        required 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your email" 
                        aria-required="true"
                        class="w-full px-4 py-2 border border-LightGrey rounded-lg text-DarkBlue focus:outline-none focus:ring-2 focus:ring-LightBlue">
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="block text-lg font-medium text-DarkBlue mb-2">Password</label>
                    <input 
                        required 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter your password" 
                        aria-required="true"
                        class="w-full px-4 py-2 border border-LightGrey rounded-lg text-DarkBlue focus:outline-none focus:ring-2 focus:ring-LightBlue">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input 
                        type="checkbox" 
                        id="rememberMe" 
                        name="remember_me" 
                        class="h-4 w-4 text-LightBlue border border-LightGrey rounded focus:ring-2 focus:ring-LightBlue"
                        aria-describedby="rememberMeDescription">
                    <label for="rememberMe" class="ml-2 text-sm font-medium text-DarkBlue">Remember Me</label>
                    <p id="rememberMeDescription" class="sr-only">Check this box to stay logged in on this device.</p>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-LightRed text-OffWhite py-2 px-4 rounded-lg text-lg font-bold hover:bg-DarkRed transition-colors"
                    aria-label="Submit the login form">
                    Login
                </button>
            </form>

            <!-- Separator -->
            <div class="flex items-center mt-6" aria-hidden="true">
                <hr class="flex-grow border-LightGrey">
                <span class="px-4 text-LightGrey">or</span>
                <hr class="flex-grow border-LightGrey">
            </div>

            <!-- Signup Prompt -->
            <div class="text-center mt-6">
                <p class="text-sm text-DarkGrey">Don't have an account?</p>
                <a 
                    href="/signup.php" 
                    class="inline-block mt-2 px-4 py-2 bg-LightBlue text-OffWhite text-lg font-bold rounded-lg hover:bg-DarkBlue transition-colors"
                    aria-label="Sign up for a new account">
                    Sign Up
                </a>
            </div>

            <!-- Back Button -->
            <a 
                href="javascript:void(0);" 
                onclick="window.history.back();" 
                class="block mt-6 text-center text-sm font-medium text-DarkBlue underline"
                aria-label="Go back to the previous page">
                &larr; Go Back
            </a>
        </div>
    </div>
</body>
</html>
