<?php
session_start();
require_once("inc/db.php");
if (isset($_POST['pass_member']) === true) {
	$comment=$_POST['pass_member'];
    $member_data = db_select("select * from members where id = ?", array($_SESSION['member_id']));
	if (password_verify($comment, $member_data[0]['pass'])) {
        header("Location: my-page_mem_info.php");
	}
    else{
    ?>
        <script>
            alert("비밀번호가 일치하지 않습니다.");
            history.back();
        </script>
    <?php
    }
}
else{
?>
	<script>
		history.back();
	</script>
<?php
}
?>