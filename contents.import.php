<?php

require_once("inc/db.php");

$result =db_select("select * from contents");

$result_price_H = db_select("SELECT * FROM contents ORDER BY content_views DESC"); //높은가격순
$result_price_L = db_select("SELECT * FROM contents ORDER BY content_rating DESC"); //낮은가격순
?>