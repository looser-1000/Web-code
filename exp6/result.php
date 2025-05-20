<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "studentdb";

// Connect
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roll = $_GET['roll'];

$sql = "SELECT * FROM students WHERE roll='$roll'";
$result = $conn->query($sql);

function getGradePoint($marks) {
    if ($marks >= 80) return 4.0;
    elseif ($marks >= 70) return 3.5;
    elseif ($marks >= 60) return 3.0;
    elseif ($marks >= 50) return 2.5;
    elseif ($marks >= 40) return 2.0;
    else return 0.0;
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gpa = (
        getGradePoint($row['subject1']) +
        getGradePoint($row['subject2']) +
        getGradePoint($row['subject3']) +
        getGradePoint($row['subject4']) +
        getGradePoint($row['subject5'])
    ) / 5;

    echo "<h2>Result for " . $row['name'] . " (Roll: " . $row['roll'] . ")</h2>";
    echo "Subject Marks: " . $row['subject1'] . ", " . $row['subject2'] . ", " . $row['subject3'] . ", " . $row['subject4'] . ", " . $row['subject5'] . "<br><br>";
    echo "<strong>GPA: " . number_format($gpa, 2) . "</strong>";
} else {
    echo "No record found.";
}

$conn->close();
?>
