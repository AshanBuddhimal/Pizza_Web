<?php
// Database connection
include("conn.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];

    // Insert data into database
    $sql = "INSERT INTO customers (username, password, email, tel, address, birthday)
            VALUES ('$username', '$password', '$email', '$tel', '$address', '$birthday')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch data from the database
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Display data in a table
    echo "<h2>Customer Data:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Email</th><th>Tel</th><th>Address</th><th>Birthday</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["tel"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["birthday"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h2>No records found</h2>";
}
