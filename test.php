<?php
session_start(); // 세션 시작

echo print_r($_SESSION);
// 세션의 모든 값을 출력
echo "<hr/>";

echo var_dump($_SESSION);

echo "<hr/>";

echo $_SESSION['id'];

echo "<hr/>";

echo $_SESSION['nickname'];

echo "<hr/>";

echo $_SESSION['profile_image'];


echo "<hr/>";

// 배열내 특정 값 뽑아내는 방법
echo $_SESSION['kakao_account']->email;
?>