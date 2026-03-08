<?php
session_start();

$conn = mysqli_connect("localhost","root","","blog");

if(!$conn){
    die("Database connection failed");
}

/* CSRF TOKEN */
if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* Pagination */
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

/* Search */
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

if($search != ""){

    $searchTerm = "%".$search."%";

    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? LIMIT ?,?");
    $stmt->bind_param("ssii",$searchTerm,$searchTerm,$start,$limit);
    $stmt->execute();

    $result = $stmt->get_result();

}else{

    $stmt = $conn->prepare("SELECT * FROM posts LIMIT ?,?");
    $stmt->bind_param("ii",$start,$limit);
    $stmt->execute();

    $result = $stmt->get_result();

}
?>

<!DOCTYPE html>
<html>
<head>

<title>My Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">My Blog Posts</h2>

<!-- SEARCH FORM -->

<form method="GET" class="mb-4">

<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

<input 
type="text"
name="search"
class="form-control"
placeholder="Search post..."
value="<?php echo htmlspecialchars($search); ?>"
>

<br>

<button class="btn btn-primary">Search</button>

</form>

<!-- POSTS -->

<?php while($row = $result->fetch_assoc()){ ?>

<div class="card mb-3">

<div class="card-body">

<h4>
<?php echo htmlspecialchars($row['title']); ?>
</h4>

<p>
<?php echo htmlspecialchars($row['content']); ?>
</p>

</div>

</div>

<?php } ?>

<!-- PAGINATION -->

<?php

$totalQuery = "SELECT COUNT(id) AS total FROM posts";
$totalResult = mysqli_query($conn,$totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);

$total_pages = ceil($totalRow['total'] / $limit);

?>

<div class="mt-4">

<?php for($i=1;$i<=$total_pages;$i++){ ?>

<a class="btn btn-secondary m-1" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
<?php echo $i; ?>
</a>

<?php } ?>

</div>

</div>

</body>
</html>