<?php
if (!isset($_SESSION)) {
    session_start();
}

include("../commonPages/dbConnect.php");
// $res_code = $_SESSION['res_code'];
if (isset($_GET['res_code'])) {
    echo "<script>localStorage.clear();</script>";
    $_SESSION['is_order_ongoing'] = true;
    $res_code = $_GET['res_code'];
    $table_num = $_GET['table_num'];
    $_SESSION['res_code_for_cus'] = $res_code;
    $_SESSION['table_num'] = $table_num;
} else {
    if(!isset($_SESSION['is_order_ongoing'])){
        echo "<script>alert('Please Scan QR to Order!');</script>";
        echo "<h1>Please Scan QR to Order!</h1>";
        exit();
    }
    $res_code = $_SESSION['res_code_for_cus'];
    $table_num = $_SESSION['table_num'];
}
// $res_code = $_SESSION['res_code'];

if(!isset($_SESSION['is_order_ongoing'])){
    echo "<script>alert('Please Scan QR to Order!');</script>";
    echo "<h1>Please Scan QR to Order!</h1>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    </style>

</head>
<style>
    * {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        padding: 0;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .OrderMenu .OrderContainer {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        flex-wrap: wrap;
    }

    .OrderMenu .OrderContainer a {
        text-decoration: none;
        color: black;
    }

    .OrderMenu .OrderContainer .OrderBox {
        width: 250px;
        height: 250px;
        margin: 40px 5px;
        border-radius: 20px;
        transition: all ease-in-out 0.5s;
    }

    .OrderMenu .OrderContainer .OrderBox:hover {
        box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        transform: scale(1.08);
    }

    .OrderMenu .OrderContainer .OrderBox p {
        text-align: center;
        margin-top: 10px;
    }

    .OrderMenu .OrderContainer .OrderBox img {
        border-radius: 20px;
        height: auto;
        width: 100%;
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

    .no-items {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        text-align: center;
    }

    .no-items h1 {
        color: red;
        text-decoration: underline;
    }

    .view-order {
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: end;
        padding: 0px 130px;
    }

    .view-order a {
        padding: 12px 20px;
        color: green;
        text-decoration: none;
        background-color: white;
        border: 1px solid green;
    }

    .view-order a:hover {
        background-color: green;
        color: white;
        transition-duration: 0.7s;
        box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    

    @media only screen and (max-width: 500px) {
        .OrderMenu .OrderContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .view-order {
            font-size: 15px;
            padding: 0px 50px;
        }
        .view-order a {
            padding: 12px 15px;
        }
    }
</style>

<body>

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

    <section class="OrderMenu">
        <div class="container">

            <?php
            $fetchItemsQuery = "select distinct food_id from food_items where res_id=$res_code";
            $fetchItems = mysqli_query($con, $fetchItemsQuery);
            if (mysqli_num_rows($fetchItems) > 0) {
                $data = mysqli_fetch_all($fetchItems, MYSQLI_ASSOC);
                ?>

                <div class="OrderContainer">

                    <?php
                    foreach ($data as $dataItem) {
                        $food_id = $dataItem['food_id'];

                        $fetchItemDetailsQuery = "select * from default_item where item_id=$food_id";
                        $fetchItemDetails = mysqli_query($con, $fetchItemDetailsQuery);
                        $data = mysqli_fetch_all($fetchItemDetails, MYSQLI_ASSOC);
                        foreach ($data as $dataItem) {
                            $item_id = $dataItem['item_id'];
                            $item_name = $dataItem['item_name'];
                            $category = $dataItem['category'];
                            $ext = $dataItem['extension'];
                            ?>

                            <a href="confirmOrder.php?food_id=<?php echo $item_id; ?>">
                                <div class="OrderBox">
                                    <img src="../default_items2/<?php echo $item_id . "-" . $item_name . "-" . $category . "." . $ext ?>"
                                        alt="">
                                    <p>
                                        <?php echo str_replace("_", ' ', ucfirst($item_name)); ?>
                                    </p>
                                </div>
                            </a>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="cart" id="cart">
            <form action="orderCart.php" method="POST" id="formToSubmit">
                <input type="hidden" id="hiddenField" name="order">
                <i onclick="submitCart()" class="fa-solid fa-cart-shopping fa-lg" style="color: #000000;"></i>
            </form>
        </div>

        <?php
            } else {
                ?>
        <div class="no-items">
            <h1>Menu upgrade in progress</h1>
            <h3>Visit our manager for assistance. Thank you for your understanding!</h3>
        </div>
        <?php
            }
            ?>

</body>

<script>
    const selectedTypes = {};

    document.addEventListener("DOMContentLoaded", function () {

        const cartItem = JSON.parse(localStorage.getItem("cartItems"));
        if (Object.keys(cartItem).length > 0) {
            for (const item in cartItem) {
                selectedTypes[item] = cartItem[item];
            }
        }

        if (Object.keys(selectedTypes).length === 0) {
            document.getElementById("cart").style.display = 'none';
        } else if (Object.keys(selectedTypes).length > 0) {
            document.getElementById("cart").style.display = "flex";
        }
    });



    submitCart = () => {
        const selectedTypesJson = JSON.stringify(selectedTypes);

        document.getElementById("hiddenField").value = selectedTypesJson;
        document.getElementById("formToSubmit").submit();

    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>