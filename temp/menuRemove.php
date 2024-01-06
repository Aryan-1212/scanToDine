<?php
    include('../commonPages/dbConnect.php');
    session_start();
    $_SESSION['is_error'] = false;

    $id = $_POST['id'];
    
    $deleteQuery = "delete from food_items where food_type_id=$id";

    $deleteRecord = mysqli_query($con, $deleteQuery);
    if(!$deleteRecord){
        $_SESSION['is_error'] = true;
        header('Location: menu.php');
    }else{
        header('Location: menu.php');
    }
?>