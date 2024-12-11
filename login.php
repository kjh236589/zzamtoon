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
    <?php
    ob_start();
    require_once("inc/header.php");
	// ![수정필요] 카카오 API 환경설정 파일 
	include_once "config.php";
	

	// 정보치환 
	$replace = array(
		'{client_id}'=>$kakaoConfig['client_id'],
		'{redirect_uri}'=>$kakaoConfig['redirect_uri'],
		'{state}'=>md5(mt_rand(111111111,999999999)),
	);
	setcookie('state',$replace['{state}'],time()+300); // 300 초동안 유효

	$login_auth_url = str_replace(array_keys($replace), array_values($replace),$kakaoConfig['login_auth_url']);
    
    define('NAVER_CLIENT_ID', 'E_blvpeac_wZtLrt5jrd');
    define('NAVER_CLIENT_SECRET', 'Tnx8LiNTmy');
    define('NAVER_CALLBACK_URL', 'http://localhost:8080/zzamtoon/naveroauth.php');
    $naverUrl = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL);

    
    ?>
    <script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script><?php // http://craftpip.github.io/jquery-confirm/ ?> 

    <main class="login_wrapper member">
        <div class="login_start">
            <span class="login_title"> 로그인 </span>
        </div>
        <div class="login_sns_wrapper">
            <a href="">
                <div class="kakao_login">
                    <a href="<?php echo $login_auth_url ?>" id="kakao-login"><img alt="resource preview" src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg"></a>
                </div>
            </a>
            <a href="">
                <div class="naver_login">
                    <a href="<?=$naverUrl?>">
                        <span class="naver_login_title"> 네이버 로그인 </span>
                    </a>
                </div>
            </a>
        </div>
        <div class="login_or">
            <span class="login_or_title"> -------------------------------------------------------------------------------------------------- </span>
        </div>

        <form name="login_form" method="POST" action="login.post.php">
            <div class="ID_wrapper">
                <fieldset class="ID_field-container">
                    <input type="text" placeholder="아이디를 입력하세요." class="ID_field_text" name="id" />
                </fieldset>
            </div>
            <div class="FW_wrapper">
                <fieldset class="FW_field-container">
                    <input type="password" placeholder="비밀번호를 입력하세요." class="FW_field_text" name="pass" />
                </fieldset>
            </div>
            <div class="login_keep_wrapper">
                <div class="ID_keep_check">
                    <input type="checkbox" class="input_ID_keep">
                    <lavel for="ID_keep" class="ID_keep_text"> 아이디 저장 </lavel>
                </div>
                <div class="all_keep_check">
                    <input type="checkbox" class="input_all_keep">
                    <lavel for="all_keep" class="all_keep_text"> 로그인 상태 유지 </lavel>
                </div>
            </div>
            <div class="finish_login_wrapper">
                <button class="finish_login" onclick="login()">
                    <span class="finish_login_title"> 로그인 </span>
                </button>
            </div>
        </form>

        <div class="find_wrapper">
            <ul>
                <a href="sign_up.php">
                    <li> <span>회원가입</span>
                    </li>
                </a>
                <a href="id.php">
                    <li> <span>아이디 찾기</span> </li>
                </a>
                <a href="password.php">
                    <li class="none_border"> <span>비밀번호 찾기</span> </li>
                </a>
            </ul>
        </div>

        <!-- class="find_text" -->

        <div class="login_member_non_member"></div>

    </main>

    <?php require_once("inc/footer.php"); ?>

    <script src="https://kit.fontawesome.com/73fbcb87e6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="../js/hot_issue.js"></script>
    <script src="js/member.js"></script>
</body>

</html>