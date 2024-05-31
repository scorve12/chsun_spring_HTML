<?php
    include $_SERVER['DOCUMENT_ROOT']."/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/main/default.php";

    $is_user = ($_SESSION['userid'] && ($_SESSION['role'] == 'USER'));

      
    function is_user_admin() {
      return ($_SESSION['role'] == 'ADMIN');
  }
    
    // 정렬
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'idx';
    
    // sql 정렬
    function get_sort_query($sort) {
      $query = "SELECT * FROM qna_board_table";
    
      $query .= " ORDER BY ";
    
      if ($sort === 'view') {
        $query .= "view DESC";
      } else {
        $query .= "idx DESC";
      }
    
      return $query;
    }
    
    $sql = get_sort_query($sort);
    $result = mc($sql);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128|VT323" rel="stylesheet">
    <title>당백전_개인사업자를 위한 사이트</title>
    <!-- font, css, style 링크-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <!-- <header id="headerWrap">
        <nav id="gnbWrap">
            <ul class="gnb">
                <li>
                    <a href="/index.php"><b>원점으로</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li><a href="/main/about.html">팀소개</a></li>
                            <li><a href="/main/contact.html">작업물 소개</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#"><b>계산기</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li> <a href="/calculator/synthesis.html">종합소득세 계산</a></li>
                            <li><a href="/calculator/hourly.html">시급 계산</a></li>
                            <li><a href="/calculator/retirement.html">퇴직금 계산</a></li>
                            <li><a href="/calculator/salary.html">급여 계산</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#"><b>이야기 마당</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li> <a href="/comunity/community.html">자유게시판</a></li>
                            <li><a href="/comunity/notification.html">공지사항</a></li>
                            <li><a href="/comunity/inquiry.html">문의 사항</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/login/login.html"><b>로그인</b></a>
                </li>
            </ul>
        </nav>
    </header> -->
    <!--코드 작성-->
    <!--코드 작성-->
    <div id="board_area"> 
  <h1>QnA</h1>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
            while ($board = $result->fetch_array()) {
              $title = $board["title"];
              if (strlen($title) > 30) {
                $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
              }
        ?>
      <tbody>
        <tr class="list_board">
          <td width="70"><?php echo $board['idx']; ?></td> 
          <td width="500"><?php 
        $lockimg = "<img src='/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
        if($board['lock_post']=="1")
          { ?><?php echo $lockimg;
           }?><a href="qna_board_detail.php?idx=<?php echo $board["idx"];?>"><?php echo $title; ?></a></td>
          <td width="120"><?php echo $board['name']?></td>
          <td width="100"><?php echo $board['view']; ?></td>
        </tr>
      </tbody>
      <?php } ?>
    </table>
    <?php
      if ($is_user) {
        ?>
    <div id="write_btn">
      <a href="qna_board_write.php"><button>글쓰기</button></a>
    </div> <?php } ?>
  </div>
  <div id="search_box">
    <form action="qna_board_search.php" method="get">
      <select name="search_option">
        <option value="title">제목</option>
        <option value="name">작성자</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required" /> <button>검색</button>
    </form>
    </div>
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

    $(document).ready(function() {
  var currentSortBy = "idx"; // 기본 정렬 기준은 "순번순"
  var currentSortDir = "desc"; // 기본 정렬 방식은 내림차순

  $(".sort-btn").click(function() {
    var sortBy = $(this).data("sortby");

    // 정렬 기준이 변경되었을 경우, 정렬 방식을 초기화하고 오름차순으로 변경
    if (currentSortBy !== sortBy) {
      currentSortBy = sortBy;
      currentSortDir = "asc";
    } else {
      // 정렬 기준이 이미 선택된 경우, 정렬 방식을 토글
      currentSortDir = currentSortDir === "asc" ? "desc" : "asc";
    }

    // 정렬 방식에 따라 화살표 모양 변경
    $(".sort-btn").find("span").html("&darr;");
    if (currentSortDir === "asc") {
      $(this).find("span").html("&uarr;");
    } else {
      $(this).find("span").html("&darr;");
    }

    // Redirect to the sorted URL
    window.location.href = "inform_board.php?sort=" + currentSortBy + "&sortdir=" + currentSortDir;
  });
});

</script>