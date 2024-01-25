<?php
if (!isset($_SESSION)) {
    session_start();
}
$res_code = $_SESSION['res_code'];
include("../commonPages/dbConnect.php");
include("../commonPages/redirectPage.php");

if(isset($_POST['deleteQRs'])){
    $deleteQuery = "delete from tables where res_id = $res_code";
    $delete = mysqli_query($con, $deleteQuery);
    if(!$delete){
        echo "<script>alert('Unexpected Error Occurs!');<script>";
    }
    reDirect("../adminModule/qrAdmin.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>QR Code Generator</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .qrHeading h1 {
            text-align: center;
            /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); */
        }

        .qrGenerator {
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* padding: 20px; */
            background-color: lightsteelblue;
        }

        .qrGenerator .numForm {
            display: flex;
            justify-content: center;
        }

        .qrGenerator h3 {
            text-decoration: underline;
        }

        label {
            text-align: center;
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
        }

        #tableCountInput {
            padding: 10px;
            font-size: 16px;
            border-color: black;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 60px;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }


        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: rgb(3, 3, 165);
            transform: scale(1.02);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .btn {
            padding: 10px 20px;
            background-color: #cc2828;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            transition-duration: 0.7s;
            color: black;
            background-color: #a9f33b;
        }


        .qrCodes {
            min-height: calc(100vh - 230px - 40px);
            background-color: whitesmoke;
            padding: 20px;
            transition: opacity 0.5s ease-in-out;
            background-color: lightsteelblue;
        }


        #qrCodeContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        #qrCodeContainer .qr-img {
            height: 450px;
            width: 400px;
            display: grid;
        }

        #qrCodeContainer .qr-img .img {
            height: 400px;
        }

        #qrCodeContainer .qr-img .img .qr {
            height: 100%;
            width: 100%;
        }

        #qrCodeContainer .qr-img .download {
            height: 50px;
            display: flex;
            justify-self: center;
            align-items: center;
        }

        #qrCodeContainer .qr-img .download a {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: green;
            border-radius: 5px;
        }

        #qrCodeContainer .qr-img .download a:hover {
            background-color: rgb(3, 96, 3);
            transition-duration: 0.7s;
            border-radius: 10px;
        }

        .no-qr {
            display: flex;
            justify-content: center;
            color: red;
        }

        .btns {
            height: 80px;
            align-items: center;
            display: flex;
            width: 400px;
            /* background-color: blue; */
            justify-content: space-evenly;
        }
    </style>
</head>

<body>

    <?php
    $checkQRAvailableQuery = "select * from tables where res_id = $res_code";
    $checkQRAvailable = mysqli_query($con, $checkQRAvailableQuery);
    if (mysqli_num_rows($checkQRAvailable) == 0) {
        ?>
        <div class='qrGenerator'>
            <div class='qrHeading'>
                <h1>Generate QR Code</h1>
            </div>
            <label for='tableCountInput'>Enter the number of tables to generate QR codes for tables:</label>
            <div class="numForm">
                <form action='../adminModule/qrGenerateQR.php' method='POST'>
                    <input type='number' id='tableCountInput' min='1' name='num'>
                    <input type='hidden' name='res_code' value='<?php echo $res_code; ?>'>
                    <input type='submit' class='btn' value='Submit'>
                </form>
            </div>
        </div>

        <div class="qrCodes no-qr">
            <p>No QR codes Available</p>
        </div>

        <?php
    } else {
        $data = mysqli_fetch_all($checkQRAvailable, MYSQLI_ASSOC);
        ?>
        <div class='qrGenerator'>
            <div class='qrHeading'>
                <h1>QR Codes</h1>
            </div>
            <h3>Use these QR codes for your restaurant tables.</h3>
            <label>Customers can get access to your restaurant's menu by scanning these QRs.</label>
            <div class="btns">
                <form action="" method="POST">
                    <!-- <div><a href="" class="btn">Reset QRs</a></div> -->
                    <input type="hidden" name="deleteQRs">
                    <div><input type="submit" class="btn" value="RESET QRs"></div>
                </form>

                <form action="../adminModule/qrGenerateSingleQR.php" method="POST">
                    <!-- <div><a href="" class="btn">Reset QRs</a></div> -->
                    <input type="hidden" name="addQR" value="<?php echo $res_code; ?>">
                    <div><input type="submit" class="btn" value="ADD a QR"></div>
                </form>
            </div>
        </div>

        <div class="qrCodes">
            <div id="qrCodeContainer">
                <?php
                foreach ($data as $value) {
                    $tableNum = $value["table_num"];
                    ?>
                    <div class="qr-img">
                        <div class="img">
                            <img src="<?php echo "../qr-images/" . $res_code . "-qr-" . $tableNum . ".png"; ?>" class="qr"
                                alt="">
                        </div>
                        <div class="download">
                            <a href="<?php echo "../qr-images/" . $res_code . "-qr-" . $tableNum . ".png"; ?>" download="">
                                Click To download
                            </a>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

    <script>
        document.getElementById('tableCountInput').addEventListener('input', () => {
            const tableNum = document.getElementById('tableCountInput').value;
        });
    </script>
</body>

</html>