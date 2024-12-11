<?php
session_start();
require_once("db.php");
$comment_id=$_GET["comment_id"];
$comment_data=$_GET["comment_data"];

$con = mysqli_connect("localhost", "root", "1234", "webtoon");
$sql = "DELETE FROM `comment` WHERE id ='$comment_id' and comment_date='$comment_data'";
mysqli_query($con, $sql);
$sql = "DELETE FROM `comment_rate` WHERE comment_id ='$comment_id' and comment_date='$comment_data'";
mysqli_query($con, $sql);
?>
	<script>
		history.back();
	</script>