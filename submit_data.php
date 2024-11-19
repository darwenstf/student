<?php
// Database connection details
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "student";  

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $section = $_POST['section'];

    // Additional logic (e.g., inserting data into a database)
} else {
    echo "Form not submitted properly.";
    exit;
}

// Prepare and execute an SQL statement to insert the data
$stmt = $conn->prepare("INSERT INTO student (firstname, middlename, lastname, age, address, course, section) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisss", $firstname, $middlename, $lastname, $age, $address, $course, $section);

if ($stmt->execute()) {
    echo "<h2>Data successfully submitted!</h2>";
    echo "<p>Here are the details you submitted:</p>";
    echo "<ul>";
    echo "<li><strong>First Name:</strong> $firstname</li>";
    echo "<li><strong>Middle Name:</strong> $middlename</li>";
    echo "<li><strong>Last Name:</strong> $lastname</li>";
    echo "<li><strong>Age:</strong> $age</li>";
    echo "<li><strong>Address:</strong> $address</li>";
    echo "<li><strong>Course:</strong> $course</li>";
    echo "<li><strong>Section:</strong> $section</li>";
    echo "</ul>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>