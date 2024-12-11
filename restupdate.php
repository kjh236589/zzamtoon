<?php 
$code = $_GET['content_code'];


$con = mysqli_connect("localhost", "root", "1234", "webtoon");
$sql = "UPDATE `contents` SET `content_rest`=!`content_rest` WHERE content_code='$code'";
mysqli_query($con, $sql);

header("Location: contents_detail.php?content_code=$code");

?>