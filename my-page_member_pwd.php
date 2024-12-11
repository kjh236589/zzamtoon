<!-- <?php require_once("pay.import.php");?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>HARU</title>
</head>

<body>
    <div class="adv_main"></div>
    <?php require_once("inc/header.php");
    require_once("inc/session.php");
    if($member_data[0]["platform"] == 0){
    ?>
    


    <main class="main_wrapper my-page">
        <section class="menus">
            <div class="my-page_title"><span>MY PAGE</span></div>
            <ul class="navs">
                <a href="my-page_member_pwd.php"><li class="nav" style="background-color: rgb(255, 139, 139); width: 165px;"><span>회원정보 수정</span></li></a>
                <a href="my-page_profile.php"><li class="nav" style="width: 165px;"><span>프로필 변경</span></li></a>
                <a href="my-page_withdrawale.php"><li class="nav" style="width: 165px;"><span>회원탈퇴</span></li></a>
            </ul>
        </section>
        <section class="view">
            <div class="member_pwd_title"><span>회원 정보 수정</span></div>
            <section class="table member">
                <table>
                    <form class="form" method="POST" action="my-page_go.php" >
                        <div class="pwd_col1">비밀번호 입력</div>
                        <div class="pwd_col2">
                            <input type="password" name="pass_member">
                        </div>
                        <input class="upload" type="submit" name="action" value="등록">
                    </form>


                </table>
            </section>
        </section>
    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>
    <?php 
    }
    else{
        echo "<script>location.href='my-page_mem_info.php'</script>";
    }?>
</body>

</html>