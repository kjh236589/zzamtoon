<?php
require_once("inc/db.php");

$login_id = isset($_POST['id']) ? $_POST['id'] : null;
$login_pw = isset($_POST['pass']) ? $_POST['pass'] : null;

// 파라미터 체크
if ($login_id == null || $login_pw == null){
    ?>
            <script>
                alert("모두 입력하여 주세요.");
                location.replace('login.php');
            </script>
    <?php
    // header("Location: login.php");
    exit();
}


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

// 비밀번호 일치 여부 검증
$is_match_password = password_verify($login_pw, $member_data[0]['pass']);
// var_dump($member_data[0]['pass']);
// var_dump($login_pw);

// var_dump($is_match_password);

// 비밀번호 불일치
if ($is_match_password === false){
    ?>
            <script>
                alert("비밀번호가 일치하지 않습니다.");
                location.replace('login.php');
            </script>
    <?php
    exit();
}

require_once("inc/session.php");
$_SESSION['member_id'] = $member_data[0]['id'];

// var_dump($_SESSION['member_id']);

// 메인페이지로 이동
header("Location: index.php");

?>