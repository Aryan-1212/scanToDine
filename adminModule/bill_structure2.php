<?php
if (!isset($_SESSION)) {
    session_start();
}

$order_id = $_GET['order_id'];
include("../commonPages/dbConnect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        img {
            width: 100%;
            height: auto;
        }

        .BillStructure .Bill {
            border: 2px solid;
        }

        .BillStructure .BillHeader {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: red;
            height: 250px;
        }

        .BillStructure .BillHeader .BillInvoice {
            width: 50%;
        }

        .BillStructure .BillHeader .BillInvoice h1 {
            margin-left: 5rem;
            position: relative;
        }

        .BillStructure .BillHeader .BillInvoice h1::before {
            content: "";
            position: absolute;
            top: -39%;
            right: 103%;
            height: 80px;
            width: 8px;
            background-color: white;
            display: inline-block;
        }

        .BillStructure .BillHeader .BillImg {
            width: 40%;
        }

        .BillStructure .BillBody .Invoice {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .BillStructure .BillBody .MainBill {
            display: flex;
            justify-content: space-around;
            align-items: center;
            /* flex-direction: column; */
            margin-top: 20px;
        }

        hr {
            margin: 0;
            padding: 0;
        }

        .BillStructure .BillBody .Invoice th {
            padding: 1px 10px;
        }

        .BillStructure .BillBody .Invoice td {
            padding: 1px 10px;
        }

        .BillStructure .BillBody .SubTotal {
            display: flex;
            justify-content: space-between;
        }

        .BillStructure .BillBody .SubTotal table {
            margin: 20px;
        }

        .BillStructure .BillBody .total{
            background-color: red;
            color: white;
        }

        .BillStructure .BillBody .SubTotal th {
            padding: 5px 10px;
            margin: 0;
        }

        .BillStructure .BillBody .SubTotal .Payment {
            margin: 20px;
        }

        .BillStructure .BillBody .SubTotal .Payment p,
        h6 {
            margin: 0;
            padding: 0;
        }

        .BillStructure .BillBody .SubTotal td {
            padding: 5px 10px;
            margin: 0;
        }

        #downloadButton{
            position: fixed;
            top: 5%;
            right: 2%;
            padding: 15px;
            background-color: green;
            border: none;
            border-radius: 49%;
            color: white;
            border: 2px solid white;
        }
        
        #downloadButton:hover{
            background-color: white;
            color: black;
            transition-duration: 0.7s;
            border: 2px solid green;
        }

        @media screen and (max-width: 770px) {
            .BillStructure .BillBody .SubTotal {
                flex-direction: column-reverse;
                justify-content: center;
            }

            .BillStructure .BillBody .SubTotal table {
                margin: 0px;
                width: 100%;
            }
            .BillStructure .BillBody .SubTotal .Payment {
                text-align: center;
            }
            .main-bill-title{
                font-size: 15px;
            }

        }

        @media screen and (max-width: 480px) {
            .BillStructure .BillBody .Invoice {
                flex-direction: column;
                align-items: self-start;
            }
            .main-bill-title{
                font-size: 12px;
            }
            .MainBill{
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <?php
    $fetch_order_details_query = "select * from orders where order_id = $order_id";
    $fetch_order_details = mysqli_query($con, $fetch_order_details_query);
    $order_details = mysqli_fetch_assoc($fetch_order_details);


    $cus_id = $order_details['cus_id'];
    $res_code = $order_details['res_id'];

    $fetch_cus_details_query = "select * from users where u_id = $cus_id";
    $fetch_cus_details = mysqli_query($con, $fetch_cus_details_query);
    $cus_details = mysqli_fetch_assoc($fetch_cus_details);

    $fetch_contact_email_query = "select u_email from users where res_code = $res_code and role='manager'";
    $fetch_contact_email = mysqli_query($con, $fetch_contact_email_query);
    $contact_email = mysqli_fetch_assoc($fetch_contact_email);

    $fetch_bill_details_query = "select * from bill_info where res_code = $res_code";
    $fetch_bill_details = mysqli_query($con, $fetch_bill_details_query);
    $bill_details = mysqli_fetch_assoc($fetch_bill_details);

    $is_tax_available = false;
    $res_upi = '-';
    if(mysqli_num_rows($fetch_bill_details)>0){
        $res_upi = $bill_details['upi_id'];
        $tax = $bill_details['tax_rate'];
        $add_charge = $bill_details['add_charge'];
        $dis = $bill_details['dis'];

        $is_tax_available = true;
    }


    $fetch_res_details_query = "select * from restaurant where res_code = $res_code";
    $fetch_res_details = mysqli_query($con, $fetch_res_details_query);
    $res_details = mysqli_fetch_assoc($fetch_res_details);
    

    // Details about bill, fetching
    
    $cus_name = $cus_details['u_name'];
    $order_date = $order_details['order_date'];
    $table_num = $order_details['table_num'];
    $res_name = $res_details['res_name'];
    $res_address = $res_details['res_address'];
    $contact = $contact_email['u_email'];

    $order = json_decode($order_details['items_det'], true);

    $itemDetails = array(); // itemDetails
    $index = 1;
    foreach ($order as $itemId => $val) {
        if (!str_contains($itemId, 'inst')) {
            $fetchItemDetQuery = "select * from food_items where res_id = $res_code and food_type_id = $itemId;";
            $fetchItemDet = mysqli_query($con, $fetchItemDetQuery);
            $itemDet = mysqli_fetch_assoc($fetchItemDet);
            $itemDetails[$index] = array("name" => $itemDet['type_name'], "price"=> $itemDet['type_price'], "qun" => $val, "note" => $order["$itemId-inst"]);
            $index++;
        }
    }

    

    ?>

    <button id="downloadButton"><i class="fa-solid fa-download fa-2xl"></i></button>

    <section class="BillStructure" id="bill">
        <div class="container">
            <div class="Bill">
                <div class="BillHeader">
                    <div class="BillInvoice">
                        <h1>INVOICE</h1>
                    </div>
                    <div class="BillImg">
                        <img src="burger.png" alt="">
                    </div>
                </div>
                <div class="BillBody">
                    <div class="container">
                        <div class="Invoice">
                            <div class="InvoiceTo">
                                <table>
                                    <tr>
                                        <th>INVOICE TO:</th>
                                        <?php echo "<td>$cus_name</td>"; ?>
                                    </tr>
                                    <tr>
                                        <th>Order Id:</th>
                                        <?php echo "<td>$order_id</td>"; ?>
                                    </tr>
                                    <tr>
                                        <th>Table Num:</th>
                                        <?php echo "<td>$table_num</td>"; ?>
                                    </tr>
                                    <tr>
                                        <th>Pay through UPI:</th>
                                        <?php echo "<td>$res_upi</td>"; ?>
                                    </tr>
                                </table>
                            </div>
                            <div class="InvoiceNo">
                                <table>
                                    <tr>
                                        <th>DATE:</th>
                                        <?php echo "<td>$order_date</td>"; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="MainBill">
                            <div class="No">
                                <h5 class="main-bill-title">NO.</h5>
                                <?php 
                                    foreach($itemDetails as $key=>$val){
                                        echo "<p>$key</p>";
                                    }
                                ?>
                            </div>
                            <div class="ItemDescription">
                                <h5 class="main-bill-title">ITEM DESCRIPTION</h5>
                                <?php 
                                    foreach($itemDetails as $key=>$val){
                                        echo "<p>$val[name]</p>";
                                    }
                                ?>
                            </div>
                            <div class="Price">
                                <h5 class="main-bill-title">PRICE</h5>
                                <?php 
                                    foreach($itemDetails as $key=>$val){
                                        echo "<p>₹$val[price]</p>";
                                    }
                                ?>
                            </div>
                            <div class="Qty">
                                <h5 class="main-bill-title">QTY.</h5>
                                <?php 
                                    foreach($itemDetails as $key=>$val){
                                        echo "<p>$val[qun]</p>";
                                    }
                                ?>
                            </div>
                            <div class="Total">
                                <h5 class="main-bill-title">TOTAL</h5>
                                <?php 
                                    $sub_total = 0;
                                    foreach($itemDetails as $key=>$val){
                                        $total = $val['price'] * $val['qun'];
                                        echo "<p>₹$total</p>";
                                        $sub_total +=$total;
                                    }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="SubTotal">
                            <div class="Payment">
                                <p>Thanks For Your Bussiness</p>
                                <?php
                                    echo "<h6>Restaurant - $res_name</h6>";
                                    echo "<p>Address - $res_address</p>";
                                    echo "<p>Contact - $contact<p>";
                                ?>
                            </div>
                            <div class="Total">
                                <table>
                                    <tr>
                                        <td>SUB TOTAL :</td>

                                        <?php
                                            echo "<th>₹$sub_total</th>";
                                        ?>
                                    </tr>
                                    <?php
                                        if($is_tax_available){
                                    ?>
                                    <tr>
                                        <?php
                                            echo "<td>TAX ($tax%):</td>";
                                            $calculated_tax = ($tax * $sub_total) / 100;
                                            $total_with_tax = $sub_total + $calculated_tax;
                                            echo "<th>₹$total_with_tax</th>";
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                            $total_with_charges = $total_with_tax + $add_charge;
                                            echo "<td>Additional Charges (₹$add_charge):</td>";
                                            echo "<th>₹$total_with_charges</th>";
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                            $calculated_dis = ($dis * $total_with_charges) / 100;
                                            $total_with_dis = $total_with_charges - $calculated_dis;
                                            
                                            // echo "<td>Discount ($dis%):</td>";
                                            // echo "<th>₹$total_with_dis</th>";

                                            echo "<td>Discount:</td>";
                                            echo "<th>$dis%</th>";
                                        ?>
                                    </tr>
                                    <tr class="total">
                                        <th>TOTAL :</th>
                                        <?php
                                            echo "<th>₹$total_with_dis</th>";
                                        ?>
                                    </tr>

                                    <?php
                                        }else{
                                    ?>
                                    <tr class="total">
                                        <th>TOTAL :</th>
                                        <?php
                                            echo "<th>₹$sub_total</th>";
                                        ?>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function downloadPDF() {
                const billContent = document.getElementById('bill');
                
                const options = {
                    margin: 10,
                    filename: 'customer_bill.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                };
                
                html2pdf().set(options).from(billContent).save();

                // html2pdf().from(billContent).set(options).outputPdf(function (pdf) {
                    //     const blob = new Blob([pdf], { type: 'application/pdf' });
                    //     const link = document.createElement('a');
                    //     link.href = window.URL.createObjectURL(blob);
                    //     link.download = options.filename;
                    //     link.click();
                    // });
                }
                
                const downloadButton = document.getElementById('downloadButton');
                
                if (downloadButton) {
                    // Attach the event listener only if the button exists
                    downloadButton.addEventListener('click', downloadPDF);
                }
            });
            
            // const downloadButton = document.getElementById('downloadButton');
            
            // if (downloadButton) {
                //     // Attach the event listener only if the button exists
                //     downloadButton.addEventListener('click', downloadPDF);
                // }

                </script>

<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>

<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</body>

</html>