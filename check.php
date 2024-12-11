<?php
    $con = mysqli_connect("localhost", "root", "1234", "webtoon");
    $uid= $_GET["userid"];
    $sql= "SELECT * FROM members where id='$uid'";
    $result = mysqli_fetch_array(mysqli_query($con, $sql));

    if(!$result){
        echo("<script>opener.parent.yes()</script>");
        echo("<script>self.close()</script>");
    } else {
        echo("<script>opener.parent.no()</script>");
        echo("<script>self.close()</script>");
    }

?>