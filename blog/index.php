<?php
$conn = mysqli_connect("localhost","root","","blog");

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search
$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%' LIMIT $start,$limit";
}else{
    $sql = "SELECT * FROM posts LIMIT $start,$limit";
}

$result = mysqli_query($conn,$sql);
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

<!-- Search Form -->

<form method="GET" class="mb-4">

<input type="text" name="search" class="form-control" placeholder="Search post..." value="<?php echo $search; ?>">

<br>

<button class="btn btn-primary">Search</button>

</form>

<!-- Display Posts -->

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<div class="card mb-3">
<div class="card-body">

<h4><?php echo $row['title']; ?></h4>

<p><?php echo $row['content']; ?></p>

</div>
</div>

<?php
}
?>

<!-- Pagination -->

<?php

$sql_total = "SELECT COUNT(id) AS total FROM posts";
$result_total = mysqli_query($conn,$sql_total);
$row_total = mysqli_fetch_assoc($result_total);

$total_pages = ceil($row_total['total'] / $limit);

for($i=1; $i<=$total_pages; $i++){
?>

<a class="btn btn-secondary m-1" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
<?php echo $i; ?>
</a>

<?php
}
?>

</div>

</body>
</html>