<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="icon.png">
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

        @media only screen and (max-width: 768px) {
            .Menu .MenuContainer .MenuBox .MenuHeading {
                position: relative;
            }
            .Menu .MenuContainer .MenuBox .MenuHeading marquee{
            text-align: center;
            font-size: 1.2em;
            position: absolute;
            top: 26%;
            text-decoration: none;
            background-color: white;
            overflow: hidden;
            height: 100%;
            color: black;
            width: 100%;
            /* margin: 10px 0; */
            font-family: 'Poppins', sans-serif;
        }
            .Menu .MenuContainer .MenuBox {

            }
        }
        @media only screen and (max-width: 1024px) {
            .Menu .MenuContainer .MenuBox .MenuHeading marquee{
            text-align: center;
            font-size: 1.2em;
            position: absolute;
            top: 26%;
            text-decoration: none;
            overflow: hidden;
            height: 100%;
            color: black;
            width: 100%;
            /* margin: 10px 0; */
            font-family: 'Poppins', sans-serif;
        }
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
            background-color: white;
            border-bottom: 1px solid black;
            border-bottom-style: inset;
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
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .Menu .MenuContainer .MenuBox .MenuImg{
            width: 100%;    
            height: 80%;
            margin: 0;
            padding: 0;
        }
        
        .Menu .MenuContainer .MenuBox .MenuHeading{
            width: 100%;
            background-color: white;
            border-top: 2px solid;
            height: 20%;
            margin: 0;
            padding: 0;
            position: relative;
        }
        
        .Menu .MenuContainer .MenuBox img{
            width: 100%;
            border-bottom: 2px solid black;
            height: 200px;
        }

        .Menu .MenuContainer a{
            text-decoration: none;
        }
        
        
        .Menu .MenuContainer .MenuBox marquee{
            text-align: center;
            position: absolute;
            top: 25%;
            font-size: 1.2em;
            text-decoration: none;
            overflow: hidden;
            height: 100%;
            color: black;
            display: inline-block;
            /* margin: 10px 0; */
            font-family: 'Poppins', sans-serif;
        }
        
        .Menu .MenuContainer .active{
            border: 3px solid rgba(0,255,0);
            box-shadow: rgba(0, 255, 0, 0.3) 0px 19px 38px, rgba(0, 255, 0, 0.22) 0px 15px 12px;
        }

        .Button{
            width: 100%;
            margin: 50px 0;
            display: flex;
            justify-content: center;   
        }
        
        #subBtn{
            background-color: greenyellow;
            border: 1px solid Green;
            padding: 7px 20px;
        }
        #subBtn:hover{
            background-color: green;
            color: white;
            transition-duration: 0.7s;
            border: 1px solid greenyellow;
        }

        </style>

</head>

<body>
    <section class="Menu">
        <h1>Select Food Items</h1>
        <div class="container">
            <div class="MenuContainer">
            <?php
                    if(isset($_GET['name'])){
                        $category = $_GET['name'];
                    }
                    else{
                        ?>
                        <script>
                            document.querySelector("h1").innerHTML = 'Select category First';
                        </script>
                        <?php
                        exit();
                    }

                    $con = mysqli_connect("localhost", "root", "", "scantodine");
                    $select_item = mysqli_query($con, "select * from default_item where category='$category'");
                    $items = mysqli_fetch_all($select_item, MYSQLI_ASSOC);
                    foreach($items as $item){
                    $item_id = $item['item_id'];
                    $item_name = $item['item_name'];
                    $item_extension = $item['extension'];
                ?>
                <div class="MenuBox" div_id="<?php echo $item_id; ?>">
                <div class="MenuImg">
                    <img src="../default_items2/<?php echo $item_id."-".$item_name."-".$category.".".$item_extension ?>" alt="<?php echo $item_name ?>">
                </div>
                <div class="MenuHeading">
                    <marquee direction="left" scrolldelay=20>
                        <?php echo $item_name; ?>
                    </marquee>
                </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
    <h2 id="selected"></h2>
    <form action="menu_edit.php" method="POST">
        <input type="hidden" name='selecteditems' id="selectedItemsInput">
        <div class="Button">
            <button type="submit" id="subBtn">Submit</button>
        </div>
    </form>
        

        <script>
        var selected_items = JSON.parse(localStorage.getItem('selected_items')) || [];
        const itemDivs = document.querySelectorAll('.MenuBox');

        var selectedItemsInput = document.getElementById('selectedItemsInput');

        function updateSelectedItemsInput(){
            selectedItemsInput.value = JSON.stringify(selected_items);
            localStorage.setItem("selected_items",JSON.stringify(selected_items));
        }

        itemDivs.forEach(function(div){
            const div_id = div.getAttribute('div_id');
            if (selected_items.includes(div_id)){
                div.classList.add("active");
            }
            div.addEventListener('click',function(){

                var selectedDiv = div.classList.contains('active'); // true or false

                if(selectedDiv){
                    div.classList.remove('active');
                    const index = selected_items.indexOf(div_id);
                    selected_items.splice(index, 1);
                    updateSelectedItemsInput();
                }
                else{
                    div.classList.add('active');
                    selected_items.push(div_id);
                    updateSelectedItemsInput();
                }
                
            })
        })
    </script>
</body>

</html>