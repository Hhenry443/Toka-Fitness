<?php 
include "./partials/head.php";
session_start(); // Start the session to access session variables
?>

<body class="bg-OffWhite h-screen flex flex-col">
    <!-- Navbar -->
    <?php include "./partials/navbar.php"; ?>
    
    <!-- Error Box -->
    <?php include "./partials/errorBox.php" ?>

    <!-- Centered Sign Up Form -->
    <div class="flex-grow flex justify-center items-center">
        <div id="signUpFormContainer" class="w-11/12 sm:w-8/12 md:w-6/12 lg:w-4/12 bg-white shadow-lg rounded-xl p-6" role="form" aria-labelledby="form-title">
            <h1 id="form-title" class="text-2xl font-bold text-center text-DarkBlue mb-6">Sign Up</h1>

            <form action="/api/processSignUp.php" method="POST" aria-describedby="form-description">
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-DarkBlue mb-2">Name</label>
                    <input 
                        required 
                        type="text" 
                        name="name" 
                        id="name" 
                        placeholder="Enter your name" 
                        maxlength="255"
                        class="w-full px-4 py-2 border border-LightGrey rounded-lg text-DarkBlue focus:outline-none focus:ring-2 focus:ring-LightBlue"
                        aria-required="true">
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-DarkBlue mb-2">Email</label>
                    <input 
                        required 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your email" 
                        maxlength="255"
                        class="w-full px-4 py-2 border border-LightGrey rounded-lg text-DarkBlue focus:outline-none focus:ring-2 focus:ring-LightBlue"
                        aria-required="true">
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
                        maxlength="255"
                        class="w-full px-4 py-2 border border-LightGrey rounded-lg text-DarkBlue focus:outline-none focus:ring-2 focus:ring-LightBlue"
                        aria-required="true">
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-LightRed text-OffWhite py-2 px-4 rounded-lg text-lg font-bold hover:bg-DarkRed transition-colors"
                    aria-label="Sign up">
                    Sign Up
                </button>
            </form>

            <!-- Separator -->
            <div class="flex items-center mt-6" aria-hidden="true">
                <hr class="flex-grow border-LightGrey">
                <span class="px-4 text-LightGrey">or</span>
                <hr class="flex-grow border-LightGrey">
            </div>

            <!-- Login Prompt -->
            <div class="text-center mt-6" aria-labelledby="login-prompt">
                <p id="login-prompt" class="text-sm text-DarkGrey">Already have an account?</p>
                <a 
                    href="/login.php" 
                    class="inline-block mt-2 px-4 py-2 bg-LightBlue text-OffWhite text-lg font-bold rounded-lg hover:bg-DarkBlue transition-colors"
                    aria-label="Go to Login page">
                    Login
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
