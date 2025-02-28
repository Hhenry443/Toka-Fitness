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

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./partials/head.php"; ?>
    <style>
        .star {
            cursor: pointer;
            color: #ccc;
        }
        .star.selected {
            color: #FFD700;
        }
    </style>
</head>
<body class="bg-OffWhite w-screen">
    <?php include "./partials/navbar.php"; ?>
    <?php include "./partials/errorBox.php"; ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8" aria-labelledby="informationHeader">
        <div class="flex items-center justify-center w-3/4 mx-auto">
            <hr class="flex-grow border-t border-DarkGrey border-2">
            <span class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold" id="informationHeader">
                Create a Custom Plan
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2">
        </div>

        <form id="workoutForm" class="w-full border border-DarkBlue max-w-lg bg-white p-6 rounded-lg mt-8 shadow-md" role="form" aria-labelledby="workoutFormTitle">
            <h2 id="workoutFormTitle" class="sr-only">Custom Workout Plan Form</h2>

            <div class="mb-4">
                <label class="block text-lg font-medium text-gray-700 mb-4" for="difficulty">Rate Feature Importance</label>

                <!-- Difficulty Rating -->
                <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
                <div id="difficultyStars" class="flex mb-2" role="radiogroup" aria-labelledby="difficulty" aria-describedby="difficultyDescription">
                    <span class="star selected" data-value="1" role="radio" aria-checked="true" aria-label="1 star">&#9733;</span>
                    <span class="star" data-value="2" role="radio" aria-checked="false" aria-label="2 stars">&#9733;</span>
                    <span class="star" data-value="3" role="radio" aria-checked="false" aria-label="3 stars">&#9733;</span>
                    <span class="star" data-value="4" role="radio" aria-checked="false" aria-label="4 stars">&#9733;</span>
                    <span class="star" data-value="5" role="radio" aria-checked="false" aria-label="5 stars">&#9733;</span>
                </div>
                <input type="hidden" id="difficulty" name="difficulty" value="1" aria-hidden="true">

                <!-- Duration Rating -->
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                <div id="durationStars" class="flex mb-2" role="radiogroup" aria-labelledby="duration" aria-describedby="durationDescription">
                    <span class="star selected" data-value="1" role="radio" aria-checked="true" aria-label="1 star">&#9733;</span>
                    <span class="star" data-value="2" role="radio" aria-checked="false" aria-label="2 stars">&#9733;</span>
                    <span class="star" data-value="3" role="radio" aria-checked="false" aria-label="3 stars">&#9733;</span>
                    <span class="star" data-value="4" role="radio" aria-checked="false" aria-label="4 stars">&#9733;</span>
                    <span class="star" data-value="5" role="radio" aria-checked="false" aria-label="5 stars">&#9733;</span>
                </div>
                <input type="hidden" id="duration" name="duration" value="1" aria-hidden="true">

                <!-- Number of Exercises -->
                <label for="exercises" class="block text-sm font-medium text-gray-700">Number of Exercises</label>
                <div id="exercisesStars" class="flex mb-2" role="radiogroup" aria-labelledby="exercises" aria-describedby="exercisesDescription">
                    <span class="star selected" data-value="1" role="radio" aria-checked="true" aria-label="1 star">&#9733;</span>
                    <span class="star" data-value="2" role="radio" aria-checked="false" aria-label="2 stars">&#9733;</span>
                    <span class="star" data-value="3" role="radio" aria-checked="false" aria-label="3 stars">&#9733;</span>
                    <span class="star" data-value="4" role="radio" aria-checked="false" aria-label="4 stars">&#9733;</span>
                    <span class="star" data-value="5" role="radio" aria-checked="false" aria-label="5 stars">&#9733;</span>
                </div>
                <input type="hidden" id="exercises" name="exercises" value="1" aria-hidden="true">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Add Extras (Optional)</label>
                <label class="block" for="warmup">
                    <input type="checkbox" name="warmup" id="warmup" class="mr-2" aria-label="Warm-up"> Warm-up
                </label>
                <label class="block" for="cooldown">
                    <input type="checkbox" name="cooldown" id="cooldown" class="mr-2" aria-label="Cool-down"> Cool-down
                </label>
                <label class="block" for="stretching">
                    <input type="checkbox" name="stretching" id="stretching" class="mr-2" aria-label="Stretching"> Stretching
                </label>
            </div>

            <div class="w-full flex justify-center">
                <button type="button" id="generateButton" class="bg-LightRed hover:bg-DarkRed text-white font-bold py-2 px-4 rounded-xl" aria-label="Generate Workout Plan">Generate Workout Plan</button>
            </div>
        </form>

        <!-- Display the generated plan -->
        <div id="generatedPlan" class="hidden w-96 mt-8 p-6 bg-gray-100 border border-gray-300 rounded-lg shadow-lg" aria-live="polite">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🏋️ Your Workout Plan</h2>
            <ul class="space-y-2 text-gray-700">
                <li>
                    <span class="font-semibold">Difficulty:</span>
                    <span id="planDifficulty" class="text-gray-600"></span>
                </li>
                <li>
                    <span class="font-semibold">Duration:</span>
                    <span id="planDuration" class="text-gray-600"></span>
                </li>
                <li>
                    <span class="font-semibold">Number of Exercises:</span>
                    <span id="exerciseCount" class="text-gray-600"></span>
                </li>
                <li>
                    <span class="font-semibold">Exercises:</span>
                    <ul id="exerciseList" class="list-disc ml-5 mt-2 text-gray-600"></ul>
                </li>
                <li id="extrasSection" class="pt-4">
                    <h3 class="text-lg font-semibold text-gray-800">Extras:</h3>
                    <ul id="extraList" class="list-disc ml-5 text-gray-600"></ul>
                </li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        // Define detailed workout plans based on input
        const workoutPlans = {
            easy: {
                short: [
                    'Light stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Jogging for 10 min'
                ],
                moderate: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Planks'
                ],
                long: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Planks',
                    'Burpees'
                ]
            },
            medium: { 
                short: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees'
                ],
                moderate: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees',
                    'Mountain climbers'
                ],
                long: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees',
                    'Mountain climbers',
                    'Jump squats'
                ]
            },
            hard: {
                short: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees',
                    'Mountain climbers',
                    'Jump squats',
                    'Kettlebell swings'
                ],
                moderate: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees',
                    'Mountain climbers',
                    'Jump squats',
                    'Kettlebell swings',
                    'Deadlifts'
                ],
                long: [
                    'Dynamic stretching',
                    'Bodyweight squats',
                    'Push-ups',
                    'Walking lunges',
                    'Burpees',
                    'Mountain climbers',
                    'Jump squats',
                    'Kettlebell swings',
                    'Deadlifts',
                    'Box jumps'
                ]
            }
        };

        /**
         * Function to handle star click and update the corresponding hidden input.
         * 
         * @param {string} starContainerId - The ID of the container holding the star elements.
         * @param {string} inputId - The ID of the hidden input element to update with the selected rating.
         */
        function handleStarClick(starContainerId, inputId) {
            document.querySelectorAll(`#${starContainerId} .star`).forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-value');  // Get the rating value
                    this.parentNode.querySelectorAll('.star').forEach(star => {
                        star.classList.remove('selected');  // Remove 'selected' from all stars
                    });
                    for (let i = 0; i < rating; i++) {
                        this.parentNode.children[i].classList.add('selected');  // Add 'selected' to the clicked and previous stars
                    }
                    document.getElementById(inputId).value = rating;  // Set the hidden input value to the clicked rating
                });
            });
        }

        // Handle the star clicks for difficulty, duration, and number of exercises
        handleStarClick('difficultyStars', 'difficulty');
        handleStarClick('durationStars', 'duration');
        handleStarClick('exercisesStars', 'exercises');

        // Generate the workout plan based on the ratings
        document.getElementById('generateButton').addEventListener('click', function() {
            const extras = [];
            const difficulty = document.getElementById('difficulty').value;
            const duration = document.getElementById('duration').value;
            const durationKey = duration == 1 ? 'short' : (duration == 2 ? 'moderate' : 'long');
            const exercises = document.getElementById('exercises').value;
            const difficultyMap = { 1: 'easy', 2: 'medium', 3: 'hard' };
            plan = workoutPlans[difficultyMap[difficulty]][duration == 1 ? 'short' : (duration == 2 ? 'moderate' : 'long')];
            if (document.getElementById('warmup').checked) extras.push('Warm-up');
            if (document.getElementById('cooldown').checked) extras.push('Cool-down');
            if (document.getElementById('stretching').checked) extras.push('Stretching');
            plan = workoutPlans[difficultyMap[difficulty]][duration == 1 ? 'short' : (duration == 2 ? 'moderate' : 'long')];
            exerciseCount = exercises;
            exerciseCount = parseInt(exercises, 10);
            // Display the generated plan
            document.getElementById('generatedPlan').classList.remove('hidden');
            document.getElementById('planDifficulty').textContent = difficultyMap[difficulty].charAt(0).toUpperCase() + difficultyMap[difficulty].slice(1);
            document.getElementById('planDifficulty').textContent = difficulty.charAt(0).toUpperCase() + difficulty.slice(1);
            document.getElementById('planDuration').textContent = `${duration * 10} minutes`;
            document.getElementById('exerciseCount').textContent = exerciseCount;
            document.getElementById('exerciseList').innerHTML = plan.slice(0, exerciseCount).map(ex => `<li>${ex}</li>`).join('');

            const extraList = extras.map(extra => `<li>${extra}</li>`).join('');
            document.getElementById('extraList').innerHTML = extraList || '<li>No extras selected</li>';
        });
    });
    </script>
</body>
</html>
