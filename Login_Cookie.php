<?php
// Check if the login cookie is present
if (isset($_COOKIE['login'])) {
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
?>