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

// Get the ID from the query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT * FROM UserWorkLog WHERE id = $id";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
} else {
    die("Invalid ID.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Work Log</title>
    <style>
        /* Basic CSS for form styling */
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        td, th, input, textarea, select {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        label {
            display: block;
        }
        input, textarea, select {
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            margin: 10px 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Edit Work Log</h2>
    <form id="editForm" action="application\views\backend\update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">

        <table>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><label for="date">Date:</label></td>
                <td><label for="work_type">Work Type:</label></td>
                <td><label for="schedule">Schedule:</label></td>
                <td><label for="time_in">Time In:</label></td>
                <td><label for="time_out">Time Out:</label></td>
            </tr>
            <tr>
                <td><input type="email" id="email" name="email" value="<?php echo $record['email']; ?>" required></td>
                <td><input type="date" id="date" name="date" value="<?php echo $record['date']; ?>" required></td>
                <td><input type="text" id="work_type" name="work_type" value="<?php echo $record['work_type']; ?>" readonly></td>
                <td><input type="text" id="schedule" name="schedule" value="<?php echo $record['schedule']; ?>" readonly></td>
                <td><input type="time" id="time_in" name="time_in" value="<?php echo $record['time_in']; ?>"></td>
                <td><input type="time" id="time_out" name="time_out" value="<?php echo $record['time_out']; ?>"></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label for="remarks">Remarks:</label></td>
                <td><label for="analysis">Analysis:</label></td>
            </tr>
            <tr>
                <td><textarea id="remarks" name="remarks"><?php echo $record['remarks']; ?></textarea></td>
                <td><textarea id="analysis" name="analysis"><?php echo $record['analysis']; ?></textarea></td>
            </tr>
        </table>
        <br>
        <button type="submit">Update</button>
        <button type="button" onclick="window.history.back();">Back</button>
    </form>
</body>
</html>

