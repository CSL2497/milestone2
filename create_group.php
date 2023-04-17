    
<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page
    header('Location: login_from.php');
    exit;
}

// Get the user data from the session
$user = $_SESSION['user'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $preferred_size = $_POST['preferred_size'];
    
    // Validate form data
    $errors = array();
    if (empty($title)) {
        $errors[] = 'Title is required';
    }
    if (empty($description)) {
        $errors[] = 'Description is required';
    }
    if (!is_numeric($preferred_size)) {
        $errors[] = 'Preferred size must be a number';
    }

    
    // If there are no errors, insert the new group request into the database
    if (count($errors) === 0) {
        $conn = $db = mysqli_connect('localhost','root','','test');
        $sql = "INSERT INTO group_requests (title, description, preferred_size, user_id) VALUES ('$title', '$description', $preferred_size, $user[id])";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        
        // Redirect to the list of ongoing group requests
        header('Location: view_group_request.php');
        exit;
    }
}
?>

<html>
<head>
    <title>Create Group Request</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Create Group Request</h1>

    <?php if (isset($errors) && count($errors) > 0): ?>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="preferred_size">Preferred Size:</label>
        <input type="number" id="preferred_size" name="preferred_size" required>
        <br>
        <button type="submit">Create Group Request</button>
    </form>

    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
