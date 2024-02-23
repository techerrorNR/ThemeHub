<?php
// Include/configure your database connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the currently selected theme from the database
$sql = "SELECT selected_theme FROM settings WHERE id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_theme = $row["selected_theme"];
} else {
    $current_theme = "default"; // Default theme if no theme is selected
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Interface</title>
    <!-- Include or link the appropriate CSS file based on the selected theme -->
    <link rel="stylesheet" type="text/css" href="themes/<?php echo $current_theme; ?>.css">
</head>
<body>
    <h2>User Interface</h2>
    <!-- Content of the user interface goes here -->
</body>
</html>
