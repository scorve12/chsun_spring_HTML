<?php 
    include $_SERVER['DOCUMENT_ROOT']."/header.php";
    include $_SERVER['DOCUMENT_ROOT']."/main/default.php";
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>    
    <div class="container">
        <!-- 사용자 입력 폼 -->
        <form id="postForm" style="margin-top: 20px;" method="post" action="inform_board_write_action.php" enctype="multipart/form-data" autocomplete="off">
            <label for="titleInput">제목:</label><br>
            <input type="text" id="titleInput" name="title" placeholder="새 제목을 입력하세요" rows="5" cols="100"><br>
            <label for="contentInput">내용:</label><br>
            <textarea id="contentInput" name="content" placeholder="새 내용을 입력하세요" rows="10" cols="100"></textarea><br>
            <i class="fas fa-lock"></i>
            <input type="checkbox" value="1" name="lockpost" id="updateCheckbox" onchange="updatePostCheckbox()"><br>
            <label for="fileUpload" class="upload-icon">
                <i class="fas fa-upload"></i> 
            </label>
            <input type="file" id="fileUpload" name="file"><br>
            <div class="re-cancle">
                <button type="submit" class="write">
                    <i id="okayIcon" class="fas fa-check icon-hover-grow" style="font-size:24px; cursor:pointer;"></i>
                </button>
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    </div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: rgba(255, 255, 255, 0.8);
        opacity: 0;
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
        position: relative;
        margin-top: 100px; /* 헤더 높이만큼 마진 추가 */
    }
    #titleInput, textarea#contentInput {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }
    #fileUpload {
        display: none;
    }
    .upload-icon, .submit-icon {
        cursor: pointer;
    }
    .re-cancle {
        padding: 5px 5px;
        position: absolute;
        bottom: 20px;
        right: 20px;
        display: flex;
        align-items: center;
    }
    .icon-hover-grow {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .icon-hover-grow:hover {
        transform: scale(1.1);
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
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
            likeButton.innerHTML = '&#x2661;';
        } else {
            likeButton.innerHTML = '&#x2665;';
        }
        liked = !liked;
        likeButton.style.animation = 'none';
        likeButton.offsetHeight;
        likeButton.style.animation = 'growAndShrink 0.5s ease';
    }

    function toggleImageSize(imageId) {
        var myImage = document.getElementById(imageId);
        if (myImage.classList.contains("grow")) {
            myImage.classList.remove("grow");
        } else {
            myImage.classList.add("grow");
        }
        myImage.style.animation = 'none';
        myImage.offsetHeight;
        myImage.style.animation = '';
    }
</script>

