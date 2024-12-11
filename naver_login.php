<?php
require_once("inc/db.php");
require_once("inc/session.php");

$login_id = $_SESSION['naver_id'];

// 회원 데이터
$member_data = db_select("select * from members where id = ?", array($login_id));
// var_dump($member_data);

// 회원 데이터가 없다면
if ($member_data == null || count($member_data) == 0){
    ?>
            <script>
                alert("회원가입을 먼저하세요.");
                location.replace('login.php');
            </script>
    <?php
    exit();
}

if($member_data[0]['withdrawal'] == 0){
    ?>
            <script>
                alert("탈퇴한 회원입니다.");
                location.replace('login.php');
            </script>
    <?php
    exit();
}


$profile = $_SESSION['profile_image'];
$con = mysqli_connect("localhost", "root", "1234", "webtoon");


$_SESSION['member_id'] = $member_data[0]['id'];

$sql = "UPDATE members SET name='$_SESSION[naver_name]', nickname='$_SESSION[naver_nickname]', user_img='$profile' WHERE id='$_SESSION[member_id]'";
mysqli_query($con, $sql);

// var_dump($_SESSION['member_id']);

// 메인페이지로 이동
header("Location: index.php");

?>