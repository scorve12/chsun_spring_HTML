<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/header.php";

// 데이터베이스 연결 정보
// $db_host = "localhost";
// $db_id = "padmin";
// $db_pw = "0914kk";
// $db_name = "hacker_test";
// $connect=mysqli_connect($db_host, $db_id, $db/home/kang/project/db_con.php_pw, $db_name);

$id = $_POST['id'];
$pw = $_POST['pw'];

// 아이디가 있는지 검사
$query = "SELECT * FROM member_table WHERE mb_id='$id'";
$result = mc($query);

// 쿼리 실행 오류 확인
if (!$result) {
    die("쿼리 실행 실패: " . mysqli_error($connect));
}

// 아이디가 있다면 비밀번호 검사
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // 비밀번호가 맞다면 세션 생성
    if (password_verify($pw, $row['mb_pw']) && ($_POST['captcha'] === $_SESSION['str'])) {    
        $_SESSION['userid'] = $row['mb_id'];
        $_SESSION['role'] = $row["role"];
        $_SESSION['idx'] = $row["seq"];
        if (isset($_SESSION['userid'])) {
            echo "<script>location.replace('/index.php');</script>";
        } else {
            echo "session failed";
        }
    } else {
        echo "<script>
            alert('아이디 또는 비밀번호를 확인해주세요.');
            history.back(); //js 이 전페이지(login.php)로 돌아가기
        </script>";
    }
} else {
    echo "<script>
        alert('아이디 또는 비밀번호를 확인해주세요.');
        history.back(); //js 이 전페이지(login.php)로 돌아가기
    </script>";
}
?>
