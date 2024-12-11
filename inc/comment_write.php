<?php
$list_num = 5;

$page_num = 5;
$flag = false;
if(isset($_GET["page"])){
	$flag = true;
}
$page = isset($_GET["page"])? $_GET["page"]==0? 1:$_GET["page"] : 1;





?>
<main class ="main_wrapper review_write">
<?php
	if (isset($_SESSION['member_id']) === true)
	{
?>
   <form name="write_form" class="write_form" method="POST" action="inc/comment.insert.php" enctype="multipart/form-data">
        <section class="form_wrapper">
			<div class="write_title">댓글 작성</div>
            <textarea name="comment_contents" class="write_text_area" name="story" placeholder="내용을 입력해주세요"  required></textarea>
			<div class="writeBtn">
				<input class="upload" type="submit" name="action" value="등록">
			</div>
        </section>
    </form>
<?php
	}else{
?>
   <form name="write_form" class="write_form" method="POST" action="login.php" enctype="multipart/form-data">
        <section class="form_wrapper">
			<div class="write_title">댓글 작성</div>
            <textarea name="comment_contents" class="write_text_area" name="story" placeholder="내용을 입력해주세요"></textarea>
			<div class="writeBtn">
				<input class="upload" type="submit" name="action" value="등록">
			</div>
        </section>
    
    </form>
<?php
	}
	if(isset($_GET["comment"])){
		?>
		<script>
			window.scrollTo(0,document.body.scrollHeight);	
		</script>
		<?php
		$flag = false;
		$page = 1;
	}
?>
	<table>
	
<div class="comment_wrapper">
	<ul class="comment_contents">
<?php

$select_query = "select * from comment where content_code= $content_code and content_episode=$content_episode";
$con = mysqli_connect("localhost", "root", "1234", "webtoon");
$result_set = mysqli_query($con, $select_query);
$num = mysqli_num_rows($result_set);
$total_page = ceil($num / $list_num);

$total_block = ceil($total_page / $page_num);

$now_block = ceil($page / $page_num);

$s_pageNum = ($now_block - 1) * $page_num + 1;
if($s_pageNum <= 0){
    $s_pageNum = 1;
};

$e_pageNum = $now_block * $page_num;
if($e_pageNum > $total_page){
    $e_pageNum = $total_page;
};

$start = ($page - 1) * $list_num;


$sql = "select * from comment where content_code= $content_code and content_episode= $content_episode ORDER BY comment_date DESC limit $start, $list_num;";

$comment = mysqli_query($con, $sql);

	if (isset($comment) === true)
	{
	foreach($comment as $c){
		$member = db_select("select * from members where id= ?", array("$c[id]"));
?>

		<span class="comment_var">
			<div class="comment_icon">
				<img src=<?php print_r($member[0]["user_img"])?> alt=""/>
	</div>
			<li class="comment_main_content">
				<div class="content_text_wrapper">
					<div class="content_comment_name"> 
						<span class="member_name"><?php print_r($member[0]["nickname"])?></span>
						<span class="member_id"><?php echo "($c[id])&nbsp;"?></span>
						<span class="comment_data"><?php echo substr("$c[comment_date]",0,16)?></span>
					
<?php
	$comment = nl2br($c['comment']);
	
	$good_data = db_select("select * from comment_rate where goodorno = ? and content_code = ? and content_episode = ? and comment_id = ? and comment_date = ?", array(1, $content_code, $content_episode, $c['id'], $c['comment_date']));
	$bad_data = db_select("select * from comment_rate where goodorno = ? and content_code = ? and content_episode = ? and comment_id = ? and comment_date = ?", array(0, $content_code, $content_episode, $c['id'], $c['comment_date']));

	if (isset($_SESSION['member_id']) === true)
	{
		$user_data = db_select("select * from comment_rate where content_code = ? and content_episode = ? and user_id = ? and comment_id = ? and comment_date = ?", array($content_code, $content_episode, $_SESSION['member_id'], $c['id'], $c['comment_date']));
		if($user_data == null || count($user_data) == 0){
			?>
			<a href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=1"><span><?php print_r(count($good_data))?></span><img src="img/icon/good.png" class="icon" alt=""/></a>
			<a href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=0"><span><?php print_r(count($bad_data))?></span><img src="img/icon/bad.png" class="icon"alt=""/></a>
			<?php
		}
		else
		{
			if($user_data[0]['goodorno'] == 1){
				?>
				<a class="comment_good" href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=1"><span><?php print_r(count($good_data))?></span><img src="img/icon/good.png" class="icon" alt=""/></a>
				<a href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=0"><span><?php print_r(count($bad_data))?></span><img src="img/icon/bad.png" class="icon"alt=""/></a>
				<?php
			}
			else{
				?>
				<a href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=1"><span><?php print_r(count($good_data))?></span><img src="img/icon/good.png" class="icon" alt=""/></a>
				<a class="comment_bad" href="inc/comment.good.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>&goodorno=0"><span><?php print_r(count($bad_data))?></span><img src="img/icon/bad.png" class="icon"alt=""/></a>
				<?php
			}
		}
	}
	else{
?>

					<a href="login.php"><?php print_r(count($good_data))?></span><img src="img/icon/good.png" class="icon" alt=""/></a>
					<a href="login.php"><?php print_r(count($bad_data))?></span><img src="img/icon/bad.png" class="icon" alt=""/></a>
					<?php
	}
	
	if (isset($_SESSION['member_id']) === true && ($_SESSION['member_id'] == "admin" || $_SESSION['member_id'] == $c['id']))
	{
?>
					<a class="comment_data" href="inc/comment.delete.php?comment_id=<?php echo "$c[id]"?>&comment_data=<?php echo "$c[comment_date]"?>"><span>삭제</span></a>
<?php
	}
					?>
					</div>
					<div class="content_comment">
						<span class="comment"><?php echo "$comment"?></span>
					</div>
				</div>
			</li>
</span>
<?php
  }
?>
  <p class="pager">

    <?php
    if($page > 1){
    ?>
    <a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode"?>&page=<?php echo ($page-1); ?>">이전</a>
    <?php }else{
    ?>
    <a style='color:darkgray;'>이전</a>
    <?php 
	};
	
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
		if($page == $print_page){
	?>
    	<a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode"?>&page=<?php echo $print_page; ?>" style='color:black;'><?php echo $print_page; ?></a>
    <?php }else{
	?>
    	<a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode"?>&page=<?php echo $print_page; ?>"  style='color:darkgray;'><?php echo $print_page; ?></a>
    <?php
	}
	};
	
    if($page < $total_page){
	?>
		<a href="contents_episode.php?content_code=<?php echo "$content_code"?>&content_episode=<?php echo "$content_episode"?>&page=<?php echo ($page+1); ?>">다음</a>
	<?php }else{
    ?>
    <a style='color:darkgray;'>다음</a>
    <?php 
	};?>

</p>
<?php
	}
?>
  
	</ul>
</div>
	</table>
</main>
<?php
	if($flag){
		?>
		<script>
			window.scrollTo(0,document.body.scrollHeight);	
		</script>
		<?php
	}
?>