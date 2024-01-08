<?php
    function generate_unique_code($con){
        $random = random_int(10000000, 99999999);
        $random_query = mysqli_query($con, "select food_type_id from food_items where food_type_id=$random;");
        if (mysqli_num_rows($random_query) > 0){
            return generate_unique_code($con);
        }
        else{
            return $random;
        }
    }
    
    
    include('../commonPages/dbConnect.php');
    if(!isset($_SESSION)){
        session_start();
    }
    $_SESSION['is_error'] = false;

    $data = json_decode($_POST['data'],true);
    $food_type_id = generate_unique_code($con);
    $item_id = $_POST['item_id'];
    $res_id = $_SESSION['res_code'];
    $name = (!$data['add_type_name']) ? "Undefined":$data['add_type_name'];
    $price = (!$data['add_type_price']) ? 0:$data['add_type_price'];
    $des = (!$data['add_type_des']) ? "Undefined":$data['add_type_des'];
    
    $insertQuery = "insert into food_items values($food_type_id, $item_id, $res_id, '$name', $price, '$des')";
    $insertRecord = mysqli_query($con, $insertQuery);
    if(!$insertRecord){
        $_SESSION['is_error'] = true;
        header('Location: menu.php');
    }else{
        header('Location: menu.php');
    }
?>