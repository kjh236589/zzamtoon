<!-- <?php require_once("pay.import.php");?> -->
<?php require_once("contents.import.php");?>

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
    <?php 
    require_once("inc/header.php");
    
    $member_data = db_select("select * from members where id = ?", array($_SESSION['member_id']));
    ?>

    <main class="main_wrapper my-page member_info">
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
            <div class="join_box">
                <form name="member_form" method="POST" action="member_update.php" class="member_form">
                    <div class="member_form_col">
                        <div class="member_form_row row1">
                            <div class="clear"></div>
                            <div class="form">
                                <div class="col1">이름</div>
                                <div class="col2">
                                    <?php
                                    if($member_data[0]["platform"] == 0)
                                    {
                                    ?>
                                        <input type="text" value=<?php print_r($member_data[0]["name"])?> name="name" class = "input_text">
                                    <?php
                                    }else{
                                    ?>
                                        <input type="text" value=<?php print_r($member_data[0]["name"])?> name="name" class = "input_text" readonly>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form">
                                <div class="col1">휴대전화</div>
                                <div class="col2">
                                    <input type="text" value=<?php print_r($member_data[0]["phone"])?> name="phone" class = "input_text">
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="form">
                                <div class="col1">생년월일</div>
                                <div class="col2">
                                    <input type = "date" value=<?php print_r($member_data[0]["birth"])?> name="birth" class = "input_text">
                                </div>
                            </div>
                            <div class="form email">
                                <div class="col1">이메일</div>
                                <div class="col2">
                                    <input type="text" value=<?php print_r($member_data[0]["email1"])?> name="email1" class = "input_text"> &nbsp;@&nbsp;<input type="text" value=<?php print_r($member_data[0]["email2"])?> name="email2" class = "input_text">
                                </div>
                            </div>
                            <?php
                            if($member_data[0]["platform"] == 0)
                            {
                            ?>
                            <div class="form id">
                                <div class="col1">비밀번호 변경</div>
                                <div class="col2">
                                    <input type="password" name="pass1" class = "input_text">
                                </div>
                            </div>
                            <div class="form id">
                                <div class="col1">비밀번호 확인</div>
                                <div class="col2">
                                    <input type="password" name="pass2" class = "input_text">
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <section>
                    <input class="button_join" type="submit" name="action" value="등록">
                    <button class="button_cancel" onclick="history.back(2)">취소</button>
                </section>
                </form>
            </div>
        </section>

    </main>

    <?php require_once("inc/fast_move.php"); ?>
    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="js/hot_issue.js"></script>
    <script src="js/member.js"></script>

</body>

</html>