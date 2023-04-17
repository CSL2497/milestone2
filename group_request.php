<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page
    header('Location: login_form.php');
    exit;
}

// Get the user data from the session
$user = $_SESSION['user'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $preferred_size = $_POST['preferred_size'];

    // Insert the data into the database
    $conn = $db = mysqli_connect('localhost','root','','test');
    $sql = "INSERT INTO group_requests (user_id, title, description, preferred_size) VALUES ('{$user['id']}', '$title', '$description', '$preferred_size')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    // Redirect to home page
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <title>Create Group Request</title>
</head>
<body>
    <h1>Create Group Request</h1>

    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Preferred Size:</label>
        <input type="number" name="preferred_size" required>

        <button type="submit">Submit</button>
    </form>
</body>
</html>