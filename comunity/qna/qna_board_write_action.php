<?php
    include $_SERVER['DOCUMENT_ROOT']."/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
//각 변수에 free_board_write.php에서 title, content, userid 저장
$title = $_POST['title'];
$content = $_POST['content'];
$user = $_SESSION['userid'];

$error = $_FILES['file']['error'];
$tmpfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$folder = "./file/upload/".$filename;
$datetime = date('Y-m-d H:i:s'); // 현재 시간 구하기

// 파일 최대 용량을 초과시 에러 
if( $error != UPLOAD_ERR_OK ){
	switch( $error ) {
    		case UPLOAD_ERR_INI_SIZE:
        	case UPLOAD_ERR_FORM_SIZE:
        		echo "<script>alert('파일이 너무 큽니다.');";
            		echo "window.history.back()</script>";
            		exit;
	}
}

move_uploaded_file($tmpfile, $folder);


if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}


if($title && $content){
    $sql = mc("INSERT INTO qna_board_table(title,content,name,file,lock_post,date) VALUES('$title', '$content', '$user', '$filename', '$lo_post', '$datetime')"); 
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='qna_board.php';</script>";
}else{
    echo "<script>
    alert('제목과 내용을 확인해주세요.');
    history.back();</script>";
}
?>