<?php
	    include $_SERVER['DOCUMENT_ROOT']."/header.php";
		include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>공지사항</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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


		// 로그인한 경우 데이터 불러옴.
		$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/

		if (!isset($_COOKIE['hit_count_2' . $bno])) {
			setcookie('hit_count_2' . $bno, time(), time() + 3600, '/'); // 1시간 후에 쿠키 만료
			$hit = mysqli_fetch_array(mc("SELECT view FROM inform_board_table WHERE idx ='".$bno."'"));
			$new_hit = $hit['view'] + 1;
			mc("UPDATE inform_board_table SET view = '".$new_hit."' WHERE idx = '".$bno."'");
		}
		$hit = mysqli_fetch_array(mc("SELECT * from inform_board_table where idx ='".$bno."'"));
		$sql = mc("SELECT * from inform_board_table where idx='".$bno."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
		?>

		<div class="container">
        <h1><?php echo $board['title']; ?></h1>
        <div class="bulletin-details">
            <hr/>
            <br/>
            <p><strong>날짜:</strong> 4 26, 2024</p>
            <p><strong>게시자:</strong> <?php echo $board['title']; ?></p>
            <p><?php echo nl2br("$board[content]"); ?></p>
        </div>
        <div class="actions">
            <button class="like-button" onclick="toggleLike()">&#x2661;</button>
            <span class="view-count">Views: <span id="view-count"><?php echo $board['view']; ?></span></span>
        </div>
        <div class="re-cancle">
		<?php
				// 로그인한 사용자만 게시물을 읽을 수 있도록 체크
				if (is_user_admin()) {
					// 일반 사용자인 경우
					if ($_SESSION['userid'] == $board['name']) { ?>
						<!-- 일반유저인 경우 자신글에 대한 수정, 삭제 가능 -->
						<li><a href="inform_board_modify.php?idx=<?php echo $board['idx']; ?>">수정</a></li>
						<li><a href="inform_board_delete.php?idx=<?php echo $board['idx']; ?>">삭제</a></li>
					</ul><?php
				}
            }
			?>
        </div>
        <div class="download-section">
		<?php if (!empty($board['file'])): ?>
			<i class="fas fa-download"></i><p class="file">첨부파일 : <a href="file/upload/<?=$board['file'];?>" download><?=$board['file'];?></a></p>
			<?php endif; ?>

            
        </div>
    </div>

    <script>
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
        // 이미지가 확대된 상태일 때, 크기를 원래대로 돌립니다.
                myImage.classList.remove("grow"); // 확대 클래스 제거
            } else {
        // 이미지가 원래 크기일 때, 확대합니다.
                myImage.classList.add("grow"); // 확대 클래스 추가
            }

    // 애니메이션 초기화 및 재적용을 위한 과정
            myImage.style.animation = 'none'; // 애니메이션 초기화
            myImage.offsetHeight; // Reflow 발생
             myImage.style.animation = ''; // 빈 문자열을 할당하여 CSS에서 정의된 애니메이션을 다시 적용
        }




    </script>
</body>
</html>

<style>
        #editImage {
            position: relative;
            z-index: 2; /* `editImage`가 더 위에 오도록 높은 값을 설정 */
        }
        #cancleImage {
            position: relative;
            z-index: 1; /* `cancleImage`를 뒤로 보내기 위해 낮은 값을 설정 */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            opacity: 0; /* 초기에 숨겨진 상태 */
            animation: fadeIn 1s forwards;
        }
        .container {
            height: 50%;
            width: 60%;
            padding: 20px;
            border-radius: 10px;
            background-image: url('bulletin_board_texture.jpg');
            background-size: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* 이를 기준으로 내부 위치 지정 */
        }
        h1{
            margin: 10px 0;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            opacity: 0; /* 초기에 숨겨진 상태 */
            animation: fadeIn 1s forwards; /* 페이드 인 애니메이션 적용 */
            animation-delay: 0.5s; /* 약간의 지연 추가 */
        }
        p{
            margin: 10px 0;
            padding: 1px;
            background-color: rgba(255, 255, 255, 0.8);
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
            position: absolute; /* 상대적 위치 지정 */
            bottom: -50px; /* 컨테이너 하단에서 20px 위에 위치 */
            left: 20px; /* 좌측 정렬을 위해 추가 */
            width: calc(100% - 795px); /* 패딩을 고려한 너비 조정 */
            display: flex;
            align-items: center;
            justify-content: space-between; /* 내부 요소 간 간격 조정 */
        }
        .like-button {
            padding: 80px 5px;
            background-color: transparent;
            color: red;
            border: none;
            font-size: 24px;
            cursor: pointer;
            outline: none; /* Remove button outline */
        }
        .re-cancle {
            padding: 5px 5px;
            position: absolute; /* 상대적 위치 지정 */
            bottom: 20px; /* 컨테이너 하단에서 20px 위에 위치 */
            right: 20px; /* 우측 정렬 */
            display: flex;
            align-items: center;
        }
        .download-section{
            padding: 5px 5px;
            position: absolute; /* 상대적 위치 지정 */
            bottom: 33px; /* 컨테이너 하단에서 20px 위에 위치 */
            left: 140px; /* 우측 정렬 */
            display: flex;
            align-items: center;
        }

        .cancle-button {
            padding: 5px 10px; /* 적당한 패딩으로 버튼의 크기 조정 */
            font-size: 10px; /* 글꼴 크기 */
            border: 2px solid #ff0000; /* 빨간색 경계선 */
            background-color: rgba(255, 255, 255, 0.5); /* 투명한 흰색 배경 */
            color: #ff0000; /* 빨간색 글꼴 */
            border-radius: 5px; /* 경계선의 둥근 모서리 */
            cursor: pointer; /* 마우스 오버 시 커서 변경 */
            transition: background-color 0.3s ease; /* 배경색 변경 애니메이션 */
        }
        .edit-button {
            padding: 5px 10px; /* Adjust padding */
            margin-right: 10px;
            font-size: 10px; /* Adjust font size */
            border: 2px solid #007bff; /* Blue border */
            background-color: rgba(255, 255, 255, 0.5); /* Transparent white background */
            color: #007bff; /* Blue font color */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s ease; /* Background color transition */
        }
        .fas fa-download {
            color: black; /* 아이콘 색상 */
            font-size: 20px; /* 아이콘 크기 */
        }


        .cancle-button:hover {
            background-color: rgba(255, 0, 0, 0.7); /* 호버 시 배경색 진하게 */
            color: #ffffff; /* 호버 시 글꼴색을 흰색으로 */
        }
        .edit-button:hover {
            background-color: rgba(0, 123, 255, 0.7); /* Darker blue on hover */
            color: #ffffff; /* White font color on hover */
        }


        .view-count {
            margin-left: 10px;
            color: #777;
        }
        /* 페이드 인 애니메이션 정의 */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes growAndShrink {
        0%, 100% { transform: scale(1); } /* Initial and final state */
        50% { transform: scale(1.5); } /* Grow to 1.5 times original size at 50% of animation */
        }

        @keyframes growAndShrink1 {
        0%, 100% { transform: scale(1); } /* Initial and final state */
        50% { transform: scale(1.2); } /* Grow to 1.5 times original size at 50% of animation */
        }

        img.grow {
            animation: growAndShrink1 0.5s ease forwards;
        }
    </style>