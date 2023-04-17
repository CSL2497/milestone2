<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page
    header('Location: login.php');
    exit;
}

// Get the user data from the session
$user = $_SESSION['user'];

// Get the group requests from the database
$conn = $db = mysqli_connect('localhost','root','','test');
//$sql = "SELECT * FROM group_requests";
$sql = "SELECT * FROM group_requests where id = 3";
$result = mysqli_query($conn, $sql);
$group_requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($conn);
?>

<html>
<head>
    <title>Group Requests</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>My Group Requests</h1>

    <?php if (count($group_requests) > 0): ?>
        <ul>
            <?php foreach ($group_requests as $group_request): ?>
                <li>
                    <h3><?php echo $group_request['title']; ?></h3>
                    <p><?php echo $group_request['description']; ?></p>
                    <p>Preferred Size: <?php echo $group_request['preferred_size']; ?></p>
                    <p>Total Member: 1 </p>
                    <p>Chan C Long</p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You did not join any group.</p>
    <?php endif; ?>

        <!-- <p>HERE a <a href = "view_group_request.php">link</a> you can see the on-going group</p> -->
        <p>Click <a href = "http://localhost/demo/index.php">here</a> to return Homepage.</p>

    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>