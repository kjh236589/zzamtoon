<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Ex-mall</title>
    <script>
        function checkid(){
            var userid = document.getElementById("id").value;
            if(userid)
            {
                url = "check.php?userid="+userid;
                window.open(url,"chkid","width=400,height=200");
            } else {
                alert("아이디를 입력하세요.");
            }
        }
        function yes(){
            document.getElementById("decide").innerHTML = "<span style='color:blue;'>사용 가능한 ID입니다.</span>"
	        document.getElementById("join_button").disabled = false;
        }
        function no(){
            document.getElementById("decide").innerHTML = "<span style='color:red;'>중복된 ID입니다.</span>"
        }
    </script>
</head>

<body>

    <main class="main_wrapper sign_up">
        <span class="join_us_title">JOIN US</span>
        <div class="join_box">
            <form name="member_form" method="POST" action="member_insert.php" class="member_form">
                <div class="member_form_col">
                    <div class="ref">필수입력</div>
                    <div class="member_form_row row1">
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id" id="id" required>
                                <p><span id="decide" style='color:red;'>ID 중복 여부를 확인해주세요.</span>
                                <input type="button" id="check_button" value="ID 중복 검사" onclick="checkid();"></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <input type="password" name="pass" id="pass" required>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호 확인</div>
                            <div class="col2">
                                <input type="password" name="pass_confirm" id="pass_confirm" required>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">닉네임</div>
                            <div class="col2">
                                <input type="text" name="nickname">
                            </div>
                        </div>
                        <div class="form">
                            <div class="col1">휴대전화</div>
                            <div class="col2">
                                <input type="text" name="phone">
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="ref">선택입력</div>
                    <div class="member_form_row row2">
                        <div class="form">
                            <div class="col1">생년월일</div>
                            <div class="col2">
                                <input type = "date" name = "birth"  value =&lt?php  echo  $v_testDate ?>
                            </div>
                        </div>
                        <div class="form email">
                            <div class="col1">이메일</div>
                            <div class="col2">
                                <input type="text" name="email1">@<input type="text" name="email2">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
        <section>
            <button class="button_join" onclick="check_input()" id="join_button" disabled=true>가입</button>
            <button class="button_cancel" onclick="history.back()">취소</button>
        </section>
    </main>
    <script src="js/member.js"></script>
</body>

</html>