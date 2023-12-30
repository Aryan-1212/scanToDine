<?php
    include("../commonPages/dbConnect.php");

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
    $data = json_decode($_POST['data']);
    $isError = False;
    foreach($data as $key => $values){

        $food_id = substr($key,0,6);
        $food_type_id = generate_unique_code($con);
        $res_id = 421340;
        $type_name = (!$values->name) ? "Undefined":$values->name;
        $type_price = (!$values->price) ? 0:$values->price;
        $type_des = (!$values->des) ? "Undefined":$values->des;  
        echo $type_name;
        echo $type_price;
        echo $type_des;

        $insertQuery = "insert into food_items values($food_type_id, $food_id, $res_id, '$type_name', $type_price, '$type_des')";
        
        $queryStatus = mysqli_query($con, $insertQuery);
        if(!$queryStatus){
            $isError = True;
        }
    }
    header("Location: menu.html");
    

?>