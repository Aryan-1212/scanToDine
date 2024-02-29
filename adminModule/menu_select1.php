<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (!isset($_SESSION['is_login'])) {
        header("Location: ../indexPage/index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Edit Menu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar{
            display: none;
        }

        :root {
            --red: #cf3427;
            --white: #ffffff;
            --offwhite: whitesmoke;
            --wheat: wheat;
            --black: black;
            --chocolate: chocolate;
            --gray: gray;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: rgb(255 255 255/var(--tw-bg-opacity));
            width: 100%;
            height: 100%;
            background-color: var(--offwhite);
            border-bottom: 1px solid rgb(224 206 206);
        }

        header .HeaderContainer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100px;
        }

        header .HeaderContainer .logo {
            width: 10%;
        }

        header .HeaderContainer .logo img {
            width: 100px;
            /* border-radius: 100%; */
            cursor: pointer;
            transition: all ease-in-out 1s;
        }


        header .HeaderContainer .HeaderLinks {
            width: 70%;
        }

        /* header .HeaderContainer .HeaderLinks nav{
} */

        header .HeaderContainer .HeaderLinks nav ul {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header .HeaderContainer .HeaderLinks nav ul li {
            list-style-type: none;
            display: inline-block;
            padding: 0px 9px;
        }

        header .HeaderContainer nav ul li a {
            text-decoration: none;
            color: var(--black);
            display: inline-block;
            font-size: 1.2rem;
            font-family: 'Poppins', sans-serif;
        }

        header .HeaderContainer nav ul li a {
            text-decoration: none;
            position: relative;
            padding-bottom: 4px;
            /* The distance between text and underline */
        }

        header .HeaderContainer nav ul li a::before {
            content: "";
            position: absolute;
            width: 100%;
            top: 0;
            bottom: 0;
            background-image: linear-gradient(90deg, var(--black), var(--black));
            /* underline color */
            background-size: 0 2px;
            /* vertical size of underline */
            background-repeat: no-repeat;
            background-position: left bottom;
            /* start position of underline */
            transition: background-size .3s ease-in;
            /* duration and timing style of animation */
        }

        header .HeaderContainer nav ul li a:hover::before {
            background-size: 100% 2px;
        }

        header .HeaderContainer .Profile {
            width: 10%;
        }

        header .HeaderContainer .Profile img {
            width: 100px;
            border-radius: 100%;
            cursor: pointer;
            transition: all ease-in-out 1s;
        }

        header .HeaderContainer .Profile .burger {
            display: none;
        }

        header .HeaderContainer .Profile .burger .menu {
            display: none;
        }

        #sidebarmenu {
            display: none;
        }

        #sidebarmenu ul {
            display: none;
        }

        #sidebarmenu ul li {
            display: none;
        }

        #sidebarmenu ul li a {
            display: none;
        }

        #sidebarmenu ul li a:hover {
            display: none;
        }

        @media only screen and (max-width: 1024px) {
            header .HeaderContainer .HeaderLinks {
                display: none;
            }

            header .HeaderContainer .Profile form {
                display: none;
            }

            header .HeaderContainer .Profile .burger {
                display: block;
                border: none;
                background-color: transparent;
            }

            header .HeaderContainer .Profile .burger .menu {
                display: block;
                width: 30px;
                height: 5px;
                background-color: var(--red);
                margin: 4px 0;
                margin-left: 50%;
            }

            #sidebarmenu {
                display: none;
            }

            #sidebarmenu {
                position: sticky;
                top: 94px;
                z-index: 3;
                text-align: center;
                min-width: 200px;
                float: right;
                height: 100%;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                background-color: var(--white);
            }

            #sidebarmenu ul {
                display: block;
                margin: 0;
                padding: 0;
            }

            #sidebarmenu ul li {
                list-style-type: none;
                display: block;
            }

            #sidebarmenu ul li a {
                color: var(--red);
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                font-family: 'Poppins', sans-serif;
                font-weight: bold;
            }
            
            #sidebarmenu ul li a:hover {
                background-color: var(--offwhite);
            }
            
            header .HeaderContainer .Profile img {
                display: block;
                margin-right: 150px;
            }
        }
        
        .Menu{
            background-color: whitesmoke;
            height: 100%;
            width: 100%;
        }

        .Menu h1{
            color: #cf3427;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            font-size: 3.2rem;
        }
        
        .Menu .MenuContainer{
            display: flex;
            align-items: center;
            justify-items: center;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }
        
        .Menu .MenuContainer .MenuBox{
            border: 2px solid black;
            width: 250px;
            height: 250px;
            margin: 25px 10px;
            background-color: white;
        }
        
        .Menu .MenuContainer .MenuBox img{
            width: 100%;
            border-bottom: 2px solid black;
            height: 200px;
        }

        .Menu .MenuContainer a{
            text-decoration: none;
        }
        
        
        .Menu .MenuContainer .MenuBox h2{
            text-align: center;
            font-size: 25px;
            text-decoration: none;
            color: black;
            margin: 10px 0;
            font-family: 'Poppins', sans-serif;
        }
        
        
        </style>

</head>

<body>

    <?php
        $con = mysqli_connect("localhost","root","","scantodine");
        $fetch_category = mysqli_query($con, "select * from default_item where category = 'default_category';");
        $data = mysqli_fetch_all($fetch_category, MYSQLI_ASSOC);
    ?>
    
    <section class="Menu">
        <h1>Select Food Category</h1>
        <div class="container">
            <div class="MenuContainer">

                <?php
                    foreach($data as $category){
                        $category_id = $category['item_id'];
                        $category_name = $category['item_name'];
                        $category_extension = $category['extension'];
                ?>
                <a href="menu_select2.php?name=<?php echo $category_name; ?>">
                <div class="MenuBox">
                    <img src="../category_image2/<?php echo $category_id."-".$category_name."-category.".$category_extension ?>" alt="">
                    <h2>
                        <?php echo ucwords($category_name); ?>
                    </h2>
                </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
</body>

</html>