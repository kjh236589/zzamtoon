<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ex-mall</title>
</head>

<body>

    <main class="main_wrapper sign_up">
        <span class="join_us_title">비밀번호 찾기</span>
        <div class="join_box2">
            <form name="password_form" method="POST" action="password_update.php" class="password_form">
                <div class="password_form_col">
                    <div class="password_form_row row1">
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <section>
            <button class="button_join" onclick="check_password()" id="join_button">비밀번호 찾기</button>
            <button class="button_cancel" onclick="history.back()">취소</button>
        </section>
    </main>
    <script src="js/member.js"></script>
</body>

</html>