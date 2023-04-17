<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page
    header('Location: http://localhost/demo/login_form.php');
    exit;
}

// Get the user data from the session
$user = $_SESSION['user'];

// Get the ongoing group requests from the database
$conn = $db = mysqli_connect('localhost','root','','test');
$sql = "SELECT * FROM group_requests WHERE status = 'ongoing'";
$result = mysqli_query($conn, $sql);
$group_requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);
?>

<html>
<head>
    <title>Ongoing Group Requests</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/demo/styles.css">
</head>
<body>
    <h1>Ongoing Group Requests</h1>

    <?php if (count($group_requests) > 0): ?>
        <ul>
            <?php foreach ($group_requests as $group_request): ?>
                <li>
                    <h3><?php echo $group_request['title']; ?></h3>
                    <p><?php echo $group_request['description']; ?></p>
                    <p>Preferred Size: <?php echo $group_request['preferred_size']; ?></p>
                    <form method="POST" action="view_group_request.php">
                        <input type="hidden" name="group_request_id" value="<?php echo $group_request['id']; ?>">
                        <button type="submit"><a href = "http://localhost/demo/OMG.php">View</a></button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No ongoing group requests found.</p>
    <?php endif; ?>

    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
     <p>Click <a href = "http://localhost/demo/index2.php">here</a> to list my group.</p>
     <p>Click <a href = "http://localhost/demo/index.php">here</a> to return Homepage.</p>
</body>
</html>