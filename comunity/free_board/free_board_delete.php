<?php
	    include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/header.php";
		include $_SERVER['DOCUMENT_ROOT']."/chsun_spring_HTML/main/default.php";
	$bno = $_GET['idx'];
	$sql = mc("DELETE from free_board_table where idx='$bno';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/chsun_spring_HTML/comunity/free_board/free_board.php" />