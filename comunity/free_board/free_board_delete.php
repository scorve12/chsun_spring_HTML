<?php
	    include $_SERVER['DOCUMENT_ROOT']."/header.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
	$bno = $_GET['idx'];
	$sql = mc("DELETE from free_board_table where idx='$bno';");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/comunity/free_board/free_board.php" />