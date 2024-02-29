<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}

include("../commonPages/dbConnect.php");
include("../commonPages/redirectPage.php");
$res_code = $_SESSION['res_code'];
$_SESSION['wrong_code'] = false;
date_default_timezone_set("Asia/Calcutta");

if (isset($_POST['verification_code'])) {
    $code = $_POST['verification_code'];
    $date_time = date("Y-m-d h:i:s");

    $verifyCodeQuery = "select order_id from orders where res_id=$res_code and completion_code=$code and order_status='placed'";
    $verifyCode = mysqli_query($con, $verifyCodeQuery);
    if (mysqli_num_rows($verifyCode) > 0) {
        $order_id = mysqli_fetch_assoc($verifyCode)['order_id'];
        $updateStatusQuery = "update orders set order_finish_date = '$date_time', order_status='finished' where order_id=$order_id;";
        $updateStatus = mysqli_query($con, $updateStatusQuery);
        if (!$updateStatus) {
            echo "<script>Unexpected Error Occurs!</script>";
        }
        reDirect("../adminModule/orders.php");

    } else {
        echo "<script>alert('Enter a Valid Code to Finish Order!');</script>";
        // reDirect("../adminModule/orders.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        * {
            padding: 0;
            margin: 0;
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

        body.popup-open {
            overflow: hidden;
        }

        .orders-div {
            width: 100%;
            min-height: calc(100vh - 410px);
            height: auto;
            background-color: lightsteelblue;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 80px 0px;
        }

        .pop-up {
            /* position: absolute; */
            position: fixed;
            background-color: whitesmoke;
            background-color: rgb(216, 216, 216);
            /* border: 2px solid black; */
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
            top: 25%;
            left: 25%;
            height: 50vh;
            width: 50vw;
            z-index: 3;
            padding: 20px;
            box-sizing: border-box;
            display: none;
        }

        .pop-up .close-btn {
            position: absolute;
            right: 0;
            top: 0;
        }

        .pop-up .close-btn button {
            padding: 10px;
            background-color: red;
            border-top-right-radius: 10px;
            color: white;
            border: none;
            cursor: pointer;
        }

        .pop-up .close-btn button:hover {
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        }

        .pop-up .title {
            margin-top: 40px;
            font-size: 20px;
            width: 100%;
            text-align: center;
        }

        .pop-up .code-input {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pop-up .code-input input {
            border: none;
            background-color: transparent;
            margin: 7px 0px;
            border-bottom: 1px solid black;
            padding: 10px;
            text-align: center;
            font-size: large;
        }

        .pop-up .verify-btn {
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pop-up .verify-btn .button {
            background-color: green;
            border-radius: 10px;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            padding: 5px 20px;
        }

        .pop-up .verify-btn .button:hover {
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        }

        .pop-up .note {
            text-align: center;
            font-size: 15px;
        }

        .orders {
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
            width: 90vw;
            height: auto;
            background-color: whitesmoke;
            overflow-x: scroll;
        }

        .orders-div .order-index {
            width: 1382px;
            height: 50px;
            background-color: lightslategray;
            display: flex;
            align-items: center;
            color: white;
        }

        .orders-div .flex1 {
            flex: 1;
            display: flex;
            justify-content: center;
            text-align: center;
            /* margin: 0px 30px; */
        }

        .orders-div .flex3 {
            flex: 3;
            display: flex;
            justify-content: center;
            text-align: center;
            /* margin: 0px 50px; */
        }

        .orders-div .order {
            width: 1382px;
            background-color: whitesmoke;
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;

            height: auto;
            padding: 20px 0px;
            /* height: 200px; */
            display: flex;
            align-items: center;
        }

        .item-det {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgb(216, 216, 216);
            width: 100%;
        }

        .item-name {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .item-note {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .item-det p {
            margin: 10px 0px;
            text-align: center;
        }

        .btn {
            padding: 10px;
            background-color: #cc2828;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #a9f33b;
            color: black;
            transition-duration: 0.5s;
        }

        .no-orders {
            display: flex;
            align-items: center;
            color: red;
            justify-content: center;
            height: calc(100vh - 250px);
        }

        .wrong-code {
            color: red;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media screen and (max-width: 900px) {
            .pop-up {
                width: 70vw;
                left: 15%;
            }

            .pop-up .title {
                font-size: 15px;
            }

            .pop-up .code-input input {
                width: 30%;
                padding: 5px 10px;
                font-size: smaller;
            }
        }

        @media screen and (max-width: 490px) {
            .pop-up {
                width: 90vw;
                left: 5%;
                height: 70vh;
                top: 15%;
                padding-top: 50px;
            }
        }
    </style>

</head>

<body>
    <?php
    include("../commonPages/index_header.php");

    $fetchOrdersQuery = "select * from orders where res_id = $res_code and order_status = 'placed'";
    $fetchOrders = mysqli_query($con, $fetchOrdersQuery);
    if (!$fetchOrders) {
        echo "<script>alert('Unexpected Error Occurs!');</script>";
    }
    if (mysqli_num_rows($fetchOrders) > 0) {
        $orders = mysqli_fetch_all($fetchOrders, MYSQLI_ASSOC);
        ?>

        <div class="pop-up" id="pop-up-box">
            <div class="close-btn"><button onclick="closeBtn()">Close</button></div>
            <div class="title">
                <p>Verification Required: Please Validate the Code to Proceed with Order Completion.</p>
            </div>
            <form action="" method="post">
                <div class="code-input">
                    <input type="text" minlength="6" maxlength="6" name="verification_code"
                        placeholder="Code to complete order" Required>
                </div>
                <div class="verify-btn">
                    <input type="submit" class="button" value="VERIFY">
                </div>
            </form>
            <div class="note">
                <p>Kindly Request Your Customer for a 6-digit Completion Code for This Order(orderID- <span
                        id='order-id'></span>)</p>
            </div>
        </div>

        <div class="orders-div" id="orders-div">

            <div class="orders">
                <div class="order-index">
                    <div class="flex1">Order-ID</div>
                    <div class="flex3">Item-Details</div>
                    <div class="flex1">Quantity</div>
                    <div class="flex1">Notes</div>
                    <div class="flex1">Amount</div>
                    <div class="flex1">Table-Num</div>
                    <div class="flex1">Cus-ID</div>
                    <div class="flex1">Order-Date</div>
                    <div class="flex1">&nbsp;</div>
                </div>

                <?php
                foreach ($orders as $order) {
                    $order_id = $order['order_id'];
                    $cus_id = $order['cus_id'];
                    $order_date = $order['order_date'];
                    $table_num = $order['table_num'];
                    $items_det = $order['items_det'];
                    $amount = $order['amount'];
                    $items_det_array = json_decode($items_det, true);
                    ?>

                    <div class="order">
                        <div class="flex1">
                            <?php echo $order_id; ?>
                        </div>

                        <?php
                        $itemDetails = array();
                        $index = 1;
                        foreach ($items_det_array as $itemId => $val) {
                            if (!str_contains($itemId, 'inst')) {
                                $fetchItemDetQuery = "select * from food_items where res_id = $res_code and food_type_id = $itemId;";
                                $fetchItemDet = mysqli_query($con, $fetchItemDetQuery);
                                $itemDet = mysqli_fetch_assoc($fetchItemDet);
                                $itemDetails[$index] = array("name" => $itemDet['type_name'], "qun" => $val, "note" => $items_det_array["$itemId-inst"]);
                                $index++;
                            }
                        }
                        ?>

                        <div class="flex3">
                            <div class="item-det item-name">
                                <?php
                                for ($item_no = 1; $item_no <= count($itemDetails); $item_no++) {
                                    echo "<div class='name'><p>" . $itemDetails[$item_no]['name'] . "</p></div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex1">
                            <div class="item-det item-qun">
                                <?php
                                for ($item_no = 1; $item_no <= count($itemDetails); $item_no++) {
                                    echo "<div class='qun'><p>" . $itemDetails[$item_no]['qun'] . "</p></div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex1">
                            <div class="item-det item-note">
                                <?php
                                for ($item_no = 1; $item_no <= count($itemDetails); $item_no++) {
                                    if (trim(strval($itemDetails[$item_no]['note'])) == '') {
                                        echo "<p>-</p>";
                                    } else {
                                        echo "<marquee behavior='scroll' direction='left' scrollamount='2'><p>" . $itemDetails[$item_no]['note'] . "</p></marquee>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        echo "<div class='flex1'>" . $amount . "</div>";
                        echo "<div class='flex1'>" . $table_num . "</div>";
                        echo "<div class='flex1'>" . $cus_id . "</div>";
                        echo "<div class='flex1'>" . $order_date . "</div>";
                        ?>

                        <div class="flex1"><button class="btn" id="<?php echo "finishOrder-" . $order_id; ?>"
                                onclick="finishOrder(event)">FINISH</button></div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="no-orders">
            <h2>No Orders Available!</h2>
        </div>
        <?php
    }
    ?>

    <?php
    include("../commonPages/index_footer.html");
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pop_up_box = document.getElementById("pop-up-box");
            // const finishOrderBtn = document.getElementById("finishOrder");

            let finishOrderBtn;
            finishOrder = (e) => {
                pop_up_box.style.display = "block";
                document.body.classList.add("popup-open");
                const id = e.target.id;
                finishOrderBtn = document.getElementById(id);
                document.getElementById('order-id').innerHTML = id.replace('finishOrder-', '');
                document.getElementById("orders-div").style.filter = "blur(8px)";
            }

            closeBtn = () => {
                pop_up_box.style.display = "none";
                document.body.classList.remove("popup-open");
                document.getElementById("orders-div").style.filter = "blur(0px)";
            }

            document.addEventListener("click", function (event) {
                if (!pop_up_box.contains(event.target) && event.target !== finishOrderBtn) {
                    pop_up_box.style.display = "none";
                    document.body.classList.remove("popup-open");
                    document.getElementById("orders-div").style.filter = "blur(0px)";
                }
            })
        })

    </script>
</body>

</html>