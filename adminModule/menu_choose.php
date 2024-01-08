<?php
    include('../commonPages/dbConnect.php');

    session_start();
    $res_code = $_SESSION['res_code'];
    $checkMenuQuery = "select * from food_items where res_id = $res_code";
    $checkMenuAvailable = mysqli_query($con, $checkMenuQuery);
    if($checkMenuAvailable){
        $data = mysqli_num_rows($checkMenuAvailable);
        if($data>0){
            include("menu.php");
        }else{
            include("menu_select1.php");
        }
    }else{
        echo "<script>alert(Unexpected Error);</script>";
    }
?>