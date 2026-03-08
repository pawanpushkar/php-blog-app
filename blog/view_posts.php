<link rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
?>

<h2>All Posts</h2>

<a href="dashboard.php">Back to Dashboard</a>
<br><br>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['content']; ?></p>
    <small><?php echo $row['created_at']; ?></small>
    <br>
    <a href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a> |
    <a href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>
    <hr>
<?php } ?>
</div>