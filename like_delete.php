<?php 
session_start();
$code = $_GET['content_code'];


$con = mysqli_connect("localhost", "root", "1234", "webtoon");
$sql = "DELETE FROM liketoon where id= '$_SESSION[member_id]' and content_code= '$code'";
mysqli_query($con, $sql);
?>
	<script>
		history.back();
	</script>