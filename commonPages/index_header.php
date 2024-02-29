<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    header {
        height: 100px;
        width: 100%;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: whitesmoke;
    }

    header .header-main {
        height: 100%;
        width: 90%;
        display: flex;
    }

    .header-main-logo {
        width: 15%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-main-logo .header-logo {
        width: 100px;
    }

    .header-main-logo .header-logo .header-logo-img {
        width: 100%;
    }

    header .header-main .header-main-nav {
        width: 85%;
        display: flex;
        justify-content: end;
    }

    header .header-main .header-main-nav-items {
        height: 100px;
        width: 42vw;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        font-size: 18px;
        margin-bottom: 0;
    }

    header .header-main li {
        list-style: none;
    }

    header .header-main li a {
        text-decoration: none;
        color: #e74c3c;
        border-bottom: 2px solid #c0392b;
        border-bottom-style: none;
    }

    header .header-main li a:hover {
        color: #c0392b;
        border-bottom-style: solid;
    }

    .header-main-nav #header-mobile-nav {
        display: none;
    }

    header .header-main .header-main-nav {
        position: relative;
    }

    .header-main-nav #header-mobile-nav {
        font-size: 24px;
        cursor: pointer;
        position: absolute;
        top: 30px;
        color: #c0392b;
    }

    .header-main-nav #toggle-nav-items {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        background-color: white;
        position: absolute;
        top: 60px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        z-index: 3;
        display: none;
    }

    .header-main-nav #toggle-nav-items li {
        margin: 5px 30px;
    }

    .header-dropdown {
        /* position: relative; */
    }

    .header-sub-menu {
        text-align: center;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        width: 200px;
        left: -85px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: absolute;
        display: none;
        background-color: whitesmoke;
    }

    .header-sub-menu li {
        margin: 7px 20px;
        padding: 10px;
    }

    #header-dropdown-link {
        position: relative;
    }

    #header-dropdown-link:hover .header-sub-menu {
        display: block;
    }



    @media screen and (max-width: 1130px) {
        header .header-main .header-main-nav-items {
            width: 55vw;
        }

        header {
            padding: 0px 20px;
        }
    }

    @media screen and (max-width: 800px) {
        #toggle-nav-items.active {
            display: flex;
        }

        header .header-main .header-main-nav-items {
            display: none;
        }

        .header-main-nav #header-mobile-nav {
            display: block;
        }
    }

    @media screen and (max-width: 600px) {
        header {
            padding: 0px 20px;
        }
    }
</style>

<body>
    <?php
    $is_login = isset($_SESSION['is_login']) ? true : false;
    ?>
    <header>
        <div class="header-main">
            <div class="header-main-logo">
                <?php
                if (!$is_login) {
                    ?>
                    <a href="../indexPage/index.php">
                        <?php
                } else {
                    ?>
                        <a href="../adminModule/adminDashboard.php">
                            <?php
                }
                ?>
                        <div class="header-logo">
                            <img src="../commonPages/logo.png" alt="Logo" class="header-logo-img">
                        </div>
                    </a>
            </div>
            <div class="header-main-nav">
                <div id="header-mobile-nav" onclick="toggleMobileMenu()">☰</div>
                <ul id="toggle-nav-items">
                    <?php if (!$is_login) {
                        ?>
                        <li><a href="../indexPage/index.php">Home</a>
                        </li>
                        <li><a href="../commonPages/about_us.php">About Us</a></li>
                        <li><a href="../commonPages/contactUs.php">Contact Us</a></li>
                        <li><a href="../commonPages/login.php">Log
                                in</a></li>
                        <?php
                    } else {
                        if (isset($_SESSION['is_chef_login'])) {
                            ?>
                            <li><a href="../adminModule/adminDashboard.php">Dashboard </a></li>
                            <li><a href="../adminModule/orders.php">Orders</a></li>
                            <!-- <li class="Header-sub-item"><a href="../adminModule/feedback.php">Feedbacks</a></li> -->
                            <!-- <li class="Header-sub-item"><a href="../adminModule/inventory.php">Inventory</a></li> -->
                            <li class="header-sub-item"><a href="../adminModule/orders_history.php">Orders History</a></li>
                            <li><a href="../commonPages/profile.php">Profile</a></li>
                            <?php
                        }else{
                        ?>
                        <li><a href="../adminModule/adminDashboard.php">Dashboard </a></li>
                        <li><a href="../adminModule/menu_choose.php">Menu</a></li>
                        <li><a href="../adminModule/orders.php">Orders</a></li>
                        <li class="Header-sub-item"><a href="../adminModule/feedback.php">Feedbacks</a></li>
                        <li class="Header-sub-item"><a href="../adminModule/inventory.php">Inventory</a></li>
                        <li class="Header-sub-item"><a href="../adminModule/bill_structure1.php">Manage Bills</a></li>
                        <li class="header-sub-item"><a href="../adminModule/qrAdmin.php">QR codes</a></li>
                        <li class="header-sub-item"><a href="../adminModule/orders_history.php">Orders History</a></li>
                        <li class="header-sub-item"><a href="../adminModule/chef.php">Manage Chef</a>
                                </li>

                        <li><a href="../commonPages/profile.php">Profile</a></li>
                        <?php
                        }
                    }
                    ?>
                </ul>


                </ul>
                <ul class="header-main-nav-items">
                    <?php if (!$is_login) {
                        ?>
                        <li><a href="../indexPage/index.php">Home</a>
                        </li>
                        <li><a href="../commonPages/about_us.php">About Us</a></li>
                        <li><a href="../commonPages/contactUs.php">Contact Us</a></li>
                        <li><a href="../commonPages/login.php">Log
                                in</a></li>
                        <?php
                    } else {
                        if (isset($_SESSION['is_chef_login'])) {
                            ?>
                            <li><a href="../adminModule/adminDashboard.php">Dashboard </a></li>
                            <li><a href="../adminModule/orders.php">Orders</a></li>
                            <!-- <li class="Header-sub-item"><a href="../adminModule/feedback.php">Feedbacks</a></li> -->
                            <!-- <li class="Header-sub-item"><a href="../adminModule/inventory.php">Inventory</a></li> -->
                            <li class="header-sub-item"><a href="../adminModule/orders_history.php">Orders History</a></li>
                            <li><a href="../commonPages/profile.php">Profile</a></li>
                            <?php
                        }else{
                        ?>
                        <li><a href="../adminModule/adminDashboard.php">Dashboard</a></li>
                        <li><a href="../adminModule/menu_choose.php">Menu</a></li>
                        <li><a href="../adminModule/orders.php">Orders</a></li>
                        <li class="header-dropdown" id="header-dropdown-link"><a href="#">More</a>
                            <ul class="header-sub-menu">
                                <li class="header-sub-item"><a href="../adminModule/inventory.php">Inventory</a></li>
                                <li class="header-sub-item"><a href="../adminModule/bill_structure1.php">Manage Bills</a>
                            </li>
                            <li class="header-sub-item"><a href="../adminModule/feedback.php">Feedbacks</a></li>
                                <li class="header-sub-item"><a href="../adminModule/qrAdmin.php">QR codes</a></li>
                                <li class="header-sub-item"><a href="../adminModule/orders_history.php">Orders History</a>
                                </li>
                                <li class="header-sub-item"><a href="../adminModule/chef.php">Manage Chef</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="../commonPages/profile.php">Profile</a></li>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </header>

    <script>
        function toggleMobileMenu() {
            const toggle = document.getElementById('toggle-nav-items');
            // if(toggle.style.display === "block"){
            //     toggle.style.display = "none";
            // }else{
            //     toggle.style.display = "block";
            // }

            toggle.classList.toggle("active");
        }
    </script>
</body>

</html>