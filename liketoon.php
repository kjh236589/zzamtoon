<?php require_once("contents.import.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>ZZAMTOON</title>
</head>

<body>
<!--    <div class="adv_main">상 단 광 고</div>	-->
    <?php require_once("inc/header.php"); ?>

    <main class="main_wrapper">
            <div class="recommend_main_header">
                <div class="recomend_main_title"><span>관심 웹툰</span></div>
                <div class="sort_nav_wrapper">
					<?php
						if($_GET['popularity'] == "view")
						{
					?>
					<div class="sort_nav01"><span>조회순</span></div>
					<a href="liketoon.php?popularity=star">
						<div class="sort_nav02"><span>평점순</span></div>
					</a>
					<?php
						}else if($_GET['popularity'] == "star")
						{
					?>
					<a href="liketoon.php?popularity=view">
						<div class="sort_nav02"><span>조회순</span></div>
					</a>
					<div class="sort_nav01"><span>평점순</span></div>
					<?php
						}
					?>
                </div>
            </div>
        <div class="recommend_main_wrapper">
            <div class="popularity_main_content_wrapper">
                <ul class="recommend_main_contents">
                    <?php
					$result = db_select("SELECT * FROM contents ORDER BY content_views DESC");
					if($_GET['popularity'] == "star")
					{
						$result = db_select("SELECT * FROM contents ORDER BY content_rating DESC");
					}
					foreach($result as $r){
						$like = db_select("select * from liketoon where id= ? and content_code= ?", array("$_SESSION[member_id]", "$r[content_code]"));
						if(isset($like[0]) === true){?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]"?>">
                            <li class="recommend_main_content">
                                <div class="content_img_wrapper"> <img src="<?php echo "$r[content_img]"?>" alt=""/></div>
                                <div class="content_text_wrapper">
                                    
                                    <div class="content_name_wrapper">
                                        <span class="content_name"><?php echo "$r[content_name]"?></span>
                                    </div>
									<?php
									if($r['content_rest'] == true){
									?>
										<div class="content_name_wrapper">
											<span class="content_rest">휴재중</span>
										</div>
									<?php
									}
									?>
                                    <div class="content_price_wrapper">
										<?php
										$m = db_select("select * from members where id= ?", array("$r[content_author]"));
										?>
                                        <span class="content_price"><?php print_r($m[0]["nickname"])?></span>
                                    </div>
                                    <div class="content_price_wrapper">
									<?php
										for($t = 1; $t <= 5 ; $t++)
										{
											if("$r[content_rating]" >= $t)
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
										<span class="content_rate"><?php print_r(round($r['content_rating'], 2))?></span>
                                    </div>
                                </div>
                            </li>
                        </a>
					<?php }}?>
                </ul>
            </div>
        </div>
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    <script src="js/sort.js"></script>
    
</body>

</html>
