<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}

$res_code = $_SESSION['res_code'];
include("../commonPages/index_header.php");
include("../commonPages/dbConnect.php");

$numInventoryQuery = mysqli_query($con, "select item_id from inventory where res_code=$res_code");
$numInventory = mysqli_num_rows($numInventoryQuery);

$numFeedbacksQuery = mysqli_query($con, "select * from feedbacks where res_code=$res_code");
$numFeedbacks = mysqli_num_rows($numFeedbacksQuery);
$feedbacks = mysqli_fetch_all($numFeedbacksQuery, MYSQLI_ASSOC);

$numMenuItemsQuery = mysqli_query($con, "select food_type_id from food_items where res_id=$res_code");
$numMenuItems = mysqli_num_rows($numMenuItemsQuery);

$numOrdersQuery = mysqli_query($con, "select * from orders where res_id=$res_code");
$numOrders = mysqli_num_rows($numOrdersQuery);
$orders = mysqli_fetch_all($numOrdersQuery, MYSQLI_ASSOC);

$orders_count = array();

foreach ($orders as $order) {
    $item_det = json_decode($order['items_det'], true);
    foreach ($item_det as $key => $val) {
        if (!strpos($key, '-inst')) {
            $id = substr($key, 0, 8);
            $qun = $item_det[$id];

            if (!array_key_exists($id, $orders_count)) {
                $itemNameQuery = mysqli_query($con, "select type_name from food_items where food_type_id=$id");
                $itemName = mysqli_fetch_array($itemNameQuery)['type_name'];
                $orders_count[$id] = array('y' => $qun, 'label' => $itemName);
            } else {
                $orders_count[$id]['y'] += $qun;
            }
        }
    }
}

$order_details = array();
foreach ($orders_count as $val) {
    array_push($order_details, $val);
}
// $order_details = array(0=>array("y"=>"2","label"=>"no Data"));

$feedback_count = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);
foreach ($feedbacks as $feedback) {

    $rating = $feedback['rating'];
    switch ($feedback['rating']) {
        case 1:
            $feedback_count[1]++;
            break;
        case 2:
            $feedback_count[2]++;
            break;
        case 3:
            $feedback_count[3]++;
            break;
        case 4:
            $feedback_count[4]++;
            break;
        case 5:
            $feedback_count[5]++;
            break;
        default:
            break;
    }
}

$feedback_details = array();
foreach ($feedback_count as $key => $val) {
    $feedback_details[] = array("label" => "Rating Star - $key", "y" => $val);
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
</head>
<style>
    body {
        margin: 0%;
        padding: 0%;
        font-family: 'Poppins';
        /* display: flex; */
        background-color: whitesmoke;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .adminPanel {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
        display: flex;
        flex-wrap: wrap;
        background-color: white;
        height: auto;
        box-shadow: 0 2px 4px rgba(0.5, 0.5, 0.5, 0.9);
    }

    .adminPanel .panelItem {
        width: 48%;
        margin-bottom: 14px;
        padding: 5px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 35px;
        box-sizing: border-box;
        margin-left: 1%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .panelItem .image {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 10%;
    }

    .panelItem .info {
        height: 100px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-size: 25px;
    }

    .graph {
        width: 50%;
        box-sizing: border-box;
        display: flex;
        flex-wrap: wrap;
    }

    .graph1 {
        width: 100%;
        box-sizing: border-box;
        display: flex;
        flex-wrap: wrap;
    }

    .chartContainer {
        width: 100%;
        height: 500px;
        border: 3px solid gray;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }

    .no-data {
        display: flex;
        align-items: center;
        color: red;
        font-size: 30px;
        justify-content: center;
    }

    .admin {
        width: 50%;
        display: flex;
        flex-wrap: wrap;
        height: auto;
        justify-content: space-between;
        height: 550px;
        /* padding: 20px; */
        margin-bottom: 2%;
    }

    #chartContainer1 {
        width: 100%
    }

    #chartContainer {
        width: 100%;
        height: 585px;
        margin-left: 1%;
    }

    .adminPanel .panelItem {
        color: white;
    }

    @media (max-width: 1060px) {
        .admin {
            width: 100%;
            height: auto;
        }

        .graph {
            width: 100%;
        }
    }


    @media (max-width: 768px) {
        .admin {
            width: 100vw;
            height: auto;
            padding: 0px;
        }

        .graph {
            width: 100%;
        }

        .adminPanel .panelItem {
            width: 100%;
        }

        .adminPanel .panelItem img {
            width: 60%
        }
    }

    .canvasjs-chart-credit {
        display: none;
    }

    a:-webkit-any-link {
        /* display: none !important;      */
    }

    .btag {
        font-size: 40px;
    }
</style>

<body>
    <div class="adminPanel">
        <div class="admin">
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="serving-dish.png" id="img">
                </div>
                <div class="info">
                    <b>No. of Orders:</b>
                    <?php
                    echo "<b class='btag'>" . $numOrders . "</b>";
                    ?>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="inventory.png" id="img">
                </div>
                <div class="info">
                    <b>Inventory items:</b>
                    <?php
                    echo "<b class='btag'>" . $numInventory . "</b>";
                    ?>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="feedback2.png" id="img">
                </div>
                <div class="info">
                    <b> No. of feedbacks:</b>
                    <?php
                    echo "<b class='btag'>" . $numFeedbacks . "</b>";
                    ?>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="menu.png" id="img">
                </div>
                <div class="info">
                    <b>Menu items:</b>
                    <?php
                    echo "<b class='btag'>" . $numMenuItems . "</b>";
                    ?>
                </div>
            </div>
        </div>


        <div class="graph">
            <?php
            if (empty($order_details)) {
                echo "<div class='chartContainer no-data'>No DATA</div>";
            } else {
                echo "<div class='chartContainer' id='chartContainer'></div>";
            }
            ?>
        </div>
        <?php
        foreach ($feedback_details as $val) {
            $is_rating_available = ($val['y'] != 0) ? true : false;
        }
        ?>

        <div class="graph1">
            <?php
            if (empty($is_rating_available)) {
                echo "<div class='chartContainer no-data'>No DATA</div>";
            } else {
                echo "<div class='chartContainer' id='chartContainer1'></div>";
            }
            ?>
        </div>
    </div>

    <?php
    include("../commonPages/index_footer.html");
    ?>

</body>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Maximum dishes that have been served"
            },
            axisY: {
                title: "No. of orders"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## orders",
                dataPoints: <?php echo json_encode($order_details, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart1 = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            title: {
                text: "Ratings from the customer"
            },
            subtitles: [{
                text: "Number of Ratings"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.\" Customer\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($feedback_details, JSON_NUMERIC_CHECK); ?>
            }]
        });

        chart1.render();

    }

</script>

</html>