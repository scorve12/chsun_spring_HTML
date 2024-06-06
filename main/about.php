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
    <link rel="stylesheet" href="/css/about.css">
</head>

<body>
        <!--코드 작성-->
        <div class='warp'>
            <!--맴버 카드-->
            <div class='card'>
                <img src='/img/김재호.jpg' class='card__img'>
                <div class='card__content'>
                    <h3 class='card__name'>김재호</h3>
                    <h4 class='card__position'>PM</h4>
                 </div>
            </div>
        
            <div class='card'>
                <img src='/img/강연준.jpg' class='card__img'>
                <div class='card__content'>
                    <h3 class='card__name'>강연준</h3>
                    <h4 class='card__position'>Back-End</h4>
                 </div>
            </div>
        
            <div class='card'>
                <img height = 360px width="270px" src='/img/최종빈.jpg' class='card__img'>
                <div class='card__content'>
                    <h3 class='card__name'>최종빈</h3>
                    <h4 class='card__position'>Front-End</h4>
                 </div>
            </div>
        
            <div class='card'>
                <img  src='/img/나우진.jpg' class='card__img'>
                <div class='card__content'>
                    <h3 class='card__name'>나우진</h3>
                    <h4 class='card__position'>Business</h4>
                 </div>
            </div>
        
            <div class='card'>
                <img src='/img/이도현.jpg' class='card__img'>
                <div class='card__content'>
                    <h3 class='card__name'>이도현</h3>
                    <h4 class='card__position'>Front-End</h4>
                 </div>
            </div>
        </div>
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