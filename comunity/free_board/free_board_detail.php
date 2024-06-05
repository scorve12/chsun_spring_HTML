<?php
	    include $_SERVER['DOCUMENT_ROOT']."/header.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>자유게시판</title>
    <!-- jQuery 라이브러리 로드 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI 라이브러리 로드 -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script type="text/javascript" src="common.js"></script>
</head>
<body>
	<?php
		function is_user_logged_in() {
			// 로그인 상태를 체크
			return isset($_SESSION['userid']);
		}

		function is_user_admin() {
			return ($_SESSION['role'] == 'ADMIN');
		}
		
		// 로그인이 안 되어 있으면 경고창
		if (!is_user_logged_in()) { ?>
			<script>
            	alert("로그인이 필요한 페이지입니다.");
            	history.back(); 
        	</script>
		<?php
		}
		// 로그인한 경우 데이터 불러옴.
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/

		if (!isset($_COOKIE['hit_count_1' . $bno])) {
			setcookie('hit_count_1' . $bno, time(), time() + 3600, '/'); // 1시간 후에 쿠키 만료
			$hit = mysqli_fetch_array(mc("SELECT view FROM free_board_table WHERE idx ='".$bno."'"));
			$new_hit = $hit['view'] + 1;
			mc("UPDATE free_board_table SET view = '".$new_hit."' WHERE idx = '".$bno."'");
		}
		
		$hit = mysqli_fetch_array(mc("SELECT * from free_board_table where idx ='".$bno."'"));
		$sql = mc("SELECT * from free_board_table where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();

		if (isset($_POST['recommend'])) {
			$user_id = $_SESSION['idx'];
		
			try {
				// 이미 해당 게시물을 추천했는지 확인
				$result = mc("SELECT * FROM liked_table WHERE user_id = '$user_id' AND post_id = '$bno'");
		
				if ($result->num_rows === 0) {
					// 해당 게시물에 추천 정보 추가
					mc("INSERT INTO liked_table (user_id, post_id) VALUES ('$user_id', '$bno')");
		
					// 추천 수 증가
					$like = $board['like_count'] + 1;
					mc("UPDATE free_board_table SET like_count = '$like' WHERE idx = '$bno'");
		
					// 메시지 출력 등 원하는 작업 수행
					?>
					<script>
						alert("게시물을 추천했습니다!"); 
						history.back();
					</script> <?php
				} else { ?>
				<script>
					alert("이미 게시물을 추천했습니다!"); 
					history.back();
				</script>
				<?php
				}
			} catch (Exception $e) {
				// 예외 처리 블록: 오류 발생 시 실행되는 코드
				echo "오류가 발생했습니다: " . $e->getMessage();

			}
		}
	?>
<!-- 글 불러오기 -->
<div class="container">
        <h1><?php echo $board['title']; ?></h1>
        <div class="bulletin-details">
            <hr/>
            <br/>
            <p><strong>날짜:</strong> <?php echo $board['date']; ?></p>
            <p><strong>게시자:</strong> <?php echo $board['title']; ?></p>
            <p><?php echo nl2br($board['content']); ?></p>
        </div>
        <div class="actions">
            <button class="like-button" onclick="toggleLike()">&#x2661;</button>
            <span class="view-count">Views: <span id="view-count"><?php echo $board['view']; ?></span></span>
        </div>
        <div class="re-cancle">
            <?php
                if (is_user_admin() || $_SESSION['userid'] == $board['name']) {
                    if (!is_user_admin() && $_SESSION['userid'] == $board['name']) {
                        $has_reply = has_reply($bno);
                        if (!$has_reply) {
                            echo '<li><a href="free_board_modify.php?idx='.$board['idx'].'">수정</a></li>';
                        } else {
                            echo '<li><a href="#" onclick="showModiAlert()">수정</a></li>';
                        }
                        if ($has_reply) {
                            echo '<li><a href="#" onclick="showDelAlert()">삭제</a></li>';
                        } else {
                            echo '<li><a href="free_board_delete.php?idx='.$board['idx'].'">삭제</a></li>';
                        }
                    }
                }
            ?>
        </div>
        <div class="download-section">
            <?php if (!empty($board['file'])): ?>
                <i class="fas fa-download"></i><p class="file">첨부파일 : <a href="file/upload/<?php echo $board['file']; ?>" download><?php echo $board['file']; ?></a></p>
            <?php endif; ?>
        </div>
        <!-- 댓글 기능 -->
        <div class="reply_view">
            <h3>답변 목록</h3>
            <?php
                $sql3 = mc("SELECT * from free_board_comment_table where board_idx='$bno' ORDER BY idx DESC");
                while($reply = $sql3->fetch_array()){ 
                    $is_comment_owner = ($reply['mb_id'] == $_SESSION['userid']);
            ?>
                <div class="dap_lo">
                    <div><b><?php echo $reply['mb_id']; ?></b></div>
                    <?php if ($reply['content'] !== '삭제된 댓글입니다') { ?>
                        <div class="dap_to comt_edit"><?php echo nl2br($reply['content']); ?></div>
                        <?php if (is_user_admin() || $is_comment_owner) { ?>
                            <div class="rep_me rep_menu">
                                <ul>
                                    <li style="width: 50px;"><a class="dat_edit_bt" href="#">수정</a></li>
                                    <li><a class="dat_delete_bt" href="#">삭제</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="dap_to comt_edit">삭제된 댓글입니다</div>
                    <?php } ?>
                    <!-- 댓글 수정 폼 dialog -->
                    <div class="dat_edit">
                        <form method="post" action="free_board_comment_modify.php">
                            <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
                            <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                            <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                            <input type="submit" value="수정하기" class="re_mo_bt">
                        </form>
                    </div>
                    <!-- 댓글 삭제 비밀번호 확인 -->
                    <div class='dat_delete'>
                        <form action="free_board_comment_delete.php" method="post">
                            <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
                            <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                            <p><input type="submit" value="확인"></p>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <!-- 댓글 입력 폼 -->
            <div class="dap_ins">
                <?php if (!is_user_admin()) : ?>
                    <p>답변글은 관리자만 작성할 수 있습니다.</p>
                <?php else : ?>
                    <form action="free_board_comment_ok.php?idx=<?php echo $bno; ?>" method="post">
                        <div style="margin-top:10px;">
                            <textarea name="content" class="reply_content" id="re_content" ></textarea>
                            <button id="rep_bt" class="re_bt">댓글</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div><!--- 댓글 불러오기 끝 -->
    </div>
</body>
</html>

<style>
	.reply_view {
	width:900px;
	margin-top:100px; 
	word-break:break-all;
}
.dap_lo {
	font-size: 14px;
	padding:10px 0 15px 0;
	border-bottom: solid 1px gray;
}
.dap_to {
	margin-top:5px;
}
.rep_me {
	font-size:12px;
}
.rep_me ul li {
	float:left;
	width: 30px;
}
.dat_delete {
	display: none;
}	
.dat_edit {
	display:none;
}
.dap_sm {
	position: absolute;
	top: 10px;
}
.dap_edit_t{
	width:520px;
	height:70px;
	position: absolute;
	top: 40px;
}
.re_mo_bt {
	position: absolute;
	top:40px;
	right: 5px;
	width: 90px;
	height: 72px;
}
#re_content {
	width:700px;
	height: 56px; 
}
.dap_ins {
	margin-top:50px;
}
.re_bt {
	position: absolute;
	width:100px;
	height:56px;
	font-size:16px;
	margin-left: 10px; 
}
#foot_box {
	height: 50px; 
}

ul {
    list-style: none; /* 기본 순서 없는 목록 스타일 제거 */
    padding: 0; /* 내부 패딩 제거 */
    margin: 0; /* 외부 마진 제거 */
    display: flex; /* 요소들을 가로로 나열 */
}

li {
	margin-right: 10px;
}

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            opacity: 0; /* 초기에 숨겨진 상태 */
            animation: fadeIn 1s forwards;
        }
        .container {
            width: 60%;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff; /* 배경색 변경 */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px; /* 헤더 높이만큼 마진 추가 */
        }
        h1 {
            margin: 10px 0;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            opacity: 0; /* 초기에 숨겨진 상태 */
            animation: fadeIn 1s forwards; /* 페이드 인 애니메이션 적용 */
            animation-delay: 0.5s; /* 약간의 지연 추가 */
        }
        p {
            margin: 10px 0;
            padding: 1px;
            border-radius: 5px;
            opacity: 0; /* 초기에 숨겨진 상태 */
            animation: fadeIn 1s forwards; /* 페이드 인 애니메이션 적용 */
            animation-delay: 0.5s; /* 약간의 지연 추가 */
        }
        .bulletin-details {
            margin-top: 20px;
        }
        .bulletin-details h2 {
            margin-bottom: 10px;
        }
        .bulletin-details p {
            margin: 5px 0;
        }
        .actions {
            position: relative;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .like-button {
            padding: 10px 5px;
            background-color: transparent;
            color: red;
            border: none;
            font-size: 24px;
            cursor: pointer;
            outline: none; /* Remove button outline */
        }
        .re-cancle {
            padding: 5px 5px;
            display: flex;
            align-items: center;
        }
        .download-section {
            padding: 5px 5px;
            display: flex;
            align-items: center;
        }
        .cancle-button, .edit-button {
            padding: 5px 10px;
            font-size: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .cancle-button {
            border: 2px solid #ff0000;
            background-color: rgba(255, 255, 255, 0.5);
            color: #ff0000;
        }
        .cancle-button:hover {
            background-color: rgba(255, 0, 0, 0.7);
            color: #ffffff;
        }
        .edit-button {
            border: 2px solid #007bff;
            background-color: rgba(255, 255, 255, 0.5);
            color: #007bff;
            margin-right: 10px;
        }
        .edit-button:hover {
            background-color: rgba(0, 123, 255, 0.7);
            color: #ffffff;
        }
        .view-count {
            margin-left: 10px;
            color: #777;
        }
        .reply_view {
            width: 100%;
            margin-top: 20px;
            word-break: break-all;
        }
        .dap_lo {
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 10px;
        }
        .dap_to {
            margin-top: 5px;
        }
        .rep_me {
            font-size: 12px;
        }
        .rep_me ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        .rep_me ul li {
            margin-right: 10px;
        }
        .dat_delete {
            display: none;
        }
        .dat_edit {
            display: none;
        }
        .dap_sm {
            position: absolute;
            top: 10px;
        }
        .dap_edit_t {
            width: 100%;
            height: 70px;
        }
        .re_mo_bt {
            width: 90px;
            height: 72px;
            float: right;
            margin-top: 10px;
        }
        #re_content {
            width: 100%;
            height: 56px;
        }
        .dap_ins {
            margin-top: 50px;
        }
        .re_bt {
            width: 100px;
            height: 56px;
            font-size: 16px;
            margin-left: 10px;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes growAndShrink {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.5); }
        }
        @keyframes growAndShrink1 {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        img.grow {
            animation: growAndShrink1 0.5s ease forwards;
        }
</style>

<script>
	document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.dat_edit_bt').forEach(function(editBtn) {
            editBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const parent = editBtn.closest('.dap_lo');
                parent.querySelector('.dat_edit').style.display = 'block';
                parent.querySelector('.dat_delete').style.display = 'none';
            });
        });

        document.querySelectorAll('.dat_delete_bt').forEach(function(deleteBtn) {
            deleteBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const parent = deleteBtn.closest('.dap_lo');
                parent.querySelector('.dat_delete').style.display = 'block';
                parent.querySelector('.dat_edit').style.display = 'none';
            });
        });
    });

    function showDelAlert() {
        alert("답변글이 달린 상태이므로 삭제할 수 없습니다.");
    }
    function showModiAlert() {
        alert("답변글이 달린 상태이므로 수정할 수 없습니다.");
    }
    var liked = false;
    function toggleLike() {
        var likeButton = document.querySelector('.like-button');
        if (liked) {
            likeButton.innerHTML = '&#x2661;'; // Empty heart
        } else {
            likeButton.innerHTML = '&#x2665;'; // Filled heart
        }
        liked = !liked;
        // 애니메이션 적용
        likeButton.style.animation = 'none'; // 애니메이션을 초기화
        likeButton.offsetHeight; // Reflow 발생시켜서 애니메이션을 리셋
        likeButton.style.animation = 'growAndShrink 0.5s ease'; // 애니메이션 다시 적용
    }  
    var isGrown = false; // 이미지가 확대되었는지 추적하는 변수
    function toggleImageSize(imageId) {
        var myImage = document.getElementById(imageId);
        if (myImage.classList.contains("grow")) {
            myImage.classList.remove("grow"); // 확대 클래스 제거
        } else {
            myImage.classList.add("grow"); // 확대 클래스 추가
        }
        // 애니메이션 초기화 및 재적용을 위한 과정
        myImage.style.animation = 'none'; // 애니메이션 초기화
        myImage.offsetHeight; // Reflow 발생
        myImage.style.animation = ''; // 빈 문자열을 할당하여 CSS에서 정의된 애니메이션을 다시 적용
    }
</script>