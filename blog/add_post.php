<link rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "INSERT INTO posts (title, content) VALUES ('$title', '$content')");
    echo "Post Added Successfully!";
}
?>

<h2>Add New Post</h2>

<form method="POST">
    <input type="text" name="title" placeholder="Enter Title" required><br><br>
    <textarea name="content" placeholder="Enter Content" required></textarea><br><br>
    <button type="submit" name="submit">Add Post</button>
</form>

<br>
<a href="dashboard.php">Back to Dashboard</a>
</div>