<?php
// Connect to the database
include("conn.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$inputUsername = $_POST['username'];
$inputPassword = $_POST['password'];

// SQL injection prevention
$username = mysqli_real_escape_string($conn, $inputUsername);

// Query to check user credentials
$sql = "SELECT * FROM customers WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    // Verify the password
    if (password_verify($inputPassword, $row['password'])) {
        // Password is correct
        session_start();
        $_SESSION['username'] = $inputUsername;
        header("Location: customize.html"); // Redirect to welcome page
        exit(); // Terminate script after redirection
    } else {
        // Invalid password
        echo "Invalid username or password";
    }
} else {
    // Invalid username
    echo "Invalid username or password";
}

// $row = mysqli_fetch_assoc($result);

// if ($row) {
//     // Successful login
//     session_start();
//     $_SESSION['username'] = $username;
//     $_SESSION['password'] = $password;
//     header("Location: customize.html"); // Redirect to welcome page
// } else {
//     // Invalid login
//     echo "Invalid username or password";
// }

//Check if query returned any rows
// if (mysqli_num_rows($result) == 0) {
//     // Successful login
//     session_start();
//     $_SESSION['username'] = $username;
//     header("Location: customize.html"); // Redirect to welcome page
// } else {
//     // Invalid login
//     echo "Invalid username or password";
// }

// $result = mysqli_query($con,$sql);
// $check = mysqli_fetch_array($result);
// if(isset($check)){
// echo 'success';
// }else{
// echo 'failure';
// }
// Close connection
mysqli_close($conn);
?>