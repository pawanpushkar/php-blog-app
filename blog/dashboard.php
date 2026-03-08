<link rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome <?php echo $_SESSION['user']; ?> 🎉</h2>

<a href="add_post.php">Add New Post</a><br><br>
<a href="view_posts.php">View Posts</a><br><br>
<a href="logout.php">Logout</a>
</div>