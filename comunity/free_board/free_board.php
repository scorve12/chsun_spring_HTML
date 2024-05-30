<?php
    include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/main/default.php";

    //include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/db_con.php";
    function is_user_logged_in() {
        return isset($_SESSION['userid']);
      }
      
      $sort = isset($_GET['sort']) ? $_GET['sort'] : 'idx';
      
      function get_sort_query($sort) {
        $query = "SELECT * FROM free_board_table";
      
        $query .= " ORDER BY ";
      
        if ($sort === 'view') {
          $query .= "view DESC";
        } elseif ($sort === 'like_count') {
          $query .= "like_count DESC";
        } else {
          $query .= "idx DESC";
        }
      
        return $query;
      }
      
      // 정렬된 리스트
      $sql = get_sort_query($sort);
      $result = mc($sql);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128|VT323" rel="stylesheet">
    <title>자유게시판</title>
    <!-- font, css, style 링크-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="stylesheet" href="/chsun_spring_HTML/css/styles.css">
    <link rel="stylesheet" href="/chsun_spring_HTML/css/nav.css">
    <link rel="stylesheet" href="/chsun_spring_HTML/css/footer.css">
    <link rel="stylesheet" href="/chsun_spring_HTML/css/community.css">
    <!-- jQuery 라이브러리 로드 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI 라이브러리 로드 -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
</head>

<body>
    <!-- <header id="headerWrap">
        <nav id="gnbWrap">
            <ul class="gnb">
                <li>
                    <a href="/chsun_spring_HTML/index.php"><b>원점으로</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li><a href="/chsun_spring_HTML/main/about.html">팀소개</a></li>
                            <li><a href="/chsun_spring_HTML/main/contact.html">작업물 소개</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#"><b>계산기</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li> <a href="/chsun_spring_HTML/calculator/synthesis.html">종합소득세 계산</a></li>
                            <li><a href="/chsun_spring_HTML/calculator/hourly.html">시급 계산</a></li>
                            <li><a href="/chsun_spring_HTML/calculator/retirement.html">퇴직금 계산</a></li>
                            <li><a href="/chsun_spring_HTML/calculator/salary.html">급여 계산</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#"><b>이야기 마당</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li> <a href="/chsun_spring_HTML/comunity/community.html">자유게시판</a></li>
                            <li><a href="/chsun_spring_HTML/comunity/notification.html">공지사항</a></li>
                            <li><a href="/chsun_spring_HTML/comunity/inquiry.html">문의 사항</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/chsun_spring_HTML/login/login.html"><b>로그인</b></a>
                </li>
            </ul>
        </nav>
    </header> -->
    <!--코드 작성-->
    <div id="wrap">
        <div id="board_area">
            <h1>자유게시판</h1>
            <div id="button_area">
                <button class="sort-btn" data-sortby="idx"><span>&darr;</span> 순번순</button>
                <button class="sort-btn" data-sortby="view"><span>&darr;</span> 조회순</button>
                <button class="sort-btn" data-sortby="like_count"><span>&darr;</span> 추천순</button>
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th width="70">번호</th>
                        <th width="500">제목</th>
                        <th width="120">글쓴이</th>
                        <th width="100">조회수</th>
                        <th width="100">추천</th>
                        <?php echo $_SERVER['DOCUMENT_ROOT']?> 
                    </tr>
                </thead>
                <!--<?php
                  while ($board = $result->fetch_array()) {
                    $title = $board["title"];
                    if (strlen($title) > 30) {
                      $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                    }
              ?>-->
                <tbody>
                    <tr class="list_board">
                        <td width="70">
                            <?php echo $board['idx']; ?>
                        </td>
                        <td width="500"><a href="free_board_detail.php?idx=<?php echo $board["idx"];?>">
                                <?php echo $title;?>
                            </a></td>
                        <td width="120">
                            <?php echo $board['name']?>
                        </td>
                        <td width="100">
                            <?php echo $board['view']; ?>
                        </td>
                        <td width="100">
                            <?php echo $board['like_count']; ?>
                        </td>
                    </tr>
                </tbody>
                <!--<?php } ?>-->
            </table>
            <div id="write_btn">
                <!--<?php
            if (is_user_logged_in()) {
              ?>-->
                <a href="free_board_write.php"><button>글쓰기</button></a>
                <?php } ?>
            </div>
        </div>
        <div id="search_box">
            <form action="free_board_search.php" method="get">
                <select name="search_option">
                    <option value="title">제목</option>
                    <option value="name">작성자</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" /> <button>검색</button>
            </form>
        </div>
    </div>

    <!--코드 작성-->
    <footer>
        <div class="contact-info">
            <p>(61452)광주광역시 동구 필문대로 309(서석동, 조선대학교)</p>
            <p>TEL. 062-230-6046 FAX. 062-232-0504</p>
        </div>
        <div class="team-info">
            <p>개발 : 조선의 봄</p>
            <p>과제 : 자율설계학기제</p>
            <p>마감 : 6월 8일</p>
        </div>
    </footer>


</body>

<script>
    document.querySelectorAll('.gnb > li').forEach(li => {
        const subMenu = li.querySelector('.sub-wrap');
        if (subMenu) {
            li.addEventListener('mouseover', () => subMenu.classList.add('active'));
            li.addEventListener('mouseleave', () => subMenu.classList.remove('active'));
        }
    });
</script>