<?php
if (!isset($_SESSION)) {
    session_start();
}
$res_code = $_SESSION['res_code_for_cus'];

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
        text-align: center;
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
        padding: 0px 65px;
        justify-content: center;
        flex: 2;
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
        text-align: right;
    }

    .cart .cartDes .charge .chargeFlex1 {
        margin: 0px 40px;
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

    .input-instruction {
        width: 100%;
        padding: 5px;
        border: none;
        border-bottom: 1px solid black;
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

    @media screen and (max-width:580px) {
        .cartItemsHead{
            font-size: 12px;
        }
        .cart .cartDes .flex2 {
            padding: 0px 10px
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


    <div class="cart">
        <div class="cartTitle">
            Order Items
        </div>
        <div class="cartDes">
            <div class="details">
            <div class="cartItemsHead">
                <div class="flex1">No.</div>
                <div class="flex2">Item Name</div>
                <div class="flex1">Order Instructions</div>
                <div class="flex1">Price</div>
                <div class="flex1">Qty</div>
                <div class="flex1">Total&nbsp;₹</div>
            </div>


            <?php

            if (isset($_POST["order"])) {
                $orders = json_decode($_POST["order"], true);
                $_SESSION['orders'] = $orders;
            } else {
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
                        <?php echo "<div class='flex1'>" . $index . "</div>" ?>
                        <?php //echo "<div class='flex2'>" . $order_name . "</div>" ?>
                        <?php echo "<div class='flex2'><marquee scrollamount='3'>" . $order_name . "</marquee></div>" ?>
                        <?php echo "<div class='flex1'><input id='" . $id . "-instruction' type='text' placeholder='Instruction for Order' class='input-instruction'></div>" ?>
                        <?php echo "<div class='flex1'>" . $order_price . "</div>" ?>
                        <?php echo "<div class='flex1'>" . $qun . "</div>" ?>
                        <?php
                        $orderItemsTotal[$index] = $order_price * $qun;
                        ?>
                        <?php echo "<div class='flex1'>" . $order_price * $qun . "</div>" ?>
                    </div>
                    
                    <?php
                    $index++;
                }
            }

            ?>
            </div>
            <div class="subtot charge">
                <div class="chargeFlex3">Sub Total:</div>

                <?php
                $subTotal = 0;
                foreach ($orderItemsTotal as $ItemTotal) {
                    $subTotal = $subTotal + $ItemTotal;
                }
                echo "<div class='chargeFlex1'>" . $subTotal . "&nbsp;₹</div>";
                ?>
            </div>

            <?php

            $fetchResRatesQuery = "select * from bill_info where res_code = $res_code";
            $fetchResRates = mysqli_query($con, $fetchResRatesQuery);
            if (mysqli_num_rows($fetchResRates) == 0) {
                $tax_rate = 0;
                $add_charge = 0;
                $dis = 0;
                $Total = $subTotal;
            } else {
                $data = mysqli_fetch_assoc($fetchResRates);
                $tax_rate = $data['tax_rate'];
                $add_charge = $data['add_charge'];
                $dis = $data['dis'];
            ?>



            <div class="taxCharges charge">
                <div class="chargeFlex3">
                    <?php echo "Tax(" . $tax_rate . "%):" ?>
                </div>
                <?php
                $tax = ($subTotal * $tax_rate) / 100;
                $subTotalWithTax = $subTotal + $tax;
                echo "<div class='chargeFlex1'>" . $subTotalWithTax . "&nbsp;₹</div>";
                ?>

            </div>
            <div class="addiCharges charge">
                <div class="chargeFlex3">
                    <?php echo "Additional Charges(" . $add_charge . "₹):" ?>
                </div>
                <?php
                $subTotalAddCharge = $subTotalWithTax + $add_charge;
                echo "<div class='chargeFlex1'>" . $subTotalAddCharge . "&nbsp;₹</div>";
                ?>

            </div>
            <div class="discount charge">
                <div class="chargeFlex3">Discount:</div>
                <?php
                    echo "<div class='chargeFlex1'>".$dis."%</div>";
                ?>
                <?php
                $discount = ($subTotalAddCharge * $dis) / 100;
                $Total = $subTotalAddCharge - $discount;
                ?>
            </div>

            <?php
            }
            ?>
            <div class="total charge">
                <div class="chargeFlex3">Total:</div>
                <?php
                echo "<div class='chargeFlex1'>" . $Total. "&nbsp;₹</div>";
                ?>
            </div>

        </div>

        <div class="payToOrder">

            <form action="../customerModule/orderSubmit.php" method="POST" id="formToSubmit">
                <input type="hidden" id="orderDet" name="orderDet">
                <input type="hidden" name="totalPrice" value="<?php echo $Total; ?>">
            </form>

            <?php
            if (isset($_SESSION['is_registered_cus'])) {
                echo "<a href='#' onclick='submitDet()'><div class='pay'>Pay to Order</div></a>";
            } else {
                echo "<a href='../customerModule/customerRegister.php'><div class='pay'>Register to Proceed</div></a>";
            }
            ?>
        </div>
    </div>
    <script>
        const orderDet = JSON.parse(localStorage.getItem("cartItems"));

        submitDet = () => {
            for (const id in orderDet) {
                const orderInst = document.getElementById(`${id}-instruction`).value;
                orderDet[`${id}-inst`] = orderInst;
            }
            document.getElementById("orderDet").value = JSON.stringify(orderDet);
            document.getElementById("formToSubmit").submit();
        }


    </script>
</body>

</html>