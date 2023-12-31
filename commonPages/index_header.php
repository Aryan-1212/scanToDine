<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f2f2f2;
        }

        .Header-header {
            background-color: white;
            color: #e74c3c;
            display: flex;
            /* font-family: 'Poppins', sans-serif; */
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            height: 100px;
            width: 100%;
            position: sticky;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .Header-Container {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .Header-logo {
            width: 100px;
        }

        .Header-logo img {
            width: 100%;
        }

        .Header-nav-container {
            display: flex;
            justify-content: space-between;
            align-items: end;
            width: 600px;
        }

        .Header-nav-list {
            width: 100%;
            justify-content: space-between;
            list-style: none;
            display: flex;
        }

        .Header-nav-item {
            margin-right: 20px;
        }

        .Header-nav-link {
            text-decoration: none;
            color: #e74c3c;
            transition: color 0.3s;
            position: relative;
            font-size: 18px;
        }

        .Header-nav-link:hover {
            color: #c0392b;
            /* Darker red on hover */
        }
        .Header-nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #e74c3c;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-in-out;
        }

        .Header-nav-link:hover::before {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
        .Header-dropdown {
            position: relative;
        }


        #Header-mobile-menu {
            display: none;
        }

        .Header-sub-menu {
            padding: 0px;
            position: absolute;
            display: none;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1;
            top: 100%;
            /* left: 0; */
            right: 0;
            width: 100px;
        }
        .Header-sub-menu li{
            width: 100%;
            margin: 10px 0px;
            /* border-bottom: 1px solid whitesmoke; */
            /* border-bottom-style: outset; */
            text-align: center;
        }

        .Header-dropdown:hover .Header-sub-menu {
            display: block;
        }


        .Header-sub-item a{
            text-decoration: none;
            color:#e74c3c;
        }

        .Header-sub-item a{
            /* border: 1px solid black; */
        }

        .Header-sub-item a::before{
            content: '';
            position: absolute;
            /* bottom: 0; */
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #e74c3c;
            
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-in-out;
        }
        
        .Header-sub-item a:hover{
            color: #c0392b;
        }

        .Header-sub-item a:hover::before{
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .Header-sub-item{
            list-style: none;
        }

        @media (max-width: 1200px) {

            .Header-sub-menu {
                position: static;
                display: none;
                background-color: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 1;
                top: 100%;
                left: 0;
            }

            .Header-dropdown:hover .Header-sub-menu {
                display: block;
                position: absolute;
                width: 100%;
                left: -100%;
                top: 0;
            }

            .Header-dropdown:hover .Header-sub-menu li{
                border: none;
            }

            .Header-sub-menu .Header-sub-item {
                width: 100%;
            }

            .Header-nav-container {
                justify-content: right;
                align-items: center;
            }

            .Header-nav-list {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                width: 160px;
                background-color: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }

            /* Style for the mobile menu button */
            #Header-mobile-menu {
                display: block;
                /* position: absolute; */
                top: 20px;
                right: 20px;
                cursor: pointer;
                font-size: 24px;
                /* Increase font size for the hamburger icon */
            }

            /* Show the navigation options when the mobile menu button is clicked */
            .Header-nav-list.show {
                display: flex;
            }

            /* Style for each navigation option */
            .Header-nav-item {
                margin-left: -33px;
                margin-right: 0;
                /* Remove margin between options */
                text-align: center;
                height: 40px;
            }

            /* Add a border to separate each option */
            .Header-nav-link {
                padding: 10px;
                text-align: center;
                width: 150px;
                border-bottom: 1px solid transparent;
            }

            .Header-nav-link:hover {
                color: #c0392b;
                /* Darker red on hover */
                border-bottom: 1px solid #e74c3c;
                /* Show the border on hover */
            }

        }
    </style>
</head>

<body>

    <?php
    $is_login = isset($_SESSION['is_login']) ? true : false;
    ?>

    <!-- <div class="Header-to-sticky"> -->
    <header class="Header-header">
        <div class="container Header-Container">
            <?php
            if (!$is_login) {
                ?>
                <a href="../indexPage/index.php">
                    <?php
            } else {
                ?>
                    <a href="../adminModule/adminMain.php">
                        <?php
            }
            ?>
                    <div class="Header-logo">
                        <img src="../commonPages/logo.png" alt="Logo" class="Header-logo-img">
                    </div>
                </a>
                <!-- <div id="Header-mobile-menu" onclick="toggleMobileMenu()">☰</div> -->
                <nav class="Header-nav-container">
                    <div id="Header-mobile-menu" onclick="toggleMobileMenu()">☰</div>
                    <ul class="Header-nav-list">
                        <?php if (!$is_login) {
                            ?>
                            <li class="Header-nav-item"><a href="../indexPage/index.php" class="Header-nav-link">Home</a>
                            </li>
                            <li class="Header-nav-item"><a href="../commonPages/about_us.php" class="Header-nav-link">About Us</a></li>
                            <li class="Header-nav-item"><a href="../commonPages/contactUs.php"
                                    class="Header-nav-link">Contact Us</a></li>
                            <li class="Header-nav-item"><a href="../commonPages/login.php" class="Header-nav-link">Log
                                    in</a></li>
                            <?php
                        } else {
                            ?>
                            <li class="Header-nav-item"><a href="../adminModule/adminMain.php" class="Header-nav-link">Home</a></li>
                            <li class="Header-nav-item"><a href="../adminModule/menu_select1.php"
                                    class="Header-nav-link">Menu</a></li>
                            <li class="Header-nav-item"><a href="#" class="Header-nav-link">Bill</a></li>
                            <li class="Header-nav-item Header-dropdown"><a href="#" class="Header-nav-link">More</a>
                                <ul class="Header-sub-menu">
                                    <li class="Header-sub-item"><a href="../adminModule/feedback.php">Feedbacks</a></li>
                                    <li class="Header-sub-item"><a href="../adminModule/inventory.php">Inventory</a></li>
                                    <!-- Add more sub-menu items as needed -->
                                </ul>
                            </li>
                            <li class="Header-nav-item"><a href="#" class="Header-nav-link">Profile</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>

        </div>
    </header>
    <!-- </div> -->
    <!-- Rest of your content goes here -->


    <script>
        // Function to toggle mobile menu
        function toggleMobileMenu() {
            const nav = document.querySelector('.Header-nav-list');
            nav.classList.toggle('show');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>

</html>