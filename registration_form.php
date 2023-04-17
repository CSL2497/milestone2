<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $login_id = $_POST['login_id'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert the data into the database
    $conn = $db = mysqli_connect('localhost','root','','test');
    $sql = "INSERT INTO users (login_id, nickname, email, password) VALUES ('$login_id', '$nickname', '$email', '$password')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // Redirect to login page
    header('Location: http://localhost/demo/captcha.html');
    exit;
}
?>

<html>
<head>
    <title>registration_form</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/demo/styles.css">
</head>
<body>
<form method="POST">
    <label>Login ID:</label>
    <input type="text" name="login_id" required>

    <label>Nickname:</label>
    <input type="text" name="nickname" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <!DOCTYPE html>




    <button type="submit">Register</button>
</form>
</body>
</html>
