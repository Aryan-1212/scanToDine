<?php
if (!isset($_SESSION)) {
    session_start();
}
include("../commonPages/dbConnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>

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

        .main-div {
            height: auto;
            background-color: whitesmoke;
            padding: 50px 100px;
        }

        .status-div {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            display: flex;
            flex-direction: column;
        }

        .status-div .status-head {
            height: 100px;
            background-color: #cf3427;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 100px;
        }

        .status-div .status-head .head-title {
            font-size: 35px;
        }

        .status-div .status-animate {
            height: 300px;
            background-color: white;
            display: flex;
            flex-direction: column;
            font-size: 25px;
            justify-content: center;
            align-items: center;
        }

        .status-div .status-animate-title {
            margin: 0px 30px;
            text-align: center;
        }

        .status-div .status-details {
            background-color: #cf3427;
            height: auto;
            min-height: 150px;
            display: flex;
        }

        .status {
            width: 50%;
            display: flex;
            flex-direction: column;
        }


        .status-div .status-details .order-details .details-head {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            display: flex;
            margin: 0px 10px;
            margin-top: 10px;
            text-align: center;
            background-color: whitesmoke;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            padding: 10px;
        }

        .status-div .status-details .order-details .details {
            height: -webkit-fill-available;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            margin: 0px 10px;
            margin-bottom: 10px;
            background-color: whitesmoke;
        }

        .status-div .status-details .order-details .details .detail {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            padding: 10px;
            display: flex;
            text-align: center;

        }

        .flex1 {
            flex: 1;
        }

        .flex2 {
            flex: 2;
        }


        .status-div .status-details .other-details .other-details-head {
            display: flex;
            margin: 0px 10px;
            margin-top: 10px;
            background-color: whitesmoke;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .status-div .status-details .other-details .other-details-head div {
            margin: 0px 10px;
            text-align: center;
        }

        .status-div .status-details .other-details .other-details-body {
            padding: 30px 10px;
            text-align: center;
            background-color: whitesmoke;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            margin: 10px;
            margin-top: 0px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 10px;
            height: 100%;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .status-div .status-details .other-details .other-details-body .total {
            margin: 10px 0px;
            font-size: large;
        }

        .status-div .status-details .other-details .other-details-body h3 {
            font-size: x-large;
            margin: 10px 0px;
        }

        .hr {
            height: 2px;
            margin: 1px 0px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }

        .com-code{
            color: green;
        }
        .finished{
            color: red;
        }

        @media screen and (max-width: 930px) {
            .status-div .status-head {
                padding: 0px 50px;
            }

            .status-div .status-head .head-title {
                font-size: 30px;
            }

            .status-details {
                flex-direction: column;
            }

            .status {
                width: 100%;
            }

            .main-div {
                padding: 50px 50px;
            }
        }

        @media screen and (max-width: 540px) {
            .status-div .status-head {
                flex-direction: column;
                text-align: center;
                padding: 30px 0px;
            }

            .main-div {
                padding: 50px 20px;
            }

            .status-div .status-details .other-details .other-details-head {
                padding: 10px 10px;
                flex-direction: column;
            }

            .status-div .status-details .other-details .other-details-head div {
                margin: 5px 0px;
            }
        }
    </style>

</head>

<body>


    <div class="main-div">
        <div class="status-div">
            <div class="status-head">
                <div class="head-title">
                    Order Status
                </div>
            </div>
            <div class="status-animate">
                <div class="status-animate-title">Preparing Your Order</div>
                <img src="cooking-pot.gif" height="200px" width="200px" alt="">
            </div>


            <?php
            $cus_id = $_SESSION['uid'];
            $res_code = $_SESSION['res_code_for_cus'];
            $fetchOrderDetailsQuery = "select * from orders 
                                        where cus_id = $cus_id and res_id = $res_code
                                        AND TIMESTAMPDIFF(HOUR, order_date, NOW()) <= 24
                                        ORDER BY order_status DESC;";
            $fetchOrderDetails = mysqli_query($con, $fetchOrderDetailsQuery);
            $orderDetails = mysqli_fetch_all($fetchOrderDetails, MYSQLI_ASSOC);
            foreach ($orderDetails as $order) {
                $order_id = $order['order_id'];
                $order_date = $order['order_date'];
                $table_num = $order['table_num'];
                $items_det = $order['items_det'];
                $total = $order['amount'];
                $completion_code = $order['completion_code'];
                $order_status = $order['order_status'];

                $items_det_array = json_decode($items_det, true);

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


                <div class="status-details">
                    <div class="order-details status">
                        <div class="details-head">
                            <div class="flex2">Order Details</div>
                            <div class="flex1">Notes</div>
                        </div>
                        <div class="details">

                            <div class="detail">
                                <?php
                                for ($item_no = 1; $item_no <= count($itemDetails); $item_no++) {
                                    echo "<div class='flex2'>" . $itemDetails[$item_no]['qun'] . " × " . $itemDetails[$item_no]['name'] . "</div>";
                                    echo (trim(strval($itemDetails[$item_no]['note'])) == '') ? "<div class='flex1'>-</div>" : "<marquee behavior='scroll' class='flex1' direction='left' scrollamount='2'>" . $itemDetails[$item_no]['note'] . "</marquee>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="other-details status">
                        <div class="other-details-head">
                            <?php 
                                echo "<div>Order Id- ".$order_id."</div>";
                                echo "<div>Table No- ".$table_num."</div>";
                                echo "<div>".$order_date."</div>";
                            ?>
                        </div>
                        <div class="other-details-body">
                            <?php
                                echo "<div class='total'><p>Total - ".$total." ₹</p></div>";

                                if($order_status == 'placed'){
                                    echo "<h3 class='com-code'>Completion Code - ".$completion_code."</h3>";
                                    echo "<p>Share this code with your restaurant manager only, once you receive your order.</p>";
                                }else{
                                    echo "<h3 class='finished'>Finished<h3>";
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div class="hr"></div>
                <?php
            }
            ?>
        </div>
    </div>



</body>

</html>