<?php require_once("contents.import.php");?>
<?php require_once("inc/session.php");?>
<?php
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");
    $sql = "UPDATE members SET name='', nickname='탈퇴한 이용자', phone='', birth=null,email1=null, email2=null, user_img='img/user/default_user.png', withdrawal='0' WHERE id='$_SESSION[member_id]'";
    mysqli_query($con, $sql);
    mysqli_close($con);
    session_start();
    session_destroy();
    ?>
    <script>
        alert("회원탈퇴가 완료됐습니다.");
        location.replace('index.php');
    </script>