<?php
// Database connection
$host = 'localhost';
$dbname = 'toka';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Function to fetch tables, columns, and foreign key relationships
function getDatabaseRelations($pdo, $dbname)
{
    $tables = [];
    $stmt = $pdo->query("SHOW TABLES");

    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $table = $row[0];
        $tables[$table] = ['columns' => [], 'fks' => []];

        // Get table columns
        $colQuery = $pdo->prepare("SHOW COLUMNS FROM $table");
        $colQuery->execute();
        while ($column = $colQuery->fetch(PDO::FETCH_ASSOC)) {
            $tables[$table]['columns'][] = $column;
        }

        // Get foreign key relationships
        $fkQuery = $pdo->prepare("
            SELECT 
                COLUMN_NAME, 
                REFERENCED_TABLE_NAME, 
                REFERENCED_COLUMN_NAME 
            FROM 
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE 
                TABLE_SCHEMA = :dbname 
                AND TABLE_NAME = :table 
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        $fkQuery->execute(['dbname' => $dbname, 'table' => $table]);
        while ($fk = $fkQuery->fetch(PDO::FETCH_ASSOC)) {
            $tables[$table]['fks'][] = $fk;
        }
    }

    return $tables;
}

// Helper function to safely use htmlspecialchars
function safeHtml($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Handle edit, delete, or add column requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $table = $_POST['table'] ?? null;
    $column = $_POST['column'] ?? null;

    try {
        if ($action === 'edit') {
            $newName = $_POST['newName'];
            $newType = $_POST['newType'];
            $pdo->exec("ALTER TABLE `$table` CHANGE `$column` `$newName` $newType");
            echo json_encode(['status' => 'success']);
            exit;
        } elseif ($action === 'delete') {
            $pdo->exec("ALTER TABLE `$table` DROP COLUMN `$column`");
            echo json_encode(['status' => 'success']);
            exit;
        } elseif ($action === 'add') {
            $newName = $_POST['newName'];
            $newType = $_POST['newType'];
            $pdo->exec("ALTER TABLE `$table` ADD `$newName` $newType");
            echo json_encode(['status' => 'success']);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}

// Get the relations
$relations = getDatabaseRelations($pdo, $dbname);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Relations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold text-center mb-10 text-orange-600">Database Relations for '<?php echo safeHtml($dbname); ?>'</h1>

        <?php foreach ($relations as $table => $data): ?>
            <div class="bg-orange-700 text-white font-bold text-lg py-2 px-4 mb-4 rounded">
                Table: <?php echo safeHtml($table); ?>
                <button class="bg-green-500 px-3 py-1 text-sm rounded ml-4" onclick="showAddModal('<?php echo safeHtml($table); ?>')">Add Column</button>
            </div>

            <!-- Display Table Columns -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Columns:</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead class="bg-orange-500 text-white">
                            <tr>
                                <th class="text-left py-2 px-4">Field</th>
                                <th class="text-left py-2 px-4">Type</th>
                                <th class="text-left py-2 px-4">Null</th>
                                <th class="text-left py-2 px-4">Key</th>
                                <th class="text-left py-2 px-4">Default</th>
                                <th class="text-left py-2 px-4">Extra</th>
                                <th class="text-left py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['columns'] as $column): ?>
                                <tr class="border-b">
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Field']); ?></td>
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Type']); ?></td>
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Null']); ?></td>
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Key']); ?></td>
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Default']); ?></td>
                                    <td class="py-2 px-4"><?php echo safeHtml($column['Extra']); ?></td>
                                    <td class="py-2 px-4">
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded" onclick="showEditModal('<?php echo safeHtml($table); ?>', '<?php echo safeHtml($column['Field']); ?>')">Edit</button>
                                        <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="deleteColumn('<?php echo safeHtml($table); ?>', '<?php echo safeHtml($column['Field']); ?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modals -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-2xl font-bold mb-4">Edit Column</h2>
            <form id="editColumnForm">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="table" id="editTable">
                <input type="hidden" name="column" id="editColumn">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold">New Field Name</label>
                    <input type="text" name="newName" id="newName" class="w-full border border-2 border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold">New Field Type</label>
                    <input type="text" name="newType" id="newType" class="w-full border border-2 border-gray-300 rounded">
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Changes</button>
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function showEditModal(table, column) {
            document.getElementById('editTable').value = table;
            document.getElementById('editColumn').value = column;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        async function deleteColumn(table, column) {
            const response = await fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=delete&table=${table}&column=${column}`
            });
            const result = await response.json();
            if (result.status === 'success') {
                location.reload();
            } else {
                alert('Error: ' + result.message);
            }
        }
    </script>
</body>

</html>
