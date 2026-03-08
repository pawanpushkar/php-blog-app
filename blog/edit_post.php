<link rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id=$id");
    header("Location: view_posts.php");
}

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<h2>Edit Post</h2>

<form method="POST">
    <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br><br>
    <textarea name="content" required><?php echo $row['content']; ?></textarea><br><br>
    <button type="submit" name="update">Update Post</button>
</form>

<br>
<a href="view_posts.php">Back</a>
</div>