<?php
// Establish a database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = $db = mysqli_connect('localhost','root','','test');

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve ongoing group requests from the database
$sql = "SELECT * FROM group_requests WHERE status = 'ongoing'";
$result = $conn->query($sql);

// Display the list of ongoing group requests
echo "<h2>Ongoing Group Requests</h2>";
echo "<ul>";
while($row = $result->fetch_assoc()) {
    echo "<li>" . $row["group_name"] . " - " . $row["description"] . " <a href='http://localhost/demo/view_group_request.php?id=" . $row["id"] . "'>View</a></li>";
}
echo "</ul>";

// Close the database connection
$conn->close();
?>
