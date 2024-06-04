<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Button</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <button class="fixed-button">
        &#128100;
    </button>

    <div id="content">
        <div id="section1">
            <h2>Section 1</h2>
            <p>Content for section 1...</p>
        </div>
        <div id="section2">
            <h2>Section 2</h2>
            <p>Content for section 2...</p>
        </div>
        <div id="section3">
            <h2>Section 3</h2>
            <p>Content for section 3...</p>
        </div>
        <div id="section4">
            <h2>Section 4</h2>
            <p>Content for section 4...</p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.fixed-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #333;
    color: white;
    font-size: 24px;
    border: none;
    border-radius: 50%;
    padding: 10px;
    cursor: pointer;
    z-index: 1000;
}

#content {
    padding: 20px;
}

#section1, #section2, #section3, #section4 {
    padding: 100px 20px;
    height: 500px;
}


</style>

