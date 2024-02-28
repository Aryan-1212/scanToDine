<?php
// if(session_status() == PHP_SESSION_NONE){
//     session_start();
//     session_destroy();
// }
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION['is_login'])){
        header("Location: ../adminModule/adminDashboard.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="x-icon" href="logo.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>ScanToDine</title>
</head>

<!-- <style>
    .footer {
        background-color: #e74c3c;
        /* Red background color */
        color: white;
        /* White text color */
        height: 150px;
        /* Footer height set to 150px */
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style> -->
<style>
    .boxShadow1 {
        box-shadow: 5px 7px #888888;
    }

    .boxShadow2 {
        box-shadow: -5px -7px 0 0 var(--red);
    }
</style>

<body>

    <div id="progress"></div>
    <?php include("../commonPages/index_header.php"); ?>

    <section class="ManageYourRestaurant">
        <div class="container">
            <div class="Manage">
                <div class="Your">
                    <h2>Manage Your Restaurant </h2>
                    <p>This platform empowers restaurant owners to create and manage their personalized digital menus
                        effortlessly, including prices and inventory.</p>
                    <a href="../commonPages/register.php">Try for Demo</a>
                </div>
                <div class="Restaurant">
                    <img src="restaurant_maker.jpg" class="boxShadow1" title="Manage Your Restaurant Digitally" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="WhatIsaQRCodeMenuforRestaurants">
        <div class="container">
            <div class="QRCode">
                <div class="MenuforRestaurants">
                    <img src="QR.jpg" title="Scan To Order" class="boxShadow2" alt="">
                </div>
                <div class="WhatIsQRCode">
                    <h2>Just Scan and Order</h2>
                    <p>Utilize QR code for streamline ordering, enhancing customer experience and reducing wait times.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="CustomizeIngredients">
        <div class="container">
            <div class="Customize">
                <div class="CustomizationOption">
                    <h2>Customization Option</h2>
                    <p>Enable customers to customize their food orders based on their preferences, choosing ingredients
                        and adjusting spice levels as per their taste. </p>
                </div>
                <div class="CustomizeIngredientsImage">
                    <img src="CustomizeIngredients.jpg" class="boxShadow1" title="Customization Option" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="bill">
        <div class="container">
            <div class="BillAndPay">
                <div class="BillAndPayImage">
                    <img src="bill_and_pay.jpg" class="boxShadow2" title="Digitally Payment" alt="">
                </div>
                <div class="DigitallyPayment">
                    <h2>Digitally Payment</h2>
                    <p>Facilitates digital bill generation and allowing cutomers to pay them directly from their
                        smartphone. </p>
                </div>
            </div>
        </div>
    </section>

    <section class="FoodStatus">
        <div class="container">
            <div class="Food">
                <div class="OrderTracking">
                    <h2>Order Tracking</h2>
                    <p>Allow customers to track the status of their orders, from preparation to ready.
                    </p>
                </div>
                <div class="FoodStatusImage">
                    <img src="food_status.jpg" class="boxShadow1" title="Food Status" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="Feedback">
        <div class="container">
            <div class="feedback">
                <div class="FeedbackImage">
                    <img src="feedbacks.jpg" class="boxShadow2" title="Feedback" alt="">
                </div>
                <div class="FeedbackAndImprovements">
                    <h2>Feedback and Improvements</h2>
                    <p>Collect feedback from users and implement improvements based on their suggestions to enhance user
                        experience.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- <div class="footer">
        <p>© 2023 ScanToDine, All rights reserved.</p>
    </div> -->

    <?php
    include("../commonPages/index_footer.html");
    ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>

<script>
    let i = 1;
    function clicked() {
        side = document.getElementById('sidebarmenu');
        i++;
        if (i % 2 == 0) {
            side.style.display = 'block';
        }
        else {
            side.style.display = 'none';
        }
    }
</script>

<script>
    function click() {
        document.getElementById('progress').style.animation = "p1";
    }
</script>


</html>