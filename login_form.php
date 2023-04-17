
<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $login_id = $_POST['login_id'];
    $password = $_POST['password'];

    // Check if the credentials are correct
    $conn = $db = mysqli_connect('localhost','root','','test');
    $sql = "SELECT * FROM users WHERE login_id = '$login_id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    echo "Invalid username or password.";
    if ($user && password_verify($password, $user['password'])) {
        // Set the login cookie
        setcookie('login', $user['id'], time() + 3600, '/');

        // Redirect to home page
        header('Location: http://localhost/demo/index.php');
        exit;
    } else {
        // Display an error message
        $error = 'Invalid login credentials';
    }

//    mysqli_close($conn);
}
?>
<html>
<head>
    <title>login_form</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/demo/styles.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<form method="POST">
    <label>Login ID:</label>
    <input type="text" name="login_id" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
</body>
</html>