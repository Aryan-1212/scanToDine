<?php

include('../commonPages/dbConnect.php');
include('../commonPages/redirectPage.php');

if (!isset($_SESSION)) {
    session_start();
}

if ($_POST) {
    $res_code = $_SESSION['res_code'];
    $table_num = $_SESSION['table_num'];
    date_default_timezone_set("Asia/Calcutta");
    $cid = $_SESSION['uid'];
    $date_time = date("Y-m-d h:i:s");
    $orderDet = $_POST['orderDet'];
    $amount = $_POST['totalPrice'];
    $order_status = 'placed';

    $queryToInsert = "insert into orders(cus_id, order_date, table_num, res_id, items_det, amount, order_status) values($cid, '$date_time', $table_num, $res_code, '$orderDet', $amount, '$order_status')";

    $insertRow = mysqli_query($con, $queryToInsert);
    reDirect("../customerModule/orderSubmit.php");
}
header("Location: ../customerModule/orderStatus.php");
?>