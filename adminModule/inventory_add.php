<?php
    session_start();
    $_SESSION['is_error'] = false;
    include('../commonPages/dbConnect.php');

    $item_name = $_POST['item_name'];
    $item_cat = $_POST['item_cat'];
    $item_qun = $_POST['item_qun'];
    $mes_unit = $_POST['mes_unit'];

    $today_date = date("Y-m-d");

    $insert_record = "insert into inventory(res_code, item_name, item_qun, mes_unit, category, date_added) values(547902, '$item_name', '$item_cat', '$item_qun', '$mes_unit', '$today_date')";
    $query = mysqli_query($con, $insert_record);
    if(!$query){
        $_SESSION['is_error'] = true;
        header('location: ../adminModule/inventory.php');
    }else{
        header('location: ../adminModule/inventory.php');
    }
?>