<?php
session_start();
require_once("db.php");
if (isset($_POST['rating']) === true) {
	$star=$_POST['rating'];


	//파일 업로드
	if ( $_POST[ 'action' ] == "등록" ) {
		
		$con = mysqli_connect("localhost", "root", "1234", "webtoon");

		$sql = "INSERT INTO rate (episode_rating, content_code, content_episode, id) VALUES ('$star','$_SESSION[content_code]','$_SESSION[content_episode]','$_SESSION[member_id]')";
		mysqli_query($con, $sql);
		
		$episode_rate = db_select("SELECT episode_rating FROM rate WHERE content_code= ? and content_episode= ?", array("$_SESSION[content_code]", "$_SESSION[content_episode]"));
		$rate = 0.0;
		$count = 0;
		foreach($episode_rate as $r){
			$rate += $r['episode_rating'];
			$count++;
		}
		$rate /= $count;
		$sql = "UPDATE episode SET episode_rating='$rate' WHERE content_code='$_SESSION[content_code]' and content_episode='$_SESSION[content_episode]'";
		mysqli_query($con, $sql);
		
		$content_rate = db_select("SELECT episode_rating FROM episode WHERE content_code= ?", array("$_SESSION[content_code]"));
		$rate = 0.0;
		$count = 0;
		foreach($content_rate as $r){
			$rate += $r['episode_rating'];
			$count++;
		}
		$rate /= $count;
		$sql = "UPDATE contents SET content_rating='$rate' WHERE content_code='$_SESSION[content_code]'";
		mysqli_query($con, $sql);
		mysqli_close($con);
		unset($_SESSION['content_code']);
		unset($_SESSION['content_episode']);
	}
}
?>
	<script>
		history.back();
	</script>