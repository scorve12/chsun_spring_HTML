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
    <style>
        .top-right {
            position: absolute;
            top: 100px;
            right: 10px;
            font-size: 15.5px;
        }
    </style>
</head>
<body>
    <div class="top-right">
        <?php if (isset($_SESSION['userid'])): ?>
            <b><?php echo $_SESSION['userid']; ?> <?php echo $role; ?></b>님 반갑습니다.
        <?php endif; ?>
    </div>