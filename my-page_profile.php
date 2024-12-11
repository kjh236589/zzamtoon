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
    <div class="adv_main">adv</div>
    <?php 
    require_once("inc/header.php");
    
    $member_data = db_select("select * from members where id = ?", array($_SESSION['member_id']));
    ?>

    <main class="main_wrapper my-page member_info">
        <section class="menus">
            <div class="my-page_title"><span>MY PAGE</span></div>
            <ul class="navs">
                <a href="my-page_member_pwd.php"><li class="nav" style="width: 165px;"><span>회원정보 수정</span></li></a>
                <a href="my-page_profile.php"><li class="nav" style="background-color: rgb(255, 139, 139); width: 165px;"><span>프로필 변경</span></li></a>
                <a href="my-page_withdrawale.php"><li class="nav" style="width: 165px;"><span>회원탈퇴</span></li></a>
            </ul>
        </section>
        <section class="view">
            <div class="member_pwd_title"><span>프로필 수정</span></div>
            <div class="join_box">
                <form name="member_form" method="POST" action="profile_update.php" class="member_form" enctype="multipart/form-data">
                    <div class="member_form_col">
                        <div class="member_form_row row1">
                            <div class="form">
                                <div class="col1">닉네임</div>
                                <div class="col2">
                                    <input type="text" value=<?php print_r($member_data[0]["nickname"])?> name="nickname" class = "input_text">
                                </div>
                            </div>
                            
                            <?php
                                    if($member_data[0]["platform"] == 0)
                                    {
                                    ?>
                            <div class="filebox bs3-primary preview-image">
                                <label for="input_file">사진 첨부하기</label>
                                <input class="upload-name" value="프로필 선택" disabled="disabled" style="width: 200px;">
                                <input name="photo" type="file" id="input_file" class="upload-hidden" >
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