<?php
    include('../commonPages/dbConnect.php');
    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION['is_error'] = false;
    $res_code = $_SESSION['res_code'];

    $id = $_POST['id'];
    
    $deleteQuery = "delete from food_items where food_type_id=$id";

    $deleteRecord = mysqli_query($con, $deleteQuery);
    if(!$deleteRecord){
        $_SESSION['is_error'] = true;
        header('Location: menu_choose.php');
    }else{
        header('Location: menu_choose.php');
    }
?>