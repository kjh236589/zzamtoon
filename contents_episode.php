<?php
require_once("inc/db.php");

$content_code=$_GET["content_code"];

$content_episode=$_GET["content_episode"];

$result = db_select("select * from contents where content_code= ?", array("$content_code"));

$member = db_select("select * from members where id= ?", array($result[0]['content_author']));

$episode = db_select("select * from episode where content_code= ? and content_episode= ?", array("$content_code", "$content_episode"));

    $con = mysqli_connect("localhost", "root", "1234", "webtoon");

	$sql = "UPDATE episode SET episode_views=episode_views + 1 WHERE content_code='$content_code' and content_episode='$content_episode'";
	mysqli_query($con, $sql);
	$sql = "UPDATE contents SET content_views=content_views + 1 WHERE content_code='$content_code'";
	mysqli_query($con, $sql);
    mysqli_close($con);     

?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ZZAMTOON::<?php print_r($result[0]["content_name"])?>::<?php print_r($episode[0]["episode_name"])?></title>
	<meta name="title" content="짬툰 <?php print_r($result[0]["content_name"])?>" />
	<meta name="keyword" content="웹툰, 과제, 짬툰, <?php print_r($result[0]["content_name"])?>">
	<meta name="subject" content="웹툰">
	<meta name="description" content="웹툰, 과제, 짬툰, <?php print_r($result[0]["content_name"])?>">
	<meta name="author" content="<?php print_r($member[0]["nickname"])?>" />
	<meta property="og:type" content="article">
	<meta property="og:title" content="짬툰::<?php print_r($result[0]["content_name"])?>::<?php print_r($episode[0]["episode_name"])?>">
	<meta property="og:description" content="<?php print_r($episode[0]["episode_name"])?>">
	<meta property="og:image" content="http://localhost:8080/zzamtoon/<?php print_r($episode[0]["episode_thumbnail"])?>">
	<meta property="og:url" content="http://localhost:8080/zzamtoon/contents_episode.php?content_code=<?php print_r($content_code)?>&content_episode=<?php print_r($content_episode)?>">
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper">
	<?php 
	if(db_select("select * from episode where content_code= ? and content_episode= ? - 1", array("$content_code", "$content_episode")) != null)
	{
	?>
                <div class="login_nav">
					<div class="login_font">
                    <a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode" - 1?>"><span>이전화</span></a>
					</div>
                </div>
	<?php
	}
	if(db_select("select * from episode where content_code= ? and  content_episode= ? + 1", array("$content_code", "$content_episode")) != null)
	{
	?>
                <div class="login_nav">
					<div class="login_font">
                    <a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode" + 1?>"><span>다음화</span></a>
					</div>
                </div>
	<?php 
	}?>
		
        <ul class="episode_ba">
			<div class="episode_img"><img src="<?php print_r($episode[0]["episode_img"])?>"/></div>
        </ul>
	
	<?php 
	if(db_select("select * from episode where content_code= ? and content_episode= ? - 1", array("$content_code", "$content_episode")) != null)
	{
	?>
                <div class="login_nav">
					<div class="login_font">
                    <a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode" - 1?>"><span>이전화</span></a>
					</div>
                </div>
	<?php 
	}
	if(db_select("select * from episode where content_code= ? and  content_episode= ? + 1", array("$content_code", "$content_episode")) != null)
	{
	?>
                <div class="login_nav">
					<div class="login_font">
                    <a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode" + 1?>"><span>다음화</span></a>
					</div>
                </div>
	<?php 
	}?>

    </main>
	<?php require_once("inc/review_write.php"); ?>
	<?php require_once("inc/comment_write.php"); ?>
    <?php require_once("inc/fast_move.php"); ?>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/55083c7425.js" crossorigin="anonymous"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/app.js"></script>
    <script src="js/option.js"></script>
    <script src="js/star.js"></script>
</body>

</html> 