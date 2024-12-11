<?php require_once("contents.import.php");?>
<?php require_once("inc/session.php");?>
<?php
    $nickname = $_POST["nickname"];    
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");
    if(isset($_FILES["photo"])){
        $uploaded_file_name_tmp = $_FILES[ 'photo' ][ 'tmp_name' ];
        $uploaded_file_name = $_SESSION['member_id'];
        $upload_folder = "img/user/";
        $photo = $upload_folder.$uploaded_file_name;
        $sql = "UPDATE members SET nickname='$nickname', user_img='$photo' WHERE id='$_SESSION[member_id]'";
        mysqli_query($con, $sql);
        move_uploaded_file( $uploaded_file_name_tmp, $upload_folder . $uploaded_file_name );
    }else{
        $sql = "UPDATE members SET nickname='$nickname' WHERE id='$_SESSION[member_id]'";
        mysqli_query($con, $sql);
    }
    mysqli_close($con);
    echo "
        <script>
            location.href = 'index.php';
        </script>"; 
?>
