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

mysqli_query($conn, "DELETE FROM posts WHERE id=$id");

header("Location: view_posts.php");
exit();
</div>