<?php
    require_once("inc/session.php");
    $id   = $_SESSION['naver_id'];
    $name = $_SESSION['naver_name'];
    $phone = $_SESSION['naver_mobile'];
    $birth = $_SESSION['naver_birth'];
    $email1  = $_SESSION['naver_email1'];
    $email2  = $_SESSION['naver_email2'];
    $nickname = $_SESSION['naver_nickname'];
    $profile = $_SESSION['profile_image'];
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");

	$sql = "insert into members(id, pass, name, phone, birth, email1, email2, nickname, user_img, platform) ";
	$sql .= "values('$id', '0', '$name','$phone', '$birth', '$email1','$email2','$nickname', '$profile', '2')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

?>
        <script>
            alert("회원가입 완료!");
            location.replace('naver_login.php');
        </script>