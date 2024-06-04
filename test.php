<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>Bulletin Board Details</title>
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
        .cancleImage{
            margin-right: 20px;
        }
        .icon-hover-grow {
            transition: transform 0.2s; /* 애니메이션 효과 지속 시간 */
            cursor: pointer; /* 마우스 오버 시 커서 모양 변경 */
        }
        .icon-hover-grow:hover {
            transform: scale(1.1); /* 원래 크기보다 10% 더 커짐 */
        }
        #titleInput {
            width: 100%; /* 입력칸의 너비를 조절합니다. */
            padding: 10px; /* 내부 여백을 추가하여 높이를 조절합니다. */
            font-size: 16px; /* 글꼴 크기를 조정하여 높이에 영향을 줍니다. */
            margin-bottom: 10px; /* 다음 요소와의 간격을 추가합니다. */
            box-sizing: border-box; /* 패딩과 테두리를 너비에 포함시킵니다. */
        }
        
        textarea#contentInput {
            width: 100%; /* 내용 입력칸의 너비를 조절합니다. */
            padding: 10px; /* 내부 여백을 추가합니다. */
            font-size: 16px; /* 글꼴 크기를 조정합니다. */
            margin-bottom: 20px; /* 다음 요소와의 간격을 추가합니다. */
            box-sizing: border-box; /* 패딩과 테두리를 너비에 포함시킵니다. */
        }
        #fileUpload {
            display: none; /* 파일 입력 필드 숨기기 */
        }
        .upload-icon, .submit-icon {
            cursor: pointer; /* 아이콘에 마우스 오버 시 커서 변경 */
            
        }
        .upload-icon-container {
            position: fixed; /* 뷰포트에 대해 고정 위치 */
            bottom: 20px; /* 아래쪽 여백 */
            left: 100px; /* 오른쪽 여백 */
        }
        .icons-container {
            display: flex;
            justify-content: space-around; /* 아이콘 사이에 공간을 균등하게 배분 */
            align-items: center; /* 수직 중앙 정렬 */
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    
        <!-- 사용자 입력 폼 -->
        <form id="postForm" style="margin-top: 20px;">
            <label for="titleInput">제목:</label><br>
            <input type="text" id="titleInput" placeholder="새 제목을 입력하세요" rows="5" cols="100" ><br>
            <label for="contentInput">내용:</label><br>
            <textarea id="contentInput" placeholder="새 내용을 입력하세요" rows="10" cols="100"></textarea><br>
            <i class="fas fa-lock"></i>
            <input type="checkbox" id="updateCheckbox" onchange="updatePostCheckbox()">
        </form>
        <div class="re-cancle">
            <i id="editIcon" class="fas fa-edit icon-hover-grow" onclick="toggleImageSize('editIcon')" style="font-size:24px; cursor:pointer; margin-right:15px;"></i>
            <i id="okayIcon" class="fas fa-check icon-hover-grow" onclick="toggleImageSize('okayIcon')" style="font-size:24px; cursor:pointer;"></i>
        </div>
        
        <form action="/upload" method="post" enctype="multipart/form-data" style="margin-bottom: 20px;">
            <label for="fileUpload" class="upload-icon">
                <i class="fas fa-upload"></i> 
            </label>
            <input type="file" id="fileUpload" name="fileUpload" onchange="this.form.submit();">
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    </div>

    <script>
        function updatePost() {
            var title = document.getElementById("titleInput").value;
            var content = document.getElementById("contentInput").value;

            document.getElementById("postTitle").textContent = title;
            document.getElementById("postContent").textContent = content;
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
