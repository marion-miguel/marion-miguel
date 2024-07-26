<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "genhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID to delete
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Start a transaction
    $conn->begin_transaction();

    // Delete the record
    $sql = "DELETE FROM UserWorkLog WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Renumber IDs
        $sql = "SET @count = 0";
        if (!$conn->query($sql)) {
            $conn->rollback();
            die("Error resetting counter: " . $conn->error);
        }

        $sql = "UPDATE UserWorkLog SET id = (@count := @count + 1) ORDER BY id";
        if (!$conn->query($sql)) {
            $conn->rollback();
            die("Error renumbering IDs: " . $conn->error);
        }

        // Reset AUTO_INCREMENT
        $sql = "ALTER TABLE UserWorkLog AUTO_INCREMENT = 1";
        if (!$conn->query($sql)) {
            $conn->rollback();
            die("Error resetting AUTO_INCREMENT: " . $conn->error);
        }

        $conn->commit();
        echo "Record deleted and IDs renumbered successfully.";
    } else {
        $conn->rollback();
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID.";
}

// Close connection
$conn->close();
?>

