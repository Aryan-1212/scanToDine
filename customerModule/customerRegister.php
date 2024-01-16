<?php
if (!isset($_SESSION)) {
    session_start();
}

$res_code = $_SESSION['res_code'];
include("../commonPages/dbConnect.php");

$_SESSION['is_error'] = false;
if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $checkUser = mysqli_query($con, "select * from users where u_phone='$phone' and res_code=$res_code and role='customer';");
    if (mysqli_num_rows($checkUser) > 0) {
        $_SESSION['is_error'] = true;
    } else {
        $insertQuery = "insert into users(u_name, u_email, u_phone, password, res_code, role) values('$name', '$email', '$phone', '$password', $res_code, 'customer')";
        $insert = mysqli_query($con, $insertQuery);
        if (!$insert) {
            echo "<script>Unexpected Error Occurs!</script>";
        } else {
            $fetchUid = mysqli_query($con, "select u_id from users where u_phone = '$phone' and res_code=$res_code and role='customer'");
            $data = mysqli_fetch_assoc($fetchUid);
            $uid = $data['u_id'];
            $_SESSION['uid'] = $uid;
            $_SESSION['is_registered_cus'] = true;
            $_SESSION['is_error'] = false;
            $name = NULL;
            $email = NULL;
            $phone = NULL;
            $password = NULL;
            header("Location: ../customerModule/orderCart.php");
        }
    }
}else{
    $_SESSION['is_error'] = false;
        $name = NULL;
        $email = NULL;
        $phone = NULL;
        $password = NULL;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant register</title>
    <link rel="shortcut icon" type="x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        html {
            height: 100%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        :root {
            --red: #cf3427;
            --white: #ffffff;
            --offwhite: whitesmoke;
            --wheat: wheat;
            --black: black;
            --chocolate: chocolate;
            --gray: gray;
            --green: green;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: rgb(255 255 255/var(--tw-bg-opacity));
            width: 100%;
            height: 100%;
            background-color: var(--offwhite);
            border-bottom: 1px solid rgb(224 206 206);
            ;
        }

        header .HeaderContainer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100px;
        }

        header .HeaderContainer .logo {
            width: 10%;
        }

        header .HeaderContainer .logo img {
            width: 100px;
            height: auto;
        }


        .HeaderSearch {
            width: 20%;
        }

        .HeaderSearch a {
            padding: 7px 10px;
            font-size: 1.2rem;
            float: right;
            border: none;
            background: var(--red);
            border: 2px solid var(--red);
            color: var(--white);
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            transition: all ease-in-out 0.6s;
            border-radius: 10px;
        }

        .HeaderSearch a:hover {
            background: var(--offwhite);
            border: 2px solid var(--red);
            color: var(--red);
        }

        .RegisterPage {
            height: 690px;
            width: 100%;
            background-color: var(--offwhite);
            display: flex;
            align-items: center;
        }

        .RegisterContainer {
            display: flex;
            justify-content: space-between;
            justify-items: center;
            align-items: center;
            background-color: var(--white);
            border-radius: 50px;
            height: auto;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        }

        .RegisterContainer .bgimg {
            width: 50%;
        }

        .RegisterContainer .bgimg img {
            width: 100%;
            border-radius: 50px;
            height: auto;
        }

        .RegisterContainer .register {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .register-box {
            width: 400px;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .register-box h2 {
            margin: 0 0 30px;
            padding: 0;
            /* color: var(--red); */
            color: var(--black);
            text-align: center;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }

        .register-box .user-box {
            position: relative;
        }

        .register-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            /* color: var(--red); */
            color: var(--black);
            margin-bottom: 30px;
            border: none;
            /* border-bottom: 1px solid var(--red); */
            border-bottom: 1px solid var(--black);
            outline: none;
            background: transparent;
        }

        .register-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            /* color: var(--red); */
            color: var(--black);
            pointer-events: none;
            transition: .5s;
        }

        .togglePassword {
            /* color: var(--red); */
            color: var(--black);
            cursor: pointer;
            position: absolute;
            top: 24%;
            right: 0;
        }

        .register-box .user-box input:focus~label,
        .register-box .user-box input:valid~label {
            top: -20px;
            left: 0;
            color: var(--gray);
            font-size: 12px;
            font-weight: bold;
        }

        .register-box form .Submitbtn {
            position: relative;
            overflow: hidden;
            transition: all ease-in-out 0.8s;
            display: inline-block;
            margin-top: 30px;
        }

        .register-box form .Submitbtn input {
            display: inline-block;
            padding: 10px 20px;
            /* color: var(--red); */
            color: var(--green);
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 4px;
            transition: all ease-in-out 0.8s;
            /* background-color: wheat; */
            border: none;
        }

        .register-box .Submitbtn:hover {
            /* background-color: var(--red); */
            background-color: var(--green);
            color: #fff;
            border-radius: 5px;
            /* box-shadow: 0 0 5px var(--red), */
            /* 0 0 25px var(--red),
                0 0 50px var(--red),
                0 0 100px var(--red); */
            box-shadow: 0 0 5px var(--green),
                0 0 25px var(--green),
                0 0 50px var(--green),
                0 0 100px var(--green);
        }

        .register-box .Submitbtn input:hover {
            /* background-color: var(--red); */
            background-color: var(--green);
            color: #fff;
            border-radius: 5px;
            /* box-shadow: 0 0 5px var(--red), */
            /* 0 0 25px var(--red),
                0 0 50px var(--red),
                0 0 100px var(--red); */
            box-shadow: 0 0 5px var(--green),
                0 0 25px var(--green),
                0 0 50px var(--green),
                0 0 100px var(--green);
        }

        .register-box .Submitbtn span {
            position: absolute;
            display: block;
        }

        .register-box .Submitbtn span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            /* background: linear-gradient(90deg, transparent, var(--red)); */
            background: linear-gradient(90deg, transparent, var(--green));
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }

            50%,
            100% {
                left: 100%;
            }
        }

        .register-box .Submitbtn span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            /* background: linear-gradient(180deg, transparent, var(--red)); */
            background: linear-gradient(180deg, transparent, var(--green));
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }

            50%,
            100% {
                top: 100%;
            }
        }

        .register-box .Submitbtn span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            /* background: linear-gradient(270deg, transparent, var(--red)); */
            background: linear-gradient(270deg, transparent, var(--green));
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }

            50%,
            100% {
                right: 100%;
            }
        }

        .register-box .Submitbtn span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            /* background: linear-gradient(360deg, transparent, var(--red)); */
            background: linear-gradient(360deg, transparent, var(--green));
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }

            50%,
            100% {
                bottom: 100%;
            }
        }

        @media only screen and (max-width: 1024px) {
            .RegisterContainer {
                display: block;
                background-color: var(--white);
                border-radius: 50px;
                height: auto;
                box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            }

            .RegisterContainer .bgimg {
                display: none;
            }

            .RegisterContainer .bgimg img {
                width: 100%;
                border-radius: 50px;
                height: auto;
            }

            .RegisterContainer .register {
                width: 100%;
                background-image: url("../commonPages/login_img.jpg");
                background-repeat: no-repeat;
                background-position: center;
                background-size: 50% 80%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .HeaderSearch a {
                padding: 6px 1px;
                font-size: .9rem;
                float: right;
                border: none;
                background: var(--red);
                border: 2px solid var(--red);
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                text-decoration: none;
                transition: all ease-in-out 0.6s;
                border-radius: 10px;
            }
        }

        #error {
            color: red;
            margin-bottom: 18px;
        }

        #alreadyCus{
            color: black;
        }
    </style>
</head>

<body>

    <section class="RegisterPage">
        <div class="container">
            <div class="RegisterContainer">
                <div class="bgimg">
                    <img src="../commonPages/login_img.jpg" alt="">
                </div>
                <div class="register">
                    <div class="register-box">
                        <h2>Register</h2>
                        <form method="POST" action="#" onsubmit="return validate()">
                            <div class="user-box">
                                <input type="text" name="name" value="<?php echo $name; ?>" required="">
                                <label>Your Name</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="email" value="<?php echo $email; ?>" required="">
                                <label>Email</label>
                            </div>

                            <div class="user-box">
                                <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>"
                                    required="">
                                <label>Phone</label>
                            </div>

                            <div class="user-box">
                                <input type="password" id="Password" minlength="8" maxlength="12" name="password"
                                    value="<?php echo $password; ?>" required="">
                                <i class="far fa-eye togglePassword" id="togglePassword"></i>
                                <label>Password</label>
                            </div>

                            <div class="user-box">
                                <input type="password" id="confirm-Password" minlength="8" maxlength="12"
                                    value="<?php echo $password; ?>" required="">
                                <i class="far fa-eye togglePassword" id="confirm-togglePassword"></i>
                                <label>Confirm Password</label>
                            </div>

                            <div class="user-box" id="error">
                                <?php
                                if ($_SESSION['is_error'] == true) {
                                    ?>
                                    <script>
                                        document.getElementsByName('phone')[0].style.borderColor = 'red';
                                    </script>
                                    <?php
                                    echo "This Phone is Already Registered!";
                                }
                                ?>
                            </div>

                            <div class="Submitbtn">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <input type="submit" value="register">

                            </div>
                        </form>
                        <a id="alreadyCus" href="../customerModule/customerLogin.php">Already a Customer?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#Password');
    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    const confirm_togglePassword = document.querySelector('#confirm-togglePassword');
    const confirm_password = document.querySelector('#confirm-Password');
    confirm_togglePassword.addEventListener('click', function (e) {
        const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
        confirm_password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    function validate() {
        const pass = document.getElementById("Password");
        const con_pass = document.getElementById("confirm-Password");
        const passError = document.getElementById("error");

        if (pass.value !== con_pass.value) {
            passError.innerHTML = "Password must be same!";
            pass.style.borderColor = 'red';
            con_pass.style.borderColor = 'red';
            return false;
        }
        return true;
    }
</script>

</html>