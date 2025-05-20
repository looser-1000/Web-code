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

// Get POST data
$name = $_POST['name'];
$roll = $_POST['roll'];
$s1 = $_POST['subject1'];
$s2 = $_POST['subject2'];
$s3 = $_POST['subject3'];
$s4 = $_POST['subject4'];
$s5 = $_POST['subject5'];

// Insert into DB
$sql = "INSERT INTO students (name, roll, subject1, subject2, subject3, subject4, subject5)
VALUES ('$name', '$roll', $s1, $s2, $s3, $s4, $s5)";

if ($conn->query($sql) === TRUE) {
    header("Location: result.php?roll=$roll");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
