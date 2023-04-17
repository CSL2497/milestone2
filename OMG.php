
<?php
// Establish a database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
$nickname = "Chan C Long";

$conn = $db = mysqli_connect('localhost','root','','test');

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user wants to join or leave a group
if (isset($_POST["join_group"])) {
    $user_id = $_POST["user_id"];
    $group_id = $_POST["group_id"];
    //echo $user_id;
    //echo $group_id;
    echo "You have successfully join this group"; 

    // Check if the group has reached its preferred size
    $sql = "SELECT COUNT(*) AS total FROM group_requests WHERE id = '$group_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $preferred_size = 5; // Replace with the preferred group size
    /*if ($row["total"] >= $preferred_size) {
        echo "Sorry, this group has already reached its preferred size.";
    } else {
        // Insert a new group membership for the user
        $sql = "INSERT INTO group_requests (id, user_id) VALUES ('$group_id', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            echo "You have successfully joined the group!";
            
            // Check if the group has now reached its preferred size
            $sql = "SELECT COUNT(*) AS total FROM group_requests WHERE id = '$group_id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            if ($row["total"] >= $preferred_size) {
                // Mark the group request as complete
                $sql = "UPDATE group_requests SET status = 'complete' WHERE id = '$group_id' AND status = 'ongoing'";
                $conn->query($sql);
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }*/
} else if (isset($_POST["leave_group"])) {
    $user_id = $_POST["user_id"];
    $group_id = $_POST["group_id"];
    
    // Delete the group membership for the user
    //$sql = "DELETE FROM  group_requests WHERE id = '$group_id' AND user_id = '$user_id'";
    $sql = "DELETE FROM  group_requests WHERE id = 3";
    if ($conn->query($sql) === TRUE) {
        echo "You have successfully left the group!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>




<html>
<head>
    <title>Group Joining</title>

     <p>Click <a href = "http://localhost/demo/index2.php">here</a> to list my group.</p>
    <link rel="stylesheet" type="text/css" href="http://localhost/demo/styles.css">
</head>
<body>
<!-- Join a group form -->
    <form method="post">
        <input type="hidden" name="user_id" value="A"> <!-- Replace with the ID of the logged-in user -->
        <input type="hidden" name="group_id" value="B"> <!-- Replace with the ID of the group -->
        <button type="submit" name="join_group">Join Group</button>
    </form>

    <!-- Leave a group form -->
    <form method="post">
        <input type="hidden" name="user_id" value="C"> <!-- Replace with the ID of the logged-in user -->
        <input type="hidden" name="group_id" value="D"> <!-- Replace with the ID of the group -->
        <button type="submit" name="leave_group">Leave Group</button>
    </form>
    </body>
</html>