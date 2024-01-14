<?php
include("../commonPages/index_header.php");

/*$link = mysqli_connect("localhost", "root", "", "admin_info"); //taru je database hoi ae muki deje

$test = array();
$count = 0;

$res = mysqli_query($link, "select * from dishes"); // taru je table hoi ae muki deje

while ($row = mysqli_fetch_array($res)) {
    $test[$count]["label"] = $row["Dishes"]; 
    $test[$count]["y"] = $row["no_of_orders"];
    $count = $count + 1;
}

$test1 = array();
$count1 = 0;

$res1 = mysqli_query($link, "select * from feedback"); // taru je table hoi ae muki deje

while ($row1 = mysqli_fetch_array($res1)) {
    $test1[$count1]["label"] = $row1["Ratings"];
    $test1[$count1]["y"] = $row1["no_of_customer"];
    $count1 = $count1 + 1;
}

mysqli_close($link);*/

//kindly remove below static data while you creating dynamic charts

$test = array(
    array("y" => 3373.64, "label" => "Germany"),
    array("y" => 2435.94, "label" => "France"),
    array("y" => 1842.55, "label" => "China"),
    array("y" => 1828.55, "label" => "Russia"),
    array("y" => 1039.99, "label" => "Switzerland"),
    array("y" => 765.215, "label" => "Japan"),
    array("y" => 612.453, "label" => "Netherlands")
);
$test1 = array(
    array("label" => "Chrome", "y" => 64.02),
    array("label" => "Firefox", "y" => 12.55),
    array("label" => "IE", "y" => 8.47),
    array("label" => "Safari", "y" => 6.08),
    array("label" => "Edge", "y" => 4.29),
    array("label" => "Others", "y" => 4.59)
)
    ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<style>
    body {
        margin: 0%;
        padding: 0%;
        font-family: 'Poppins';
        /* display: flex; */
        background-color: whitesmoke;
    }

    ::-webkit-scrollbar{
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
        height:100px ;
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
        height: 500px;
        border: 3px solid gray;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
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

    .canvasjs-chart-credit{
        display: none;
    }

    a:-webkit-any-link {
        /* display: none !important;      */
    }
    .btag{
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
                    <b class="btag"> 120 </b>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="inventory.png" id="img">
                </div>
                <div class="info">
                    <b>Inventory items:</b>
                    <b class="btag"> 120 </b>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="feedback2.png" id="img">
                </div>
                <div class="info">
                    <b> No. of feedbacks:</b>
                    <b class="btag"> 120 </b>
                </div>
            </div>
            <div class="panelItem" style="background-color: #e83010;">
                <div class="image">
                    <img src="menu.png" id="img">
                </div>
                <div class="info">
                    <b>Menu items:</b>
                    <b class="btag"> 120 </b>
                </div>
            </div>
        </div>
        <div class="graph">
            <div class="chartContainer" id="chartContainer"></div>
        </div>
        <div class="graph1">
            <div class="chartContainer" id="chartContainer1"></div>
        </div>
    </div>
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
                dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart1 = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            title: {
                text: "Reviews of the customer"
            },
            subtitles: [{
                text: "No. of customer"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.\" Customer\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($test1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();

    }

</script>

</html>