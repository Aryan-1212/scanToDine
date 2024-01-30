<?php
if (!isset($_SESSION)) {
    session_start();
}

include("../commonPages/dbConnect.php");
include("../commonPages/redirectPage.php");
$res_code = $_SESSION['res_code'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

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

        .no-orders{
            display: flex;
            align-items: center;
            color: red;
            justify-content: center;
            height: calc(100vh - 250px);
        }
    </style>

</head>

<body>
    <?php
    include("../commonPages/index_header.php");

    $fetchOrdersQuery = "select * from orders where res_id = $res_code;";
    $fetchOrders = mysqli_query($con, $fetchOrdersQuery);
    if (!$fetchOrders) {
        echo "<script>alert('Unexpected Error Occurs!');</script>";
    }
    if(mysqli_num_rows($fetchOrders)>0){
    $orders = mysqli_fetch_all($fetchOrders, MYSQLI_ASSOC);
    ?>

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
                <div class="flex1">Order-Status</div>
            </div>

            <?php
            foreach ($orders as $order) {
                $order_id = $order['order_id'];
                $cus_id = $order['cus_id'];
                $order_date = $order['order_date'];
                $table_num = $order['table_num'];
                $items_det = $order['items_det'];
                $amount = $order['amount'];
                $order_status = $order['order_status'];
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
                                if (trim($itemDetails[$item_no]['note']) == '') {
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
                    if($order_status == 'placed'){
                        echo "<div class='flex1' style='color: green;'>Ongoing</div>";
                    }else{
                        echo "<div class='flex1' style='color: red;'>" . ucfirst($order_status) . "</div>";
                    }
                    ?>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
    <?php
    }else{
    ?>
    <div class="no-orders">
        <h2>No Orders Available!</h2>
    </div>
    <?php
    }
    include("../commonPages/index_footer.html");
    ?>
</body>

</html>