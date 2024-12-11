<?php
require_once("inc/db.php");
require_once("inc/session.php");
 
define('NAVER_CLIENT_ID', 'E_blvpeac_wZtLrt5jrd');
define('NAVER_CLIENT_SECRET', 'Tnx8LiNTmy');
define('NAVER_CALLBACK_URL', 'http://localhost:8080/zzamtoon/naveroauth.php');
 
 
$naver_curl = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".NAVER_CLIENT_ID."&client_secret=".NAVER_CLIENT_SECRET."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&code=".$_GET['code'];
 
// 토큰값 가져오기
$is_post = false;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $naver_curl); 
curl_setopt($ch, CURLOPT_POST, $is_post); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 
$response = curl_exec ($ch); 
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close ($ch); 
 
if($status_code == 200){ 
    $responseArr = json_decode($response, true); 
 
      // 토큰값으로 네이버 회원정보 가져오기 
      $headers = array( 'Content-Type: application/json', sprintf('Authorization: Bearer %s', $responseArr['access_token']) ); 
      $is_post = false; 
      $me_ch = curl_init(); 
      curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me"); 
      curl_setopt($me_ch, CURLOPT_POST, $is_post ); 
      curl_setopt($me_ch, CURLOPT_HTTPHEADER, $headers); 
      curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true); 
      $res = curl_exec ($me_ch); 
      curl_close ($me_ch); 
      $res_data = json_decode($res , true); 
       
 
    /*
    {
      "resultcode": "00",
      "message": "success",
      "response": {
        "email": "openapi@naver.com",
        "nickname": "OpenAPI",
        "profile_image": "https://ssl.pstatic.net/static/pwe/address/nodata_33x33.gif",
        "age": "40-49",
        "gender": "F",
        "id": "32742776",
        "name": "오픈 API",
        "birthday": "10-01"
      }
    }
    */
 
      if ($res_data ['response']['id']) { 
      //해당 아이디값을 정상적으로 가져온다면 디비에 해당 아이디로 회원가입 여부 확인 하여 회원 가입을 하였으면 자동 로그인 구현.
 
            $_SESSION['naver_id'] = $res_data ['response']['id'];
            $_SESSION['naver_name']        = $res_data ['response']['name'];
            $_SESSION['profile_image']    = $res_data ['response']['profile_image'];
            $_SESSION['naver_nickname']    = $res_data ['response']['nickname'];
            $member_data = db_select("select * from members where id = ?", array($_SESSION['naver_id']));
            
            if($member_data != null && count($member_data) != 0){
                ?>
                <script>
                    location.replace('naver_login.php');
                </script>
                <?php
            }
            else {
                $_SESSION['naver_mobile']    = $res_data ['response']['mobile'];
                $_SESSION['naver_birth'] = $res_data ['response']['birthyear']."-".$res_data ['response']['birthday'];
                $email_array = explode("@", $res_data ['response']['email']);
                $_SESSION['naver_email1']    = $email_array[0];
                $_SESSION['naver_email2']    = $email_array[1];
                ?>
                <script>
                    location.replace('naver_member_insert.php');
                </script>
                <?php
            }
        
 
      }
}
?>
