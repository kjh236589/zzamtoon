<?php
    require_once("inc/db.php");
    if(!$_POST["id"]){
        ?>
        <script>
            alert("아이디를 입력해주세요.");
            //history.back();
        </script>
        <?php
        return;
    }
    $id   = $_POST["id"];
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");

    
	$member = db_select("select * from members where id= ?", array("$id"));
    if(isset($member[0]) == true){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $pass = '';
        for ($i = 0; $i < 8; $i++) {
            $pass .= $characters[rand(0, $charactersLength - 1)];
        }
        $pw = password_hash($pass, PASSWORD_BCRYPT);
    
        $sql = "UPDATE members SET pass='$pw' WHERE id='$id'";
        mysqli_query($con, $sql);
        mysqli_close($con);

        ?>
                <script>
                    alert("저장된 이메일로 변경된 비밀번호가 발송됐습니다!\n확인 후 로그인 해주세요.");
                    location.replace('login.php');
                </script>
        <?php
                    include "PHPMailer.php";
                    include "SMTP.php";

                    $mail = new PHPMailer();

                    try {
                        $mail->CharSet    = "UTF-8";
                        $mail->Encoding   = "base64";
                        //한글 깨짐 해결
                    } catch (Exception $e) {
                        echo $e->getMessage();

                    }

                    $mail->isSMTP();

                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                    //Set the hostname of the mail server
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                    $mail->SMTPAuth = true;

                    $mail->Username = 'kjh236589@gmail.com';

                    $mail->Password = 'olwi pjqy apsc ovwc';

                    $mail->setFrom('kjh236589@gmail.com', '짬툰');

                    $mail->addReplyTo('kjh236589@gmail.com', '짬툰');

                    $mail->addAddress($member[0]['email1'].'@'.$member[0]['email2'], '김정환');

                    $mail->Subject = '변경된 비밀번호입니다.';
                    $mail->Body = $pass;


                    if (!$mail->send()) {
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Message sent!';
                    }

                    function save_mail($mail)
                    {
                        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

                        $imapStream = imap_open($path, $mail->Username, $mail->Password);

                        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                        imap_close($imapStream);

                        return $result;
                    }
    }
?>
        <script>
            alert("해당하는 회원이 없습니다.\n입력된 정보를 다시 확인해주세요.");
            history.back();
        </script>