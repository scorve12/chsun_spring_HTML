<!-- header.php -->
<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/db_con.php";
    include $_SERVER['DOCUMENT_ROOT']."/config.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <style>
        .top-right {
            position: absolute;
            top: 100px;
            right: 10px;
            font-size: 19.5px;
        }

        .jua-regular {
        font-family: "Jua", sans-serif;
        font-weight: 500;
        font-style: normal;
        }
    </style>
</head>
<body>
    <div class="top-right jua-regular">
        <?php if (isset($_SESSION['userid'])): ?>
            <b><?php echo $_SESSION['userid']; ?> <?php echo $role; ?></b>님 반갑습니다.
        <?php endif; ?>
    </div>
