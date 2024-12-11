<?php require_once("contents.import.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>관리자 페이지-이벤트 관리</title>
</head>

<body id="manager_body">
    <main class="manager_wrapper product">
        <div class="main_menu_wrapper">

            <a href="manager_home.php">
                <div class="menu" > 홈 </div>
            </a>
            <a href="manager_notice.php">
                <div class="menu" > 공지사항 관리 </div>
            </a>
            <a href="manager_product.php">
                <div class="menu"> 상품 관리 </div>
            </a>
            <a href="manager_event.php">
                <div class="menu" style="background-color:  rgb(74 173 255);"> 이벤트 관리 </div>
            </a>
            <a href="manager_inquiry.php">
                <div class="menu"> 고객 문의 관리 </div>
            </a>
        </div>


        <div class="main_display">
            <header>
                <div class="login_info">
                    <span class="on_id"> 접속 아이디: avbs345 </span>
                    <span class="on_dep"> 부서: 웹팀 </span>
                </div>
                <a href=""><button class="logout"> logout </button></a>
            </header>
            <section class="contents">
                <section class="contents_header">
                    <div class="event_control">
                        <span class="title">이벤트 관리</span>
                        <div class="event_co_wrapper">
                            <div class="event_co_one">
                                <div class="participate"> 참여형 </div>
                                <div class="sale_event"> 세일 행사 </div>
                            </div>
                            <div class="event_co_two">
                                <div class="event_registration"> 등록순 </div>
                                <div class="event_check"> 조회순 </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="search_event">
                    <a href="event_registration.php"><button class="regist_event"> 등록 </button></a>
                    <a href=""><button class="delete_event"> 삭제 </button></a>
                </section>
                
                <article class="scroller">
                    <form action="" method="EVENT">
                        <section class="board event">
                            <div class="table_header">
                                <div class="table_col class">카테고리</div>
                                <div class="table_col title">상품명</div>
                                <div class="table_col writer">글쓴이</div>
                                <div class="table_col views">조회수</div>
                                <div class="table_col date">날짜</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">참여</div>
                                <div class="table_col title">헌옷 기부하고 새 상품 받자!</div>
                                <div class="table_col writer">avbs345</div>
                                <div class="table_col views">3,445</div>
                                <div class="table_col date">2022-11-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">세일</div>
                                <div class="table_col title">무료 배송 이벤트</div>
                                <div class="table_col writer">gwsy296</div>
                                <div class="table_col views">3,195</div>
                                <div class="table_col date">2022-11-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">참여</div>
                                <div class="table_col title">헌옷 기부하고 새 상품 받자!</div>
                                <div class="table_col writer">wpsx27 </div>
                                <div class="table_col views">3,426</div>
                                <div class="table_col date">2022-11-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">참여</div>
                                <div class="table_col title">헌옷 기부하고 새 상품 받자!</div>
                                <div class="table_col writer">qzxpo35 </div>
                                <div class="table_col views">3,419</div>
                                <div class="table_col date">2022-11-20</div>
                            </div>
                            <div class="table_row">
                                <div class="table_col class">세일</div>
                                <div class="table_col title">무료 배송 이벤트 </div>
                                <div class="table_col writer">venex45 </div>
                                <div class="table_col views">3,174</div>
                                <div class="table_col date">2022-11-20</div>
                            </div>
                        </section>
                    </form>  
                </article>
            </section>
        </div>
    </main>
</body>

</html>