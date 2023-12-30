<?php include("../commonPages/index_header.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="adminMain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="slider-div">
        <div class="slider">
            <img src="adminMain-images/slide1.jpg" class="slide" alt="">
            <img src="adminMain-images/slide2.jpg" class="slide" alt="">
            <img src="adminMain-images/slide3.jpg" class="slide" alt="">
            <img src="adminMain-images/slide4.jpg" class="slide" alt="">
            <img src="adminMain-images/slide5.jpg" class="slide" alt="">
            <button id="slider-left-btn" class="btn" onclick="prevSlide()"><i class="fa-solid fa-chevron-left fa-lg"></i></button>
            <button id="slider-right-btn" class="btn" onclick="nextSlide()"><i class="fa-solid fa-chevron-right fa-lg"></i></button>
        </div>
    </div>

    <script src="adminMain.js"></script>
</body>

</html>