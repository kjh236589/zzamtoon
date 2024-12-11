<?php
require_once("inc/db.php");

$content_code=$_GET["content_code"];

$result = db_select("select * from contents where content_code= ?", array($content_code));

$episode = db_select("select * from episode where content_code= ? ORDER BY content_episode DESC", array("$content_code"));

$member = db_select("select * from members where id= ?", array($result[0]['content_author']));

?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ZZAMTOON::<?php print_r($result[0]["content_name"])?></title>
	<meta name="title" content="짬툰 <?php print_r($result[0]["content_name"])?>" />
	<meta name="keyword" content="웹툰, 과제, 짬툰, <?php print_r($result[0]["content_name"])?>">
	<meta name="subject" content="웹툰">
	<meta name="description" content="웹툰, 과제, 짬툰, <?php print_r($result[0]["content_name"])?>">
	<meta name="author" content="<?php print_r($member[0]["nickname"])?>" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta property="og:type" content="article">
	<meta property="og:title" content="짬툰::<?php print_r($result[0]["content_name"])?>">
	<meta property="og:description" content="매일매일 새로운 재미, 짬툰.">
	<meta property="og:image" content="http://localhost:8080/zzamtoon/<?php print_r($result[0]["content_img"])?>">
	<meta property="og:url" content="http://localhost:8080/zzamtoon/contents_detail.php?content_code=<?php print_r($content_code)?>">
</head>

<body>
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper contents_detail">
	
		<?php
		
		if (isset($_SESSION['member_id']) === true && ($_SESSION['member_id'] == "admin" || ($result[0]['user_toon'] == true && $result[0]['content_author'] == $_SESSION['member_id'])))
		{
		?>
			<a href="episodeupload.php?content_code=<?php echo "$content_code"?>"><button>등록</button></a>
			<?php
			if($result[0]["content_end"]){
			?>
				<a href="endupdate.php?content_code=<?php echo "$content_code"?>"><button>연재</button></a>
			<?php
			}else{
			?>
				<a href="endupdate.php?content_code=<?php echo "$content_code"?>"><button>완결</button></a>
			<?php
			}
			?>
			<?php
			if($result[0]["content_rest"]){
			?>
				<a href="restupdate.php?content_code=<?php echo "$content_code"?>"><button>연재</button></a>
			<?php
			}else{
			?>
				<a href="restupdate.php?content_code=<?php echo "$content_code"?>"><button>휴재</button></a>
			<?php
			}
			?>
		<?php
		}
		?>
        <form class="top">
            <section class="top_left">
				<div class="main_img"><img src="<?php print_r($result[0]["content_img"])?>" alt=""/></div>
				<div class="total_price_wrapper">
					<span class="total_price_title"><?php print_r($result[0]["content_name"])?></span>
				</div>
				<div class="total_price_wrapper">
					<img src=<?php print_r($member[0]["user_img"])?> alt=""/>
					<a class="total_author_title" href="search.php?search=<?php print_r($member[0]["nickname"])?>"><span ><?php print_r($member[0]["nickname"])?></span></a>
				</div>
				<div class="total_price_wrapper">
				<?php
				if (isset($_SESSION['member_id']) === true)
				{
					$like = db_select("select * from liketoon where id= ? and content_code= ?", array("$_SESSION[member_id]", "$content_code"));
					if(isset($like[0]) === true)
					{
				?>
					<a href="like_delete.php?content_code=<?php echo "$content_code"?>"><span class="total_like">♥</span></a>
				<?php
					}else{
					?>
					<a href="like_insert.php?content_code=<?php echo "$content_code"?>"><span class="total_like">♡</span></a>
					<?php
					}
				}else{
				?>
				<a href="login.php"><span class="total_like">♡</span></a>
				<?php
				}
				?>
				</div>
				
            </section>
            <section class="top_right">
				<div class="recommend_detail_wrapper">
					<div class="recommend_detail_content_wrapper">
						<ul class="recommend_main_contents">
							<?php
							foreach($episode as $r){?>
								<li class="recommend_main_content">
									<a href="contents_episode.php?content_code=<?php echo "$r[content_code]"?>&content_episode=<?php echo "$r[content_episode]"?>">
										<div class="content_img_wrapper"><img src="<?php echo "$r[episode_thumbnail]"?>" alt=""/></div>
									</a>
								</li>
								<?php }?>
						</ul>
						<ul class="recommend_main_contents">
							<?php
							foreach($episode as $r){?>
								<li class="recommend_main_content">
									<a href="contents_episode.php?content_code=<?php echo "$r[content_code]"?>&content_episode=<?php echo "$r[content_episode]"?>">
										<div class="content_text_wrapper">
											
											<div class="content_name_wrapper">
												<span class="content_name"><?php echo "$r[episode_name]"?></span>
											</div>
											<div class="content_price_wrapper">
												<span class="content_price"><?php echo "$r[episode_date]"?></span>
											</div>
											<div class="content_price_wrapper">
											<?php
												for($t = 1; $t <= 5 ; $t++)
												{
													if("$r[episode_rating]" >= $t)
													{
														?>
														<span class="content_rate">⭐</span>
														<?php
													}else{
														?>
														<span class="content_rate">☆</span>
														<?php	
													}
												}
												?>
												<span class="content_rate"><?php print_r(round($r['episode_rating'], 2))?></span>
											</div>
										</div>
									</a>
								</li>
								<?php }?>
						</ul>
					</div>
				</div>
            </section>
        </form>

    </main>
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