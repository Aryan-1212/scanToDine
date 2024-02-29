<?php

// function generate_unique_code($con){
//     $random = random_int(100000, 999999);
//     $random_query = mysqli_query($con, "select res_code from users where res_code=$random and role='manager';");
//     if (mysqli_num_rows($random_query) > 0){
//         return generate_unique_code($con);
//     }
//     else{
//         return $random;
//     }
// }


if (!isset($_SESSION)) {
    session_start();
}
$res_code = $_SESSION['res_code'];
include("../commonPages/dbConnect.php");

$user_name = $_POST['name'];
$user_email = strtolower($_POST['email']);
$user_phone = $_POST['phone'];
$password = $_POST['password'];

$_SESSION['is_error'] = false;


if (!$con) {
    ?>
    <script>
        alert("Unexpected error occurred!");
    </script>
    <?php
    exit();
}

$query = mysqli_query($con, "select * from users where (u_phone='$user_phone' or u_email='$user_email') and role='chef';");
if (mysqli_num_rows($query) != 0) {
    $_SESSION['is_error'] = true;
}

if ($_SESSION['is_error']) {
    $_SESSION['name'] = $user_name;
    $_SESSION['email'] = $user_email;
    $_SESSION['phone'] = $user_phone;
    $_SESSION['password'] = $password;
    header("Location: ../adminModule/chefRegister.php");
} else {

    // $res_code = generate_unique_code($con);
    try {
        $insert_users = mysqli_query($con, "insert into users(u_name, u_email, u_phone, password, res_code, role)
            values('$user_name', '$user_email', '$user_phone', '$password', '$res_code', 'chef');");

        if($insert_users){
            $_SESSION['is_error'] = false;
            header("Location: ../adminModule/chef.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['is_error'] = true;
        $_SESSION['name'] = '';
        $_SESSION['email'] = '';
        $_SESSION['phone'] = '';
        $_SESSION['password'] = '';
        header("Location: ../adminModule/chefRegister.php");
    }





    // $fetch_uid = mysqli_query($con, "select u_id from users where u_phone = $user_phone and role='manager';");
    // $data = mysqli_fetch_assoc($fetch_uid);
    // $u_id = $data['u_id'];

    // $insert_restaurant = mysqli_query($con, "insert into restaurant(res_name, res_code, owner_uid, res_address)
    //     values('$res_name', '$res_code', '$u_id', '$res_add')");

}

?>