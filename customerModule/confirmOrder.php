<?php
if (!isset($_SESSION)) {
    session_start();
}
include("../commonPages/dbConnect.php");

$res_code = $_SESSION['res_code_for_cus'];
$food_id = $_GET['food_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConfirmOrder</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        body {
            min-height: calc(100vh - 100px);
        }

        .ConfirmOrder .ConfirmOrderContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
            padding: 50px 20px;
            background-color: #c81a1a;
            color: whitesmoke;
            border-radius: 50px;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .ConfirmOrder .ConfirmOrderContainer .ConfirmOrderInformation {
            width: 80%;
        }

        .ConfirmOrder .ConfirmOrderContainer .ConfirmOrderInformation h4 {
            font-weight: lighter;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder {
            width: 100px;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder img {
            height: auto;
            width: 100%;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder .Addbtn {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            color: green;
            background-color: white;
            border: 2px solid white;
            border-radius: 250px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            width: 100px;
            height: 50px;
            transition: all ease-in-out 0.5s;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder .Addbtn:hover {
            color: white;
            background-color: green;
            border: 2px solid green;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
            color: green;
            background-color: white;
            border: 2px solid white;
            border-radius: 250px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            width: 100px;
            height: 50px;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder .btn input {
            width: 40px;
            text-align: center;
        }

        .ConfirmOrder .ConfirmOrderContainer .addOrder .btn .arithmetic {
            border: none;
            background-color: transparent;
            color: green;
            font-family: 'Poppins', sans-serif;
            padding: 0 2px;
        }

        #more {
            display: none;
        }

        .addAfterFirst {
            display: none;
        }

        .cart {
            position: fixed;
            bottom: 50px;
            right: 50px;
            z-index: 1000;
            display: none;
        }

        .cart i {
            padding: 30px 20px;
            border: 2px solid;
            border-radius: 100px;
            transition: all ease-in-out 0.5s;
            cursor: pointer;
            background-color: whitesmoke;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .cart i:hover {
            background-color: green;
            border: 2px solid green;
        }

        #cart {
            display: none;
        }

        .btn-divs{
            display: flex;
            height: 80px;
            align-items: center;
            padding: 0px 130px;
            justify-content: space-between;
        }

        .btn-divs a {
            padding: 12px 20px;
            text-decoration: none;
            background-color: white;
        }

        .btn-divs a:hover {
            color: white;
            transition-duration: 0.7s;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .backdiv a{
            color: red;
            border: 1px solid red;
        }

        .backdiv a:hover{
            background-color: red;
        }

        .view-order a{
            color: green;
            border: 1px solid green;
        }
        .view-order a:hover{
            background-color: green;
        }

        @media screen and (max-width: 740px) {
                .btn-divs {
                    padding: 0px 70px;
                }
        }
        @media screen and (max-width: 500px) {
            .btn-divs {
                    padding: 0px 30px;
                }
            .ConfirmOrder .ConfirmOrderContainer {
                flex-direction: column;
            }
            .ConfirmOrder .ConfirmOrderContainer .ConfirmOrderInformation{
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    <div class="btn-divs">
        <div class="backdiv">
            <a href="../customerModule/order.php">BACK</a>
        </div>

        <?php
        if (isset($_SESSION['is_registered_cus']) && isset($_SESSION['uid'])) {
            $uid = $_SESSION['uid'];
            $isAnyOrderQurey = "select order_id from orders 
                                where cus_id=$uid and res_id=$res_code and order_status='placed'
                                AND TIMESTAMPDIFF(HOUR, order_date, NOW()) <= 24";
            $isAnyOrder = mysqli_query($con, $isAnyOrderQurey);
            if (mysqli_num_rows($isAnyOrder) > 0) {
                echo "<div class='view-order'><a href='../customerModule/orderStatus.php'>View Ongoing Orders</a></div>";
            }
        }
        ?>
    </div>

    <?php
    $fetchItemTypesQuery = "select * from food_items where food_id=$food_id and res_id=$res_code";
    $fetchItemTypes = mysqli_query($con, $fetchItemTypesQuery);
    $data = mysqli_fetch_all($fetchItemTypes, MYSQLI_ASSOC);
    foreach ($data as $type) {
        $food_type_id = $type['food_type_id'];
        $type_name = $type['type_name'];
        $type_price = $type['type_price'];
        $type_des = $type['type_des'];
        ?>

        <section class="ConfirmOrder">
            <div class="container">
                <div class="ConfirmOrderContainer">
                    <div class="ConfirmOrderInformation">
                        <h2>
                            <?php echo ucwords($type_name); ?>
                        </h2>
                        <h4>
                            <?php echo $type_price . "₹"; ?>
                        </h4>

                        <?php
                        // $type_des = 'Lorem ipsum dolor sit aet onsectetur adipisicing elit. Impedit neque ipsum hic qui vero debitis velit dolores sunt asperiores aut.';
                    
                        $first_string = substr($type_des, 0, 100);
                        if (strlen($type_des) > 100) {
                            $second_string = substr($type_des, 100, );
                        } else {
                            $second_string = '';
                        }
                        ?>

                        <p>
                            <?php
                            echo $first_string;
                            if ($second_string) {
                                echo "<span id='dots'>...</span>";
                            }
                            ?>
                            <span id='more'>
                                <?php
                                echo $second_string;
                                ?>
                            </span>
                        </p>
                        <?php
                        if ($second_string) {
                            echo "<u style='cursor: pointer;' onclick='myFunction()' id='myBtn'>Read more</u>";
                        }
                        ?>
                    </div>
                    <div class="addOrder">
                        <button class="Addbtn" id="<?php echo 'add-type-' . $food_type_id; ?>"
                            onclick="addItem(event)">ADD</button>
                        <div class="btn addAfterFirst" id="<?php echo 'change-type-' . $food_type_id; ?>"><button
                                class="arithmetic" onclick="minus(event)"
                                id="<?php echo 'minus-' . $food_type_id; ?>">-</button><input id="<?php
                                     echo 'num-' . $food_type_id; ?>" type="number"><button onclick="plus(event)"
                                id="<?php echo 'plus-' . $food_type_id; ?>" class="arithmetic">+</button></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>

    <div class="cart" id="cart">
        <form action="orderCart.php" method="POST" id="formToSubmit">
            <input type="hidden" id="hiddenField" name="order">
            <i onclick="submitCart()" class="fa-solid fa-cart-shopping fa-lg" style="color: #000000;"></i>
        </form>
    </div>

</body>

<script>
    const selectedTypes = {};

    checkCart = () => {
        if (Object.keys(selectedTypes).length === 0) {
            document.getElementById("cart").style.display = 'none';
        } else if (Object.keys(selectedTypes).length > 0) {
            document.getElementById("cart").style.display = "flex";
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const cartItem = JSON.parse(localStorage.getItem("cartItems"));
        if (Object.keys(cartItem).length > 0) {
            for (const item in cartItem) {
                selectedTypes[item] = cartItem[item];
            }
        }

        for (const type in selectedTypes) {
            const id = type;
            const value = selectedTypes[type];
            if (document.getElementById(`num-${id}`)) {
                document.getElementById(`num-${id}`).value = value;
                checkcount(selectedTypes, id);
                checkCart();
            } else {
                checkCart();
                continue;
            }
        }
    })

    checkcount = (selectedTypes, id) => {
        if (selectedTypes[id] === 0) {
            delete selectedTypes[id];
            document.getElementById(`add-type-${id}`).style.display = 'block';
            document.getElementById(`change-type-${id}`).style.display = 'none';
        } else if (selectedTypes[id] > 0) {
            document.getElementById(`add-type-${id}`).style.display = 'none';
            document.getElementById(`change-type-${id}`).style.display = 'block';
        }
        localStorage.setItem("cartItems", JSON.stringify(selectedTypes));
    }

    addItem = (e) => {
        const type_id = e.target.id.replace(`add-type-`, '');
        selectedTypes[type_id] = 1;
        // localStorage.setItem("cartItems", JSON.stringify(selectedTypes));
        document.getElementById(`num-${type_id}`).value = selectedTypes[type_id];
        checkcount(selectedTypes, type_id);
        checkCart();
    }

    function minus(e) {
        const type_id = e.target.id.replace(`minus-`, '');
        selectedTypes[type_id]--;
        // localStorage.setItem("cartItems", JSON.stringify(selectedTypes));
        document.getElementById(`num-${type_id}`).value = selectedTypes[type_id];
        checkcount(selectedTypes, type_id);
        checkCart();
    }
    function plus(e) {
        const type_id = e.target.id.replace(`plus-`, '');
        selectedTypes[type_id]++;
        // localStorage.setItem("cartItems", JSON.stringify(selectedTypes));
        document.getElementById(`num-${type_id}`).value = selectedTypes[type_id];
        checkcount(selectedTypes, type_id);
        checkCart();
    }

    submitCart = () => {
        const selectedTypesJson = JSON.stringify(selectedTypes);
        localStorage.setItem("cartItems", selectedTypesJson);

        document.getElementById("hiddenField").value = selectedTypesJson;
        document.getElementById("formToSubmit").submit();

    }
</script>

<script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>