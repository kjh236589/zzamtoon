<?php require_once("contents.import.php");?>
<?php require_once("inc/session.php");?>
<?php
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $birth = $_POST["birth"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];       
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");
    if($pass1 != null){
        if($pass1 == $pass2){
            $bcrypt_pw = password_hash($pass1, PASSWORD_BCRYPT);
            if(isset($_FILES[ 'photo' ])){
                $uploaded_file_name_tmp = $_FILES[ 'photo' ][ 'tmp_name' ];
                $uploaded_file_name = $_SESSION['member_id'];
                $upload_folder = "img/user/";
                $photo = $upload_folder.$uploaded_file_name;
                $sql = "UPDATE members SET pass='$bcrypt_pw', name='$name', phone='$phone',birth='$birth',email1='$email1', email2='$email2', user_img='$photo' WHERE id='$_SESSION[member_id]'";
                mysqli_query($con, $sql);
                move_uploaded_file( $uploaded_file_name_tmp, $upload_folder . $uploaded_file_name );
            }else{
                $sql = "UPDATE members SET pass='$bcrypt_pw', name='$name', phone='$phone',birth='$birth',email1='$email1', email2='$email2' WHERE id='$_SESSION[member_id]'";
                mysqli_query($con, $sql);
            }
        }
        else{
            echo "
            <script>
                history.back();
            </script>";
        }
    }
    else{
        if(isset($_FILES[ 'photo' ])){
            $uploaded_file_name_tmp = $_FILES[ 'photo' ][ 'tmp_name' ];
            $uploaded_file_name = $_SESSION['member_id'];
            $upload_folder = "img/user/";
            $photo = $upload_folder.$uploaded_file_name;
            $sql = "UPDATE members SET name='$name', phone='$phone',birth='$birth',email1='$email1', email2='$email2', user_img='$photo' WHERE id='$_SESSION[member_id]'";
            mysqli_query($con, $sql);
            move_uploaded_file( $uploaded_file_name_tmp, $upload_folder . $uploaded_file_name );
        }else{
            $sql = "UPDATE members SET name='$name', phone='$phone',birth='$birth',email1='$email1', email2='$email2' WHERE id='$_SESSION[member_id]'";
            mysqli_query($con, $sql);
        }
    }
    mysqli_close($con);    

    echo "
        <script>
            location.href = 'index.php';
        </script>"; 
?>
