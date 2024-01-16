<?php
if (!isset($_SESSION)) {
    session_start();
}
$res_code = $_SESSION['res_code'];

include("../commonPages/dbConnect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .cart .cartTitle {
        height: 100px;
        background-color: #c81a1a;
        color: white;
        font-size: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .cart .cartDes {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-direction: column;
        margin-top: 20px;
        width: 100vw;
        min-height: calc(100vh - 120px -100px);
    }

    .cart .cartDes .cartItemsHead {
        display: flex;
        background-color: blue;
        width: 100vw;
        height: 50px;
        background-color: whitesmoke;
        justify-content: space-around;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid;
    }

    .cart .cartDes .cartItems {
        display: flex;
        width: 100vw;
        height: 50px;
        justify-content: space-around;
        align-items: center;
        border-bottom: 1px solid whitesmoke;
    }

    .cart .cartDes .flex1 {
        /* text-align: center; */
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1;
    }

    .cart .cartDes .flex2 {
        /* text-align: center; */
        text-align: center;
        display: flex;
        justify-content: center;
        flex: 3;
    }

    .cart .cartDes .charge {
        display: flex;
        width: 100vw;
        height: 50px;
    }

    .cart .cartDes .subtot {
        border-top: 1px solid;
        padding-top: 20px;
        font-weight: 700;
    }

    .cart .cartDes .charge .chargeFlex3 {
        justify-content: right;
        display: flex;
        align-items: center;
        flex: 5;
    }

    .cart .cartDes .charge .chargeFlex1 {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 1;
    }

    .cart .cartDes .total {
        font-weight: 700;
        font-size: 20px;
        background-color: #c81a1a;
        color: white;
    }

    .payToOrder {
        margin: 20px 0px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .payToOrder a {
        text-decoration: none;
        color: black;
    }


    .payToOrder .pay {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 200px;
        background-color: greenyellow;
        height: 40px;
    }

    .payToOrder .pay:hover {
        transition-duration: 0.7s;
        border: 1px solid greenyellow;
        background-color: green;
        color: whitesmoke;
    }
</style>

<body>


    <div class="cart">
        <div class="cartTitle">
            Order Items
        </div>
        <div class="cartDes">

            <div class="cartItemsHead">
                <div class="flex1">No.</div>
                <div class="flex2">Item Name</div>
                <div class="flex1">Price</div>
                <div class="flex1">Qty</div>
                <div class="flex1">Total</div>
            </div>


            <?php

            if(isset($_POST["order"])){
                $orders = json_decode($_POST["order"], true);
                $_SESSION['orders'] = $orders;
            }else{
                $orders = $_SESSION['orders'];
            }

            $index = 1;
            $orderItemsTotal = array();
            foreach ($orders as $id => $qun) {
                $fetchTypeDetailsQuery = "select * from food_items where food_type_id = $id and res_id = $res_code";
                $fetchTypeDetails = mysqli_query($con, $fetchTypeDetailsQuery);
                $data = mysqli_fetch_all($fetchTypeDetails, MYSQLI_ASSOC);
                echo "<br>";
                foreach ($data as $type) {
                    $order_name = $type["type_name"];
                    $order_price = $type["type_price"];
                    $order_des = $type["type_des"];
                    ?>
                    <div class="cartItems">
                        <?php echo "<div class='flex1'>". $index ."</div>" ?>
                        <?php echo "<div class='flex2'>". $order_name ."</div>" ?>
                        <?php echo "<div class='flex1'>". $order_price ."</div>" ?>
                        <?php echo "<div class='flex1'>". $qun ."</div>" ?>
                        <?php
                            $orderItemsTotal[$index] = $order_price*$qun;
                        ?>
                        <?php echo "<div class='flex1'>". $order_price*$qun ."</div>" ?>
                    </div>
                    <?php
                    $index++;
                }
            }
            ?>



            <div class="subtot charge">
                <div class="chargeFlex3">Sub Total:</div>

                <?php
                    $subTotal = 0;
                    foreach($orderItemsTotal as $ItemTotal){
                        $subTotal = $subTotal + $ItemTotal;
                    }
                    echo "<div class='chargeFlex1'>". $subTotal ." ₹</div>";
                ?>
            </div>
            <div class="taxCharges charge">
                <div class="chargeFlex3">Tax(18%):</div>
                <?php
                    $tax = $subTotal * 0.18;
                    $subTotalWithTax = $subTotal + $tax;
                    echo "<div class='chargeFlex1'>". $subTotalWithTax ." ₹</div>";
                ?>
                
            </div>
            <div class="addiCharges charge">
                <div class="chargeFlex3">Additional Charges(20₹):</div>
                <?php
                    $subTotalAddCharge = $subTotalWithTax + 20;
                    echo "<div class='chargeFlex1'>". $subTotalAddCharge ." ₹</div>";
                ?>
                
            </div>
            <div class="discount charge">
                <div class="chargeFlex3">Discount:</div>
                <div class="chargeFlex1">2%</div>
                <?php
                    $discount = $subTotalAddCharge * 0.02;
                    $Total = $subTotalAddCharge - $discount;
                ?>

            </div>
            <div class="total charge">
                <div class="chargeFlex3">Total:</div>
                <?php
                    echo "<div class='chargeFlex1'>₹ ". $Total ."</div>";
                ?>
                
            </div>

        </div>

        <div class="payToOrder">

            <?php
                if(isset($_SESSION['is_registered_cus'])){
                    echo "<a href='#'><div class='pay'>Pay to Order</div></a>";
                }else{
                    echo "<a href='../customerModule/customerRegister.php'><div class='pay'>Register to Proceed</div></a>";
                }
            ?>
        </div>
    </div>
    <script>
        localStorage.getItem("cartItems");




    </script>
</body>

</html>