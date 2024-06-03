
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
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <header id="headerWrap">
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
                            <li><a href="/calculator/synthesis.html">종합소득세 계산</a></li>
                            <li><a href="/calculator/wiki.html">금융상식</a></li>
                            <li><a href="/calculator/salary.html">직원 계산기</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#"><b>이야기 마당</b></a>
                    <div class="sub-wrap">
                        <ul>
                            <li><a href="/comunity/free_board/free_board.php">자유게시판</a></li>
                            <li><a href="/comunity/inform/inform_board.php">공지사항</a></li>
                            <li><a href="/comunity/qna/qna_board.php">문의 사항</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <?php if (isset($_SESSION['userid'])): ?>
                        <a href="/login/logout_action.php" >로그아웃</a>
                    <?php else: ?>
                        <a href="/login/login.php"><b>로그인</b></a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>
    <!--코드 작성-->
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

    <?php if (isset($_SESSION['userid'])): ?>
        <button class="fixed-button">
        &#128100;
    </button>
    <?php endif; ?>

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

<script>
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

<style>
    .fixed-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #333;
    color: white;
    font-size: 24px;
    border: none;
    border-radius: 50%;
    padding: 10px;
    cursor: pointer;
    z-index: 1000;
}
</style>