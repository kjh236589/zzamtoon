<?php
    if(!$_POST["pass"]){
        ?>
        <script>
            alert("비밀번호를 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["pass_confirm"] || $_POST["pass"] != $_POST["pass_confirm"]){
        ?>
        <script>
            alert("비밀번호를 확인해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
    if(!$_POST["name"]){
        ?>
        <script>
            alert("이름을 입력해주세요.");
            history.back();
        </script>
        <?php
        return;
    }
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
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $pass_confirm = $_POST["pass_confirm"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $birth = $_POST["birth"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    $nickname = $_POST["nickname"];
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");

    // 비밀번호 암호화
    $bcrypt_pw = password_hash($pass, PASSWORD_BCRYPT);

	$sql = "insert into members(id, pass, name, phone, birth, email1, email2, nickname) ";
	$sql .= "values('$id', '$bcrypt_pw', '$name','$phone', '$birth', '$email1','$email2','$nickname')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

?>
        <script>
            alert("회원가입 완료\n로그인 해주세요.");
            location.replace('login.php');
        </script>