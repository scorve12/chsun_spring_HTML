<?php
    include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
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


    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/contact.css">
</head>

<body>
    <main>
        <div id="sidebar">
            <ul class="progress-bar">
                <li><a class="progress-btn" href="#section1">소개</a></li>
                <li><a class="progress-btn" href="#section2">계산기</a></li>
                <li><a class="progress-btn" href="#section3">게시판</a></li>
                <li><a class="progress-btn" href="#section4">로그인</a></li>
            </ul>
        </div>

        <div class="content">
            <div id="section1" class="section">
                <h2>자율설계학기제</h2>
                <img src="../img/2024년 1학기 자율설계학기제.jpg">
                <ul style="text-align: ceter;">
                    <li>계획 : 개인사업자를 위한 사이트 배포</li>
                    <li>[2024년 1학기 중]</li>
                </ul>
                <p>학생 개인 또는 팀이 수행할 과제를 스스로 설계하고 과제활동 수행하는 활동입니다. 5명의 팀워과 가각 백엔드, 프론트엔드, 비즈니스로 역할을 나누었습니다.
                    <br><br>
                    <p>실무에 필요한 기술을 습득하며 프로젝트의 경험을 얻는 것을 목표로 합니다.</p>
                    <br><br>
                </p>
                <hr>
            </div>
            <div id="section2" class="section">
                <h2>계산기</h2>
                <img src="../img/계산기.png">
                <p>부가가치세, 주휴수당, 시급계산, 급여계산기, 4대보험 계산 퇴직금 계산 등의 기능으로 가편하게 간이세금이 가능합니다.</p>
                <br>
                <hr>
            </div>
            <div id="section3" class="section">
                <h2>게시판</h2>
                <img src="../img/게시판.png">
                <p>CRUD구조의 게시판입니다. 작성, 읽기, 수정, 삭제, 작성자, 비밀글 기능 또한 포함 되어 있습니다.</p>
                <br>
                <hr>
            </div>
            <div id="section4" class="section">
                <h2>로그인</h2>
                <img src="../img/로그인.png">
                <p>세션방식의 인증과 '관리자', '일반사용자'를 구분하는 권한 또한 구현되어 있습니다.</p>
                <br><br>
                <p>이메일, 2차인증으로 보안되어 있습니다.</p>
            </div>
        </div>
    </main>


</body>

<script>
    document.querySelectorAll('.gnb > li').forEach(li => {
        const subMenu = li.querySelector('.sub-wrap');
        if (subMenu) {
            li.addEventListener('mouseover', () => subMenu.classList.add('active'));
            li.addEventListener('mouseleave', () => subMenu.classList.remove('active'));
        }
    });
    gsap.utils.toArray(".section").forEach((section, i) => {
        gsap.to(section, {
            scrollTrigger: {
                trigger: section,
                start: "top 70%",
                end: "bottom 70%",
                toggleClass: {
                    targets: gsap.utils.toArray(".progress-bar > li")[i],
                    className: "active"
                }
            }
        });
    });
</script>