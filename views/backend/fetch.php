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

// Function to convert time to 12-hour format
function convertTo12Hour($time) {
    return $time ? date("h:i A", strtotime($time)) : '';  // Convert time or return empty string if not set
}

// Function to calculate late minutes
function calculateLateMinutes($time_in) {
    if (!$time_in) return 0;

    $morning_scheduled_time = "08:00";  // Morning scheduled start time
    $afternoon_scheduled_time = "13:00";  // Afternoon scheduled start time

    $time_in_parts = explode(':', date("H:i", strtotime($time_in)));  // Extract hours and minutes in 24-hour format
    $time_in_hours = (int)$time_in_parts[0];
    $time_in_minutes = (int)$time_in_parts[1];

    $morning_scheduled_parts = explode(':', $morning_scheduled_time);
    $morning_scheduled_hours = (int)$morning_scheduled_parts[0];
    $morning_scheduled_minutes = (int)$morning_scheduled_parts[1];

    $afternoon_scheduled_parts = explode(':', $afternoon_scheduled_time);
    $afternoon_scheduled_hours = (int)$afternoon_scheduled_parts[0];
    $afternoon_scheduled_minutes = (int)$afternoon_scheduled_parts[1];

    $late_minutes = 0;

    // Check if time_in is after the morning scheduled start time
    if ($time_in_hours < 12 && ($time_in_hours > $morning_scheduled_hours || ($time_in_hours == $morning_scheduled_hours && $time_in_minutes > $morning_scheduled_minutes))) {
        $late_minutes = (($time_in_hours - $morning_scheduled_hours) * 60) + ($time_in_minutes - $morning_scheduled_minutes);
    }
    // Check if time_in is after the afternoon scheduled start time
    if ($time_in_hours >= 12 && ($time_in_hours > $afternoon_scheduled_hours || ($time_in_hours == $afternoon_scheduled_hours && $time_in_minutes > $afternoon_scheduled_minutes))) {
        $late_minutes = (($time_in_hours - $afternoon_scheduled_hours) * 60) + ($time_in_minutes - $afternoon_scheduled_minutes);
    }

    return $late_minutes;
}

// Function to calculate hours worked
function calculateHoursWorked($time_in, $time_out) {
    if (!$time_in || !$time_out) return '00:00';

    $start = new DateTime($time_in);
    $end = new DateTime($time_out);
    $interval = $start->diff($end);

    $hours = $interval->h;
    $minutes = $interval->i;

    return sprintf('%02d:%02d', $hours, $minutes);
}

// Fetch records
$sql = "SELECT *, IFNULL(last_update, 'No Update') as last_update FROM UserWorkLog ORDER BY id";
$result = $conn->query($sql);

$records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert times to 12-hour format or set as empty
        $row['time_in'] = convertTo12Hour($row['time_in']);
        $row['time_out'] = convertTo12Hour($row['time_out']);

        // Calculate late minutes
        $late_minutes = calculateLateMinutes($row['time_in']);

        // Convert late minutes to HH:MM format
        $late_hours = floor($late_minutes / 60);
        $late_remaining_minutes = $late_minutes % 60;
        $row['late'] = sprintf('%02d:%02d', $late_hours, $late_remaining_minutes);

        // Calculate hours worked
        $row['hours_worked'] = calculateHoursWorked($row['time_in'], $row['time_out']);
        $row['prod_hrs'] = $row['hours_worked'];  // ProdHrs is the same as Hours Worked

        // Calculate undertime
        $undertime = '00:00';
        if ($row['time_out']) {
            $timeOutTimestamp = strtotime($row['time_out']);
            $expectedTimeOutTimestamp = strtotime('17:00');
            if ($timeOutTimestamp < $expectedTimeOutTimestamp) {
                $undertime_minutes = ($expectedTimeOutTimestamp - $timeOutTimestamp) / 60; // Convert to minutes
                $undertime_hours = floor($undertime_minutes / 60);
                $undertime_minutes = $undertime_minutes % 60;
                $undertime = sprintf('%02d:%02d', $undertime_hours, $undertime_minutes); // Convert to HH:MM format
            }
        }
        $row['undertime'] = $undertime;

        // Set 'Absent' to 1 if no time_in recorded, else 0
        $row['absent'] = $row['time_in'] ? 0 : 1;

        $records[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

echo json_encode($records);
?>
