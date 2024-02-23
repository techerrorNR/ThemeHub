<?php
session_start(); // Start the session


if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit; 
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['insert'])) {
    $new_theme_name = $_POST['new_theme_name'];
    $theme_file = $_FILES['theme_file']['name'];
    $theme_file_tmp = $_FILES['theme_file']['tmp_name'];
    
    // Check if file is uploaded
    if(!empty($theme_file)) {
        // Specify folder to store theme files
        $upload_directory = "themes/";

       
        if(move_uploaded_file($theme_file_tmp, $upload_directory . $theme_file)) {
           
            $theme_file_path = $upload_directory . $theme_file;
            $sql = "INSERT INTO themes (theme_name, theme_file_path) VALUES ('$new_theme_name', '$theme_file_path')";
            if ($conn->query($sql) === TRUE) {
                echo "New theme inserted successfully";
            } else {
                echo "Error inserting new theme: " . $conn->error;
            }
        } else {
            echo "Error uploading theme file";
        }
    }
}


if(isset($_POST['submit'])) {
    $selected_theme = $_POST['theme'];
    
    // Update selected theme in the database
    $sql = "UPDATE settings SET selected_theme = '$selected_theme' WHERE id = 1";
    if ($conn->query($sql) === TRUE) {
        // Theme updated successfully
    } else {
        // Error updating theme
    }
}

// Fetch the currently selected theme 
$sql = "SELECT selected_theme FROM settings WHERE id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_theme = $row["selected_theme"];
} else {
    $current_theme = ""; // 
}

// Fetch all available themes 
$sql = "SELECT theme_name FROM themes";
$result = $conn->query($sql);

$themes = array(); // Array to store available themes
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $themes[] = $row["theme_name"];
    }
} else {
    echo "No themes found";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Theme Management</title>
</head>
<body>
    <h2>Select Theme</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select name="theme">
            <?php 
            foreach($themes as $theme) {
                echo "<option value='$theme'";
                if($current_theme == $theme) echo " selected";
                echo ">$theme</option>";
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Save">
    </form>
    
    <h2>Add New Theme</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <input type="text" name="new_theme_name" placeholder="Enter New Theme Name" required><br>
        <input type="file" name="theme_file" required><br>
        <input type="submit" name="insert" value="Add New Theme">
    </form>
</body>
</html>
