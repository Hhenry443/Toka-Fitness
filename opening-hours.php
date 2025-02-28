<?php 

include "./helpers.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to the login page if the user is not logged in
if(!isset($_SESSION['userID'])){
    redirect('login.php');
}

// Redirect the user if they are logged into a free account 
if($_SESSION['user_tier'] != 'premium'){
    redirect('errorPage.php');
}
?>

<?php include "./partials/head.php"; ?>

<body class="bg-OffWhite w-screen">
    <?php include "./partials/navbar.php"; ?>
    <?php include "./partials/errorBox.php"; ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8">
        <div class="bg-white shadow-lg rounded-lg p-6 w-11/12 sm:w-8/12 md:w-6/12 lg:w-5/12">
            <h1 class="text-2xl font-bold text-center text-DarkBlue mb-6" role="heading" aria-level="1">Opening Hours</h1>
            <table class="w-full text-left text-lg text-DarkBlue" role="table" aria-labelledby="openingHoursTable">
                <caption id="openingHoursTable" class="sr-only">A table displaying the opening and closing hours for each day of the week</caption>
                <thead class="border-b-2 border-gray-300" role="rowgroup">
                    <tr role="row">
                        <th class="py-2" role="columnheader">Day</th>
                        <th class="py-2" role="columnheader">Opening Time</th>
                        <th class="py-2" role="columnheader">Closing Time</th>
                    </tr>
                </thead>
                <tbody role="rowgroup">
                    <?php
                    $openingHours = [
                        "Monday"    => ["08:00 AM", "09:00 PM"],
                        "Tuesday"   => ["08:00 AM", "09:00 PM"],
                        "Wednesday" => ["08:00 AM", "09:00 PM"],
                        "Thursday"  => ["08:00 AM", "09:00 PM"],
                        "Friday"    => ["08:00 AM", "10:00 PM"],
                        "Saturday"  => ["09:00 AM", "10:00 PM"],
                        "Sunday"    => ["10:00 AM", "06:00 PM"],
                    ];

                    foreach ($openingHours as $day => $hours) {
                        echo "<tr class='border-b' role='row'>
                                <td class='py-3' role='cell'>$day</td>
                                <td class='py-3' role='cell'>{$hours[0]}</td>
                                <td class='py-3' role='cell'>{$hours[1]}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
