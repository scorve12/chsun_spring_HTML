<?php
    include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/main/default.php";
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


    <link rel="stylesheet" href="/chsun_spring_HTML/css/styles.css">
    <link rel="stylesheet" href="/chsun_spring_HTML/css/nav.css">
    <link rel="stylesheet" href="/chsun_spring_HTML/css/footer.css">
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