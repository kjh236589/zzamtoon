<?php
session_start();
require_once("db.php");
$comment_id=$_GET["comment_id"];
$comment_data=$_GET["comment_data"];
$goodorno=$_GET["goodorno"];

if($_SESSION['member_id'] != $comment_id)
{
	$con = mysqli_connect("localhost", "root", "1234", "webtoon");
	$rate_data = db_select("select * from comment_rate where content_code = ? and content_episode = ? and user_id = ? and comment_id = ? and comment_date = ?", array($_SESSION['content_code'],$_SESSION['content_episode'], $_SESSION['member_id'], $comment_id, $comment_data));

	if ($rate_data == null || count($rate_data) == 0){
		$sql = "INSERT INTO comment_rate(goodorno, content_code, content_episode, user_id, comment_id, comment_date) VALUES ($goodorno, '$_SESSION[content_code]','$_SESSION[content_episode]', '$_SESSION[member_id]', '$comment_id','$comment_data')";
		mysqli_query($con, $sql);
		if($goodorno == 1)
		{
			$sql = "UPDATE comment SET good=good + 1 WHERE content_code = '$_SESSION[content_code]' and content_episode = '$_SESSION[content_episode]' and id = '$comment_id' and comment_date = '$comment_data'";
			mysqli_query($con, $sql);
		}
		else
		{
			$sql = "UPDATE comment SET bad=bad + 1 WHERE content_code = '$_SESSION[content_code]' and content_episode = '$_SESSION[content_episode]' and id = '$comment_id' and comment_date = '$comment_data'";
			mysqli_query($con, $sql);
		}
	}
	else{
		if($rate_data[0]['goodorno'] == 1){
		?>
		<script>
			alert("이미 좋아요를 눌렀습니다!");
		</script>
		<?php
		}
		else{
		?>
		<script>
			alert("이미 싫어요를 눌렀습니다!");
		</script>
		<?php
		}
	}
}
else{
	?>
	<script>
		alert("본인의 댓글입니다!");
	</script>
	<?php
}
?>
	<script>
		history.back();
	</script>