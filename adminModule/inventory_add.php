<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include('../commonPages/dbConnect.php');
    $res_code = $_SESSION['res_code'];

    if(isset($_POST['cat_name'])){
        $cat_name = $_POST['cat_name'];
        $cat_array = array($cat_name);

        $isAnyCatQuery = "select DISTINCT * from inventory where res_code=$res_code and additional_category!='null'";
        $isAnyCat = mysqli_query($con, $isAnyCatQuery);
        if(mysqli_num_rows($isAnyCat) == 0){
            $json_cat_name = json_encode($cat_array);
            $insertCatQuery = "update inventory set additional_category = '$json_cat_name' where res_code=$res_code";
            $insertCat = mysqli_query($con, $insertCatQuery);
            header('location: ../adminModule/inventory.php');
        }else{
            $data = mysqli_fetch_assoc($isAnyCat);
            $alreadyCat = json_decode($data['additional_category'], true);
            array_push($alreadyCat, $cat_name);
            $updatedAlreadyCat = json_encode($alreadyCat);
            $insertCatQuery = "update inventory set additional_category = '$updatedAlreadyCat' where res_code=$res_code";    
            $insertCat = mysqli_query($con, $insertCatQuery);
            header('location: ../adminModule/inventory.php');
        }
    }else{
        $_SESSION['is_error'] = false;
        $item_name = $_POST['item_name'];
        $item_cat = $_POST['item_cat'];
        $item_qun = $_POST['item_qun'];
        $mes_unit = $_POST['mes_unit'];
        $today_date = date("Y-m-d");

        $insert_record = "insert into inventory(res_code, item_name, item_qun, mes_unit, category, date_added) values($res_code, '$item_name', $item_qun, '$mes_unit', '$item_cat', '$today_date')";

        $isAnyCatQuery = "select DISTINCT * from inventory where res_code=$res_code and additional_category!='null'";
        $isAnyCat = mysqli_query($con, $isAnyCatQuery);
        if(mysqli_num_rows($isAnyCat) != 0){
            $data = mysqli_fetch_assoc($isAnyCat);
            $alreadyCat = $data['additional_category'];
            $insert_record = "insert into inventory(res_code, item_name, item_qun, mes_unit, category, additional_category, date_added) values($res_code, '$item_name', $item_qun, '$mes_unit', '$item_cat', '$alreadyCat', '$today_date')";
        }
            
        $query = mysqli_query($con, $insert_record);
        if(!$query){
            $_SESSION['is_error'] = true;
            header('location: ../adminModule/inventory.php');
        }else{
            header('location: ../adminModule/inventory.php');
        }
    }
?>