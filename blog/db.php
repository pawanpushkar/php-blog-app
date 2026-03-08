<link rel="stylesheet" href="style.css">
<div class="container">
<?php
$conn = mysqli_connect("localhost", "root", "", "blog");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
</div>