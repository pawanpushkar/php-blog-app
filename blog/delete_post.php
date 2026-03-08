<?php
include 'db.php';

if(isset($_GET['id'])){

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
$stmt->bind_param("i",$id);

if($stmt->execute()){
    
    header("Location: view_posts.php");
    exit();

}else{

    echo "Error deleting post";

}

}
?>