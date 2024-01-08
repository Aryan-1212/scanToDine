<?php
    include('../commonPages/dbConnect.php');
    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION['is_error'] = false;

    $data = json_decode($_POST['data'],true);
    $type_id = $data['type_id'];
    $name = $data['name'];
    $price = $data['price'];
    $des = $data['des'];
    
    $queryToUpdate = "update food_items set type_name='$name', type_price=$price, type_des='$des' where food_type_id=$type_id";
    $updateRecord = mysqli_query($con, $queryToUpdate);
    if(!$updateRecord){
        $_SESSION['is_error'] = true;
        header('Location: menu.php');
    }else{
        header('Location: menu.php');
    }
?>