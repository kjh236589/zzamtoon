<?php 
require_once("session.php");
?>
<script>
    function toggleMenu() {
        const menuContent = document.querySelector('.hamburger_menu_content');
        menuContent.classList.toggle('active'); // 메뉴 열기/닫기 토글

        // 애니메이션 효과를 추가합니다.
        if (menuContent.classList.contains('active')) {
            menuContent.style.display = 'block';
        } else {
            menuContent.style.display = 'none';
        }
    }
</script>
<div id="header_wrapper">
    <header>
        
        <div class="main_nav">
            <a href="index.php" class="logo_link_index">
                <div class="logo_wrapper">
                    <span class="logo">ZZAM TOON</span>
                </div>
            </a>
            <div class="sub_nav">
                <!-- 검색창 -->
                <form method="GET" action="search.php?" class="serch_nav">
                    <div class="search_wrapper">
                        <fieldset class="field-container">
                            <input type="text" placeholder="Search..." class="field" name="search" require/>
                            <button class="point">
                                <div class="icons-container">
                                    <div class="icon-search"></div>
                                </div>
                            </button>
                        </fieldset>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['member_id']) === false){
                ?>
                <div class="login_nav">
                    <div class="login_font">
                    <a href="login.php"><span>로그인</span></a>
                    </div>
                </div>
                <a href="login.php">
                    <div class="like_nav">
                        <i class="far fa-heart fa-1x"></i>
                    </div>
                </a>
                <a href="login.php">
                    <div class="user_icon">
                        <img src="img/user/default_user.png" alt=""/>
                    </div>
                </a>
                <?php
                }else{
                    $member_data = db_select("select * from members where id = ?", array($_SESSION['member_id']));
                ?>
                <div class="logout_nav">
                    <div class="logout_font">
                    <a href="logout.php"><span>로그아웃</span></a>
                    </div>
                </div>
                <a href="liketoon.php?popularity=view">
                    <div class="like_nav">
                        <i class="far fa-heart fa-1x"></i>
                    </div>
                </a>
                <a href="my-page_member_pwd.php">
                    <div class="user_icon">
                        <img src=<?php print_r($member_data[0]["user_img"])?> alt=""/>
                    </div>
                </a>
                <?php
                }
                ?>
            </div>

            <div class="hamburger_menu">
                <button class="hamburger_btn" onclick="toggleMenu()">
                    <a class="fas fa-bars" style="font-size:52px;color:pink"></a>
                </button>
                <div class="hamburger_menu_content">
                    <!-- X 버튼 추가 -->
                    <button class="close_btn" onclick="toggleMenu()">×</button>
                    
                    <!-- 검색창 -->
                    <form method="GET" action="search.php?" class="serch_nav">
                        <div class="search_wrapper">
                            <fieldset class="field-container">
                                <input type="text" placeholder="Search..." class="field" name="search" required />
                                <button class="point">
                                    <div class="icons-container">
                                        <div class="icon-search"></div>
                                    </div>
                                </button>
                            </fieldset>
                        </div>
                    </form>
                    
                    <!-- 나머지 항목들 (로그인, 즐겨찾기, 사용자 아이콘 등) -->
                    <div class="menu_items">
                    <?php
                        if (isset($_SESSION['member_id']) === false){
                        ?>
                        <div class="login_nav">
                            <div class="login_font">
                            <a href="login.php"><span>로그인</span></a>
                            </div>
                        </div>
                        <a href="login.php">
                            <div class="like_nav">
                                <i class="far fa-heart fa-1x"></i>
                            </div>
                        </a>
                        <a href="login.php">
                            <div class="user_icon">
                                <img src="img/user/default_user.png" alt=""/>
                            </div>
                        </a>
                        <?php
                        }else{
                            $member_data = db_select("select * from members where id = ?", array($_SESSION['member_id']));
                        ?>
                        <div class="logout_nav">
                            <div class="logout_font">
                            <a href="logout.php"><span>로그아웃</span></a>
                            </div>
                        </div>
                        <a href="liketoon.php?popularity=view">
                            <div class="like_nav">
                                <i class="far fa-heart fa-1x"></i>
                            </div>
                        </a>
                        <a href="my-page_member_pwd.php">
                            <div class="user_icon">
                                <img src=<?php print_r($member_data[0]["user_img"])?> alt=""/>
                            </div>
                        </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="menu_wrapper">
            <ul class="main_menu_bar">
                <div class="menu_bar_left">
                    <li class="yoil_menu"><a href="index.php">요일별</a></li>
                    <li class="today_menu"><a href="index.php">오늘의 웹툰</a></li>
                    <li class="main_menu02"><a href="popularity.php?popularity=view">인기</a></li>
                    <li class="main_menu03"><a href="newtoon.php">신규</a></li>
                    <li class="main_menu04"><a href="toonend.php?popularity=view">완결</a></li>
                    <li class="main_menu04"><a href="usertoon.php?popularity=view">유저툰</a></li>
                    <?php
                    if (isset($_SESSION['member_id']) === true)
                    {
                        if($_SESSION['member_id'] == "admin")
                        {
                    ?>
                        <li class="yoil_menu"><a href="toonupload.php">등록</a></li>
                    <?php
                        }
                        else
                        {
                    ?>
                    <li class="yoil_menu"><a href="usertoonupload.php">유저툰 등록</a></li>
                    <?php
                        }
                    }
                    ?>
                </div>
            </ul>
        </div>

        <div class="menu_wrapper">
            <ul class="sub_menu_bar">
                <div class="sub_bar_left">
                    <li class="yoil_menu"><a href="index.php">요일전체</a></li>
                    <li class="sub_menu1"><a href="week.php?week=0&popularity=view">월</a></li>
                    <li class="sub_menu2"><a href="week.php?week=1&popularity=view">화</a></li>
                    <li class="sub_menu3"><a href="week.php?week=2&popularity=view">수</a></li>
                    <li class="sub_menu4"><a href="week.php?week=3&popularity=view">목</a></li>
                    <li class="sub_menu5"><a href="week.php?week=4&popularity=view">금</a></li>
                    <li class="sub_menu6"><a href="week.php?week=5&popularity=view">토</a></li>
                    <li class="sub_menu7"><a href="week.php?week=6&popularity=view">일</a></li>
                </div>
            </ul>
        </div>
        
    </header>
</div>
