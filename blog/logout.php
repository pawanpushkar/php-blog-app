<link rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
</div>