<main class ="main_wrapper review_write">
<div>
<?php

	$episode = db_select("select * from episode where content_code= ? and content_episode= ?", array("$content_code", "$content_episode"));

	for($i = 1; $i <= 5 ; $i++)
	{
		if($episode[0]['episode_rating'] >= $i)
		{
			?>
			<span>⭐</span>
			<?php
		}else{
			?>
			<span>☆</span>
			<?php	
		}
	}
	?>
	<span><?php print_r(round($episode[0]['episode_rating'], 2))?></span>
</div>
<?php
	if (isset($_SESSION['member_id']) === true)
	{
		$_SESSION['content_code']=$content_code;
		$_SESSION['content_episode']=$content_episode;
		$rate = db_select("select * from rate where id= ? and content_code= ? and content_episode= ?", array("$_SESSION[member_id]", "$content_code", "$content_episode"));
		if(isset($rate[0]) === false){
?>
			<form name="write_form" class="write_form" method="POST" action="inc/review.insert.php">
				<section class="star">
					<div class="stars">
						<fieldset>
							<input type="radio" name="rating" value="5" id="rate1"><label for="rate1">⭐</label>
							<input type="radio" name="rating" value="4" id="rate2"><label for="rate2">⭐</label>
							<input type="radio" name="rating" value="3" id="rate3"><label for="rate3">⭐</label>
							<input type="radio" name="rating" value="2" id="rate4"><label for="rate4">⭐</label>
							<input type="radio" name="rating" value="1" id="rate5"><label for="rate5">⭐</label>
						</fieldset>
					</div>
				</section>
				<br>
				<input class="upload" type="submit" name="action" value="등록">
			</form>  
        
<?php
		}
	}
?>

</main>