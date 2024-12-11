<?php require_once("contents.import.php");?>
<?php require_once("inc/session.php");?>

<?php 
$name = $_POST['name'];
$author = $_SESSION['member_id'];
$db = db_select("SELECT * FROM contents ORDER BY content_code DESC");

//파일 업로드
if ( $_POST[ 'action' ] == "등록" ) {
    $uploaded_file_name_tmp = $_FILES[ 'photo' ][ 'tmp_name' ];
    $uploaded_file_name = $db[0]['content_code'] + 1;
    $upload_folder = "img/user_contents_thumbnail/";
    $photo = $upload_folder.$uploaded_file_name;
    
	$con = mysqli_connect("localhost", "root", "1234", "webtoon");


	
	$code = $db[0]['content_code'] + 1;

	$sql = "INSERT INTO contents(content_code, content_img, week, content_name, content_author, user_toon)
	VALUES ('$code','$photo', 0,'$name','$author', 1)";
	mysqli_query($con, $sql);
	
	move_uploaded_file( $uploaded_file_name_tmp, $upload_folder . $uploaded_file_name );
}

header("Location: index.php");


?>