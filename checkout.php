<?php include "./partials/head.php";
include './helpers.php';
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <?php include "./partials/errorBox.php" ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8">

        <!-- Header -->
        <div class="flex items-center justify-center w-3/4 mx-auto ">
            <hr class="flex-grow border-t border-DarkGrey border-2">
            <span class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold">
                Checkout
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2">
        </div>

        <!-- Price Info --> 
        <p class="mt-8 text-lg font-bold">It will be a one-time £14.99 purchase.</p> <br>
        <p>This will give you a premium account <span class="text-xl font-bold">forever!</span></p>

        <!-- Card Input Form -->
        <div class="w-full max-w-lg mt-8">
            <form action="/api/processUpgrade.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
                <div class="mb-6">
                    <label for="cardNumber" class="block text-lg font-medium text-DarkGrey">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" pattern="\d{4} \d{4} \d{4} \d{4}" 
                        placeholder="1234 5678 9012 3456" class="w-full p-3 mt-2 border border-DarkGrey rounded-lg focus:outline-none focus:ring-2 focus:ring-DarkBlue" required maxlength="19" oninput="formatCardNumber(event)">
                </div>

                <div class="flex mb-6 space-x-6">
                    <div class="w-1/2 relative">
                        <label for="expiryDate" class="block text-lg font-medium text-DarkGrey">Expiry Date</label>
                        <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" 
                            class="w-full p-3 mt-2 border border-DarkGrey rounded-lg focus:outline-none focus:ring-2 focus:ring-DarkBlue" required maxlength="5" oninput="formatExpiryDate(event)">
                    </div>

                    <div class="w-1/2">
                        <label for="cvv" class="block text-lg font-medium text-DarkGrey">CVV</label>
                        <input type="text" id="cvv" name="cvv" pattern="\d{3}" placeholder="123" 
                            class="w-full p-3 mt-2 border border-DarkGrey rounded-lg focus:outline-none focus:ring-2 focus:ring-DarkBlue" required maxlength="3" oninput="formatCVV(event)">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="cardholderName" class="block text-lg font-medium text-DarkGrey">Cardholder Name</label>
                    <input type="text" id="cardholderName" name="cardholderName" placeholder="John Doe"
                        class="w-full p-3 mt-2 border border-DarkGrey rounded-lg focus:outline-none focus:ring-2 focus:ring-DarkBlue" required oninput="formatCardholderName(event)">
                </div>

                <!-- Upgrade Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-DarkBlue to-DarkRed text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:scale-105 transform transition">
                    Purchase
                </button>
            </form>
        </div>
    </div>

    <script>
        // Format Card Number to #### #### #### ####
        function formatCardNumber(event) {
            let input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            if (value.length > 4) {
                value = value.substring(0, 4) + ' ' + value.substring(4); // Add space after every 4 digits
            }
            if (value.length > 9) {
                value = value.substring(0, 9) + ' ' + value.substring(9); // Add space after 8 digits
            }
            if (value.length > 14) {
                value = value.substring(0, 14) + ' ' + value.substring(14); // Add space after 12 digits
            }
            input.value = value; // Set the formatted value back to input
        }

        // Format Expiry Date to MM/YY
        function formatExpiryDate(event) {
            let input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4); // Add separator after month
            }
            input.value = value;
        }

        // Format CVV to allow exactly 3 digits
        function formatCVV(event) {
            let input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            input.value = value.substring(0, 3); // Limit to 3 digits
        }

        // Format Cardholder Name to allow only letters, spaces, and hyphens
        function formatCardholderName(event) {
            let input = event.target;
            let value = input.value.replace(/[^A-Za-z\s\-]/g, ''); // Allow letters, spaces, and hyphens
            input.value = value;
        }
    </script>
</body>
</html>