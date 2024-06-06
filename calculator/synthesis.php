<?php

    //include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
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
    <link rel="stylesheet" href="/css/calculator.css">
    <link rel="stylesheet" href="/css/styles.css">

    <link
    href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
    rel="stylesheet"
  />
  <link href="../css/bootstrap.css" rel="stylesheet" />
  <script
    src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
    crossorigin="anonymous"
  ></script>


</head>

<body>
    <div id="wrap">
        <!-- VAT Calculation Form (Total Sum) -->

        <div id="layoutSidenav_content">
            <main>
                <div id="calculatorBackground">
                    <div class="gap"></div>
                    <div id="calculatorSize">
                        <br />
                        <!-- 계산기 선택 -->
                        <div id="calculatorSelect">
                            <div class="col-2 imgUp">
                                <div id="s-totalTax" class="box1" alt="종합소득세"></div>
                                <div>종합소득세</div>
                            </div>

                            <div class="col-2 imgUp">
                                <div id="s-simpleTax" class="box2" alt="간이과세"></div>
                                <div>간이과세</div>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <div class="view-bx">
                            <div id="inputBox">
                            </div>
                            <div class="buttonAdjustment">
                                <!--초기화 버튼-->
                                <button type="button" class="resetButton">초기화</button>
                                <!--계산 버튼-->
                                <button type="button" class="calculoatrButton">계산</button>
                            </div>
                            <!--계산결과-->
                            <br />
                            <br />
                            <div id="calculaotrResult">
                                <div id="resultBox">

                                </div>
                                <hr>
                                <div id="resultPrint"><i class="fa-solid fa-print"></i>&nbsp;계산결과 프린트</div>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
                </div>
        </div>
        </main>
    </div>
    <script src="./synthesis.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
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

</html>