<?php
    require_once("inc/db.php");
    require_once("inc/session.php");
	try{
		include_once "config.php";

		$res = array('rst'=>'fail','code'=>(__LINE__*-1),'msg'=>'');

		if( empty($_GET['code']) || empty($_GET['state']) ||  $_GET['state'] != $_COOKIE['state']){ throw new Exception("인증실패", (__LINE__*-1) );}
			

		$replace = array(
			'{grant_type}'=>'authorization_code',
			'{client_id}'=>$kakaoConfig['client_id'],
			'{redirect_uri}'=>$kakaoConfig['redirect_uri'],
			'{client_secret}'=>$kakaoConfig['client_secret'],
			'{code}'=>$_GET['code']
		);
		$login_token_url = str_replace(array_keys($replace), array_values($replace), $kakaoConfig['login_token_url']);
		$token_data = json_decode(curl_kakao($login_token_url));
		if( empty($token_data)){ throw new Exception("토큰요청 실패", (__LINE__*-1) ); }
		if( !empty($token_data->error) || empty($token_data->access_token) ){ 
			throw new Exception("토큰인증 에러", (__LINE__*-1) ); 
		}

		$header = array("Authorization: Bearer ".$token_data->access_token);
		$profile_url = $kakaoConfig['profile_url'];
		$profile_data = json_decode(curl_kakao($profile_url,$header));
        
		if( empty($profile_data) || empty($profile_data->id) ){ throw new Exception("프로필요청 실패", (__LINE__*-1) ); }

        $_SESSION['kakao_id'] = $profile_data->id;
        

    
        try{
            
        $xml_data=json_encode($profile_data);
        $xml_data=json_decode($xml_data,true);
        $json_profile_data_array = array_merge($xml_data['properties'],$xml_data['kakao_account']);
        foreach ($json_profile_data_array as $key => $val){ 
            if(!is_numeric($key)){
                $_SESSION[$key] = $val;
            }
        }
        
        $member_data = db_select("select * from members where id = ?", array($_SESSION['kakao_id']));
        
		if($member_data != null && count($member_data) != 0){
            ?>
            <script>
                location.replace('kakao_login.php');
            </script>
            <?php
		}
		else{
            ?>
            <link rel="stylesheet" href="css/style.css">
            <main class="main_wrapper sign_up">
                <span class="join_us_title">JOIN US</span>
                <div class="join_box">
                    <form name="member_form" method="POST" action="kakao_member_insert.php" class="member_form">
                        <div class="member_form_col">
                            <div class="ref">필수입력</div>
                            <div class="member_form_row row1">
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
                    <button class="button_join" onclick="check_input()" id="join_button">가입</button>
                    <button class="button_cancel" onclick="history.back()">취소</button>
                </section>
            </main>
            <script src="js/member.js"></script>
            <?php
        } // else
        }

        catch(Exception $e){

        }
		
		// 최종 성공 처리
		$res['rst'] = 'success';

	}catch(Exception $e){
		if(!empty($e->getMessage())){ $res['msg'] = $e->getMessage(); }
		if(!empty($e->getMessage())){ $res['code'] = $e->getCode(); }
	}


	if($res['rst'] == 'success'){

	}

	else{
        
	}
	setcookie('state','',time()-3000);
	exit;
?>