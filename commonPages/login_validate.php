<?php
    session_start();
    $phone = $_POST['phone'];
    $password = $_POST['password'];
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
    $query = mysqli_query($con, "select * from users where u_phone='$phone';");
    if (mysqli_num_rows($query)==0){
        $_SESSION['is_error']=true;
    }

    $data = mysqli_fetch_assoc($query);
    $pass = $data['password'];
    $res_code = $data['res_code'];

    if ($pass != $password){
        $_SESSION['is_error']=true;
    }

    if($_SESSION['is_error']){
        $_SESSION['phone'] = $phone;
        $_SESSION['password'] = $password;
        mysqli_close($con);
        header("Location: login.php");
    }
    else{
        session_destroy();
        mysqli_close($con);
        session_start();
        $_SESSION['is_login'] = true;
        $_SESSION['res_code'] = $res_code;
        header("Location: ../adminModule/adminMain.php");
    }
?>