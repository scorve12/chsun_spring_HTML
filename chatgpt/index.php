<?php
include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128|VT323" rel="stylesheet">
    <title>당백전_개인사업자를 위한 사이트</title>
    <!-- font, css, style 링크-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <main>
        <div class="chat-container">
            <div id="chat-output" class="chat-output"></div>
            <form id="chat-form" class="chat-input-form">
                <input type="text" id="chat-input" class="chat-input" placeholder="Type your message here"
                    autocomplete="off">
                <button type="submit" class="chat-submit">Send</button>
            </form>
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
</script>

</html>