<?php 

function generate_unique_code($con){
    $random = random_int(100000, 999999);
    $random_query = mysqli_query($con, "select res_code from users where res_code=$random;");
    if (mysqli_num_rows($random_query) > 0){
        return generate_unique_code($con);
    }
    else{
        return $random;
    }
}

    session_start();
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $password = $_POST['password'];
    $res_name = $_POST['res_name'];
    $res_add = $_POST['res_add'];
    
    $_SESSION['is_error'] = false;

    $con = mysqli_connect("localhost","root","","scantodine");
    if(!$con){
        ?>
            <script>
                alert("Unexpected error occurred!");
            </script>
        <?php
        exit();
    }

    $query = mysqli_query($con, "select * from users where u_phone='$user_phone';");
    if(mysqli_num_rows($query)!=0){
        $_SESSION['is_error'] = true;
    }

    if($_SESSION['is_error']){
        $_SESSION['name']=$user_name;
        $_SESSION['email']=$user_email;
        $_SESSION['phone']=$user_phone;
        $_SESSION['password']=$password;
        $_SESSION['res_name']=$res_name;
        $_SESSION['res_add']=$res_add;
        mysqli_close($con);
        header("Location: register.php");
    }
    else{
        session_destroy();

        $res_code = generate_unique_code($con);
        $insert_users = mysqli_query($con, "insert into users(u_name, u_email, u_phone, password, res_code) 
        values('$user_name', '$user_email', '$user_phone', '$password', '$res_code');");

        $fetch_uid = mysqli_query($con, "select u_id from users where u_phone = $user_phone;");
        $data = mysqli_fetch_assoc($fetch_uid);
        $u_id = $data['u_id'];

        $insert_restaurant = mysqli_query($con, "insert into restaurant(res_name, res_code, owner_uid, res_address)
        values('$res_name', '$res_code', '$u_id', '$res_add')");
        
        mysqli_close($con);
        header("Location: ../adminMain.php");
    }

?>