<?php
    require_once("inc/session.php");
    if(!$_POST["phone"]){
        ?>
        <script>
            alert("휴대폰 번호를 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["birth"]){
        ?>
        <script>
            alert("생년월일을 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["email1"]){
        ?>
        <script>
            alert("이메일을 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["email2"]){
        ?>
        <script>
            alert("이메일을 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["nickname"]){
        ?>
        <script>
            alert("닉네임을 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    $id   = $_SESSION['kakao_id'];
    $name = $_SESSION['nickname'];
    $phone = $_POST["phone"];
    $birth = $_POST["birth"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    $nickname = $_POST["nickname"];
    $profile = $_SESSION['profile_image'];
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");

	$sql = "insert into members(id, pass, name, phone, birth, email1, email2, nickname, user_img, platform) ";
	$sql .= "values('$id', '0', '$name','$phone', '$birth', '$email1','$email2','$nickname', '$profile', '1')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

?>
        <script>
            alert("회원가입 완료!");
            location.replace('kakao_login.php');
        </script>