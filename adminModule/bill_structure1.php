<?php
if (!isset($_SESSION)) {
    session_start();
}
include("../commonPages/dbConnect.php");
include("../commonPages/redirectPage.php");
$res_code = $_SESSION['res_code'];

if (isset($_POST['ChangedData'])) {
    $change_data = json_decode($_POST['ChangedData'],true);
    $tax = (trim($change_data['tax'])=='')?0:$change_data['tax'];
    $charges = (trim($change_data['charges'])=='')?0:$change_data['charges'];
    $discount = (trim($change_data['discount'])=='')?0:$change_data['discount'];
    $upi = (trim($change_data['upi'])=='')?'-':$change_data['upi'];

    $updateRowQuery = "update bill_info set tax_rate=$tax, add_charge=$charges, dis=$discount, upi_id='$upi' where res_code = $res_code";

    $updateRow = mysqli_query($con, $updateRowQuery);
    if (!$updateRow) {
        echo "<script>alert('Unexpected Error Occurs!');</script>";
    }else{
        reDirect("../adminModule/bill_structure1.php");
    }
}


if (isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);
    $tax = (trim($data['tax'])=='')?0:$data['tax'];
    $charges = (trim($data['charges'])=='')?0:$data['charges'];
    $discount = (trim($data['discount'])=='')?0:$data['discount'];
    $upi = (trim($data['upi'])=='')?'-':$data['upi'];

    $insertRowQuery = "insert into bill_info(res_code, tax_rate, add_charge, dis, upi_id) values($res_code, $tax, $charges, $discount, '$upi')";
    $insertRow = mysqli_query($con, $insertRowQuery);
    if (!$insertRow) {
        echo "<script>alert('Unexpected Error Occurs!');</script>";
    }else{
        reDirect("../adminModule/bill_structure1.php");
    }
}
$fetchRow = mysqli_query($con, "select * from bill_info where res_code=$res_code");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add TAX into BillBody</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body {
            background-color: lightsteelblue;
            font-family: 'Poppins', sans-serif;
        }

        .AddTax .AddContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            margin-bottom: 100px;
            box-shadow: 0 0 5pt 2pt #414141;
            background-color: white;
        }

        .AddTax .AddContainer .AddText {
            padding: 100px 50px;
            width: 90%;
        }

        .AddTax .AddContainer .AddText th,
        td {
            padding: 5px 15px;
            color: black;
        }

        .AddTax .AddContainer .AddText table {
            width: 100%;
        }

        .AddTax .AddContainer .AddText input[type=number],
        input[type=text] {
            width: 100%;
            transition: 0.5s;
            border: 0;
            outline: 0;
            border-bottom: 2px solid black;
            color: black;
        }

        .AddTax .AddContainer .AddText input[type=Submit] {
            padding: 12px 25px;
            font-size: large;
        }

        @media screen and (max-width: 992px) {
            .AddTax .AddContainer {
                flex-wrap: wrap;
            }

            .AddTax .AddContainer .AddText {
                padding: 20px 10%;
                width: 100%;
            }

            .AddTax .AddContainer .AddText input[type=number],
            input[type=text] {
                width: 100%;
            }

            .ViewBill {
                margin: 50px 80%;
                width: 100px;
            }
        }

        @media screen and (max-width: 600px) {
            .AddTax .AddContainer .AddText {
                padding: 20px 30px;
                width: 100%;
            }
        }

        .ViewBill {
            margin: 50px 93%;
            width: 100px;
        }

        .btn {
            padding: 10px 15px;
            background-color: #cc2828;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 10px;
        }

        .btn:hover {
            background-color: #a9f33b;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            color: black;
            /* transition-duration: 0.5s; */
        }

        #taxWarning {
            /* color: red; */
        }
    </style>
</head>

<body>

    <?php
        include("../commonPages/index_header.php");
    ?>

    <section class="AddTax">
        <div class="container">
            <div class="ViewBill">
                <a class="btn" href="../adminModule/bill_structure2.php">View Bill</a>
            </div>
            <div class="AddContainer">
                <div class="AddText" id="addText">


                    <?php
                    if (mysqli_num_rows($fetchRow) > 0) {
                        $data = mysqli_fetch_assoc($fetchRow);
                        $id = $data['id'];
                        $tax = $data['tax_rate'];
                        $add_charge = $data['add_charge'];
                        $dis = $data['dis'];
                        $upi = $data['upi_id'];
                        ?>
                        <table>
                            <tr>
                                <th>Tax rates:</th>
                                <td id="tax"><span><?php echo $tax; ?></span></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="taxWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>Additional charges:</th>
                                <td id="charges"><span><?php echo $add_charge; ?></span></td>
                                <td>₹</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td id="discount"><span><?php echo $dis; ?></span></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="discountWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>UPI id:</th>
                                <td id="upi"><span><?php echo $upi; ?></span></td>
                            </tr>
                            <tr>
                                <th id="submitAfterEdit">
                                    <input class="btn" id="updateBtn" onclick="EditData()" type="submit"
                                        value="Edit">
                                </th>
                            </tr>
                        </table>

                        <?php
                    } else {
                        ?>
                        <table>
                            <tr>
                                <th>Tax rates:</th>
                                <td><input type="number" id="tax" oninput="checkTax(event)"
                                        placeholder="Tax rates of your restaurant"></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="taxWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>Additional charges:</th>
                                <td><input type="number" id="charges" placeholder="Any additional charges"></td>
                                <td>₹</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td><input type="number" id="discount" oninput="checkTax(event)" placeholder="Discount">
                                </td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="discountWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>UPI id:</th>
                                <td><input type="text" id="upi" placeholder="UPI id to receive payments"></td>
                            </tr>
                            <tr>
                                <th>
                                    <form action="" id="formToSubmit" method="POST">
                                        <input type="hidden" name="data" id="hiddenData">
                                        <input class="btn" id="submitBtn" onclick="submitData()" type="submit"
                                            value="Submit">
                                    </form>
                                </th>
                            </tr>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
        include("../commonPages/index_footer.html");
    ?>
</body>

<script>
    checkTax = (e) => {
        const id = e.target.id;
        const taxRate = e.target.value;
        if (taxRate < 0 || taxRate > 100) {
            document.getElementById(`${id}Warning`).innerHTML = "Enter a Valid Rate!";
            document.getElementById(`${id}Warning`).style.color = 'red';
            e.target.style.color = 'red';
            document.getElementById('submitBtn').style.display = 'none';
        } else if (taxRate > 0 || taxRate <= 100) {
            e.target.style.color = "black";
            document.getElementById(`${id}Warning`).innerHTML = "";
            document.getElementById('submitBtn').style.display = 'block';
        }
    }

    submitData = () => {
        const data = {};
        data['tax'] = document.getElementById('tax').value;
        data['charges'] = document.getElementById('charges').value;
        data['discount'] = document.getElementById('discount').value;
        data['upi'] = document.getElementById('upi').value;

        const dataJson = JSON.stringify(data);
        document.getElementById("hiddenData").value = dataJson;
        document.getElementById("formToSubmit").submit();
    }

    EditData = () =>{
        const tax = document.getElementById('tax').textContent;
        const charges = document.getElementById('charges').textContent;
        const discount = document.getElementById('discount').textContent;
        const upi = document.getElementById('upi').textContent;

        document.getElementById("addText").innerHTML = `<table>
                            <tr>
                                <th>Tax rates:</th>
                                <td><input type="number" id="tax" value='${tax}' oninput="checkTax(event)"
                                        placeholder="Tax rates of your restaurant"></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="taxWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>Additional charges:</th>
                                <td><input type="number" id="charges" value='${charges}' placeholder="Any additional charges"></td>
                                <td>₹</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td><input type="number" id="discount" value='${discount}' oninput="checkTax(event)" placeholder="Discount">
                                </td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="discountWarning" class="warning"></td>
                            </tr>
                            <tr>
                                <th>UPI id:</th>
                                <td><input type="text" id="upi" value='${upi}' placeholder="UPI id to receive payments"></td>
                            </tr>
                            <tr>
                                <th>
                                    <form action="" id="formToUpdate" method="POST">
                                        <input type="hidden" name="ChangedData" id="changedData">
                                        
                                    </form>
                                    <button class="btn" id="submitBtn" onclick="changeData()">Submit</button>
                                </th>
                            </tr>
                        </table>`;
    }

    changeData = () =>{
        const data = {};
        data['tax'] = document.getElementById('tax').value;
        data['charges'] = document.getElementById('charges').value;
        data['discount'] = document.getElementById('discount').value;
        data['upi'] = document.getElementById('upi').value;

        const dataJson = JSON.stringify(data);
        document.getElementById("changedData").value = dataJson;
        document.getElementById("formToUpdate").submit();
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>