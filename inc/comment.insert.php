<?php
session_start();
require_once("db.php");
if (isset($_POST['comment_contents']) === true) {
	$comment=$_POST['comment_contents'];


	//파일 업로드
	if ( $_POST[ 'action' ] == "등록" ) {
		$con = mysqli_connect("localhost", "root", "1234", "webtoon");

		$sql = "INSERT INTO comment(content_code, content_episode, comment, id) VALUES ('$_SESSION[content_code]','$_SESSION[content_episode]','$comment','$_SESSION[member_id]')";
		mysqli_query($con, $sql);
	}
}
$prevPage = $_SERVER['HTTP_REFERER'];
if(!strpos($prevPage, "comment"))
{
	$prevPage = $prevPage."&comment=0";
}
header('location:'.$prevPage);
?>