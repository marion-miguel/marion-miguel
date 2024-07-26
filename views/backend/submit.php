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

// Get the next ID value (assuming IDs should be sequential starting from 1)
$sql = "SELECT IFNULL(MAX(id), 0) + 1 AS next_id FROM UserWorkLog";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$next_id = $row['next_id'];

// Get POST variables and set default values if not set
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$date = isset($_POST['date']) ? $conn->real_escape_string($_POST['date']) : '';
$work_type = 'Office';
$schedule = '8 AM to 5 PM'; // Constant schedule

$time_in = isset($_POST['time_in']) ? $conn->real_escape_string(date('H:i', strtotime($_POST['time_in']))) : '';
$time_out = isset($_POST['time_out']) ? $conn->real_escape_string(date('H:i', strtotime($_POST['time_out']))) : '';
$time_pairs = isset($_POST['time_pairs']) ? $conn->real_escape_string(date('H:i', strtotime($_POST['time_pairs']))) : '';

// Calculate late
$late = isset($_POST['late']) ? $conn->real_escape_string($_POST['late']) : '00:00';

// Calculate hours worked and productive hours
$hours_worked = '00:00';
$prod_hrs = '00:00';

if ($time_in && $time_out) {
    $time_in_timestamp = strtotime($time_in);
    $time_out_timestamp = strtotime($time_out);

    // Calculate total hours worked
    $diff = $time_out_timestamp - $time_in_timestamp;
    $hours_worked = gmdate('H:i', $diff);

    // Calculate productive hours (assuming 1-hour lunch break)
    $productive_diff = $diff - 3600;
    $prod_hrs = gmdate('H:i', $productive_diff);
}

// Calculate undertime
$undertime = '00:00';
if ($time_out) {
    $timeOutTimestamp = strtotime($time_out);
    $expectedTimeOutTimestamp = strtotime('17:00');
    if ($timeOutTimestamp < $expectedTimeOutTimestamp) {
        $undertime_minutes = ($expectedTimeOutTimestamp - $timeOutTimestamp) / 60; // Convert to minutes
        $undertime_hours = floor($undertime_minutes / 60);
        $undertime_minutes = $undertime_minutes % 60;
        $undertime = sprintf('%02d:%02d', $undertime_hours, $undertime_minutes); // Convert to HH:MM format
    }
}

// Convert absent to integer (0 or 1)
$absent = $time_in ? 0 : 1;  // If time_in is set, they are not absent, otherwise they are absent

$remarks = isset($_POST['remarks']) ? $conn->real_escape_string($_POST['remarks']) : '';
$analysis = isset($_POST['analysis']) ? $conn->real_escape_string($_POST['analysis']) : '';

// Prepare SQL query
$sql = "INSERT INTO UserWorkLog (id, email, date, work_type, schedule, time_in, time_out, time_pairs, late, undertime, absent, hours_worked, prod_hrs, remarks, analysis)
VALUES ($next_id, '$email', '$date', '$work_type', '$schedule', '$time_in', '$time_out', '$time_pairs', '$late', '$undertime', '$absent', '$hours_worked', '$prod_hrs', '$remarks', '$analysis')";

// Execute query and handle result
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error creating record: " . $conn->error;
}

// Close connection
$conn->close();
?>
