<?php 
session_start();
$code = $_GET['content_code'];


$con = mysqli_connect("localhost", "root", "1234", "webtoon");
$sql = "INSERT INTO liketoon(id, content_code) VALUES ('$_SESSION[member_id]','$code')";
mysqli_query($con, $sql);
?>
	<script>
		history.back();
	</script>