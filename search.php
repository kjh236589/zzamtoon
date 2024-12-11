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

    <?php require_once("inc/header.php"); ?>
	<?php $search = $_GET['search'];?>
    <main class="main_wrapper">
        <div class="search_main_wrapper">
            <div class="search_main_content_font_wrapper">
                <div class="search_font">
                    <span class="font">웹툰</span>
                </div>
                <div class="search_font">
                    <span class="font">유저툰</span>
                </div>
            </div>
            <div class="search_main_content_wrapper">
                <ul class="search_main_contents">
                    <?php
					$result = db_select("SELECT * FROM contents WHERE user_toon = 0 ORDER BY content_views");
					foreach($result as $r){
                        $m = db_select("select * from members where id= ?", array("$r[content_author]"));
						if(strpos($r['content_name'], $search) !== false || ($m != null && count($m) != 0 && strpos($m[0]['nickname'], $search) !== false))
						{?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]"?>">
                            <li class="search_main_content">
                                <div class="content_img_wrapper">
										<img src="<?php echo "$r[content_img]"?>" alt=""/>
								</div>
                            </li>
                        </a>
						<?php }}?>
                </ul>
                <ul class="search_main_contents">
                    <?php
					$result = db_select("SELECT * FROM contents WHERE user_toon = 0 ORDER BY content_views");
					foreach($result as $r){
                        $m = db_select("select * from members where id= ?", array("$r[content_author]"));
						if(strpos($r['content_name'], $search) !== false ||($m != null && count($m) != 0 && strpos($m[0]['nickname'], $search) !== false))
						{?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]"?>">
                            <li class="search_main_content">
                                <div class="content_img_wrapper">
                                        <span class="content_name"><?php echo "$r[content_name]"?></span>
                                        <span class="content_price"><?php print_r($m[0]["nickname"])?></span>
										<div>
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
                <ul class="search_main_contents">
                    <ul class="search_main_border"></ul>
                </ul>
                <ul class="search_main_contents">
                    <?php
					$result = db_select("SELECT * FROM contents WHERE user_toon = 1 ORDER BY content_views");
					foreach($result as $r){
                        $m = db_select("select * from members where id= ?", array("$r[content_author]"));
						if(strpos($r['content_name'], $search) !== false || ($m != null && count($m) != 0 && strpos($m[0]['nickname'], $search) !== false))
						{?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]"?>">
                            <li class="search_main_content">
                                <div class="content_img_wrapper">
										<img src="<?php echo "$r[content_img]"?>" alt=""/>
								</div>
                            </li>
                        </a>
						<?php }}?>
                </ul>
                <ul class="search_main_contents">
                    <?php
					$result = db_select("SELECT * FROM contents WHERE user_toon = 1 ORDER BY content_views");
					foreach($result as $r){
                        $m = db_select("select * from members where id= ?", array("$r[content_author]"));
						if(strpos($r['content_name'], $search) !== false ||($m != null && count($m) != 0 && strpos($m[0]['nickname'], $search) !== false))
						{?>
                        <a href="contents_detail.php?content_code=<?php echo "$r[content_code]"?>">
                            <li class="search_main_content">
                                <div class="content_img_wrapper">
                                        <span class="content_name"><?php echo "$r[content_name]"?></span>
                                        <span class="content_price"><?php print_r($m[0]["nickname"])?></span>
										<div>
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
