<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to display session data with edit capability
function displaySessionData($sessionData)
{
    echo "<form method='POST' class='overflow-x-auto'>";
    echo "<table class='min-w-full table-auto border-collapse bg-white shadow-md rounded-lg'>";
    echo "<thead class='bg-[#67360A] text-white'>";
    echo "<tr><th class='px-4 py-2 text-left'>Key</th><th class='px-4 py-2 text-left'>Value</th><th class='px-4 py-2'>Actions</th></tr></thead>";
    echo "<tbody class='text-gray-700'>";

    foreach ($sessionData as $key => $value) {
        echo "<tr class='border-t'>";
        echo "<td class='px-4 py-2 font-semibold'>" . htmlspecialchars($key) . "</td>";
        echo "<td class='px-4 py-2'>";
        if (is_array($value)) {
            echo "<pre class='bg-gray-100 p-2 rounded'>" . print_r($value, true) . "</pre>";
        } else {
            echo "<input type='text' name='session_data[$key]' value='" . htmlspecialchars($value) . "' class='border border-gray-300 p-2 rounded w-full'>";
        }
        echo "</td>";
        echo "<td class='px-4 py-2'>";
        echo "<button type='submit' name='delete_key' value='" . htmlspecialchars($key) . "' class='bg-red-500 text-white px-4 py-1 rounded'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    echo "<button type='submit' class='mt-4 bg-green-500 text-white px-4 py-2 rounded'>Update Session</button>";
    echo "</form>";
}

// Handle form submissions to update or delete session data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update session data
    if (!empty($_POST['session_data'])) {
        foreach ($_POST['session_data'] as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    // Delete a specific session key
    if (!empty($_POST['delete_key'])) {
        $keyToDelete = $_POST['delete_key'];
        unset($_SESSION[$keyToDelete]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Session Data</h1>

        <?php
        if (!empty($_SESSION)) {
            displaySessionData($_SESSION);
        } else {
            echo "<p class='text-lg text-gray-600'>No session data available.</p>";
        }
        ?>
    </div>
</body>

</html>
