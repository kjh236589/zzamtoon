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
        <span class="join_us_title">아이디 찾기</span>
        <div class="join_box2">
            <div class="password_form">
                <div class="password_form_col">
                    <div class="password_form_row row1">
                        <?php
                            require_once("inc/db.php");
                            
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
                            
                            $name = $_POST["name"];
                            $phone = $_POST["phone"];
                            $birth = $_POST["birth"];
                            $con = mysqli_connect("localhost", "root", "1234", "webtoon");
                            
                            $member = db_select("select * from members where name= ? and phone=? and birth=?", array("$name", "$phone","$birth"));
                            if(isset($member[0]) == true){
                                foreach($member as $m){
                                    ?>
                                    <div class="form">
                                        <div class="col1">아이디</div>
                                        <div class="col1"><?php echo "$m[id]"?></div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
        <section>
            <button class="button_join" onclick="location.replace('login.php')" id="join_button">로그인</button>
        </section>
    </main>
    <script src="js/member.js"></script>
</body>

</html>