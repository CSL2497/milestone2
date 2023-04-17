
<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) && isset($_COOKIE['login'])) {
    // Get the user data from the database
    $conn = $db = mysqli_connect('localhost','root','','test');
    $sql = "SELECT * FROM users WHERE id = '{$_COOKIE['login']}'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Set the user session
        $_SESSION['user'] = $user;
    } else {
        // Delete the login cookie
        setcookie('login', '', time() - 3600, '/');
    }

    mysqli_close($conn);
}

// Get the user data from the session
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page
    header('Location: http://localhost/demo/login_form.php');
    exit;
}

// Get the user data from the session
$user = $_SESSION['user'];
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Start the session
    session_start();

    // Destroy the session
    session_destroy();

    // Delete the login cookie
    setcookie('login', '', time() - 3600, '/');

    // Redirect to login page
    header('Location: http://localhost/demo/login_form.php');
    exit;
}
?>

<html>
<head>
    <title>Online Grouping System</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/demo/styles.css">
</head>
<body>
    <h1>Welcome, <?php echo $user['nickname']; ?>!</h1>

    <p>Click <a href = "http://localhost/demo/view_group_request.php">here</a> to view ongoing Group Request.</p>
    <p>Click <a href = "http://localhost/demo/create_group.php">here</a> to create Group Request.</p>
    <p>Click <a href = "http://localhost/demo/index2.php">here</a> to list my group.</p>

    <form method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>