<?php 
require_once("inc/db.php");
$code = $_GET['content_code'];
$name = $_POST['name'];
$db = db_select("SELECT * FROM contents WHERE content_code='$code'");



//파일 업로드
if ( $_POST[ 'action' ] == "등록" ) {
    $thumbnail_file_name_tmp = $_FILES[ 'thumbnail' ][ 'tmp_name' ];
    $thumbnail_file_name = $code.'0';
    $thumbnail_folder = "img/thumbnail/";
	
    $toon_file_name_tmp = $_FILES[ 'toon' ][ 'tmp_name' ];
    $toon_file_name = $code.'0';
    $toon_folder = "img/toon/";
	if($db[0]['user_toon'] == true)
	{
		$thumbnail_folder = "img/user_thumbnail/";
		$toon_folder = "img/user_toon/";
	}
    $thumbnail = $thumbnail_folder.$thumbnail_file_name;
    $toon = $toon_folder.$toon_file_name;
    $episode = db_select("SELECT * FROM episode WHERE content_code='$code' ORDER BY content_episode DESC");
	$con = mysqli_connect("localhost", "root", "1234", "webtoon");
	if(isset($episode[0]) === false){
		
		$sql = "INSERT INTO episode(content_code, content_episode, episode_thumbnail, episode_img, episode_name)
		VALUES ('$code','0','$thumbnail','$toon','$name')";
		mysqli_query($con, $sql);
	} else {
		$num = $episode[0]['content_episode'] + 1;
		$thumbnail_file_name = $code.$num;
		$thumbnail = $thumbnail_folder.$thumbnail_file_name;
		$toon_file_name = $code.$num;
		$toon = $toon_folder.$toon_file_name;
		$sql = "INSERT INTO episode(content_code, content_episode, episode_thumbnail, episode_img, episode_name)
		VALUES ('$code','$num','$thumbnail','$toon','$name')";
		mysqli_query($con, $sql);
	}
	
	$sql = "UPDATE `contents` SET `content_update_date`=current_timestamp() WHERE content_code='$code'";
	mysqli_query($con, $sql);
	
	move_uploaded_file( $thumbnail_file_name_tmp, $thumbnail_folder . $thumbnail_file_name );
	move_uploaded_file( $toon_file_name_tmp, $toon_folder . $toon_file_name );
}

header("Location: contents_detail.php?content_code=$code");

?>