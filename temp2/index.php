<?php include("../commonPages/index_header.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="slick.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="x-icon" href="icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Edit Your Resturant</title>
</head>

<body>

    <div id="profile">
        <div id="ProfilePage">
            <div class="Page">
                <form>
                    <ul>
                        <li>
                            <ul>
                                <li>
                                    <img src="img_avatar1.png" alt="">
                                </li>
                                <li>
                                    <p>
                                        Shivang Pandya papa bhai
                                    </p>
                                    <p>
                                        abc@gmail.com
                                    </p>
                                    <p>
                                        +91 123456897
                                    </p>
                                    <p>
                                        Shivang Resturant
                                    </p>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="">Profile</a>
                        </li>
                        <li>
                            <a href="">Edit Your Website</a>
                        </li>
                        <li>
                            <a href="">Log Out</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <section class="ResturantSlider">
        <div class="container">
            <div class="ImagesSlider">
                <div class="items">
                    <img src="menu.jpg" style="background-size: contain;" alt="">
                </div>
                <div class="items">
                    <img src="bill.jpg" alt="">
                </div>
                <div class="items">
                    <img src="orderStatus.jpg" alt="">
                </div>
                <div class="items">
                    <img src="Qr.jpg" alt="">
                </div>
                <div class="items">
                    <img src="Ingredients.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="slick.js"></script>

<script>
    var i = 1;
    function clicked() {
        side = document.getElementById('profile');
        i++;
        if (i % 2 == 0) {
            side.style.transform = 'translate(-0%,0)';
            // side.style.display = 'block';
            side.style.opacity = '1';
        }
        else {
            side.style.transform = 'translate(100%,0)';
            // side.style.display = 'none';
            side.style.opacity = '0';
        }
    }
</script>

<script>
    $('.ImagesSlider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true
    });
</script>

<script>
    var j = 1;
    function burger() {
        burger1 = document.getElementById("sidebarmenu");
        j++;
        if (j % 2 == 0) {
            burger1.style.display = 'block';
        }
        else {
            burger1.style.display = 'none';
        }
    }
</script>

<script>
    document.getElementsByClassName("slick-prev").innerHTML = "<";
    document.getElementsByClassName("slick-next").innerHTML = ">"; 
</script>


</html>