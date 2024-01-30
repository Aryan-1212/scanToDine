<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $res_code = $_SESSION['res_code'];

    include("../commonPages/dbConnect.php");
    
    $_SESSION['wrong_phone'] = false;
    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];

        $checkUser = "select * from users where u_phone='$phone' and password='$pass' and role = 'customer';";
        $check = mysqli_query($con, $checkUser);
        if(mysqli_num_rows($check)>0){
            $fetchUid = mysqli_query($con, "select u_id from users where u_phone = '$phone' and res_code=$res_code and role='customer'");
            if(mysqli_num_rows($fetchUid)>0){
                $data = mysqli_fetch_assoc($fetchUid);
                $uid = $data['u_id'];
                $_SESSION['uid'] = $uid;
                $_SESSION['is_registered_cus'] = true;
                header("Location: ../customerModule/orderCart.php");
            }else{
                $_SESSION['wrong_phone'] = true;    
            }
        }else{
            $_SESSION['wrong_phone'] = true;
        }
    }else{
        $phone = NULL;
        $pass = NULL;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login</title>
    <link rel="shortcut icon" type="x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        html {
            height: 100%;
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


        header .HeaderContainer .HeaderSearch {
            width: 20%;
        }

        header .HeaderContainer .HeaderSearch a {
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

        header .HeaderContainer .HeaderSearch a:hover {
            background: var(--offwhite);
            border: 2px solid var(--red);
            color: var(--red);
        }

        .LoginPage {
            /* height: 85vh; */
            padding-top: 100px;
            width: 100%;
            background-color: var(--offwhite);
            display: flex;
            align-items: center;
        }

        .LoginContainer {
            display: flex;
            justify-content: space-between;
            justify-items: center;
            align-items: center;
            background-color: var(--white);
            border-radius: 50px;
            /* height: 80vh; */
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        }

        .LoginContainer .bgimg {
            width: 50%;
        }

        .LoginContainer .bgimg img {
            width: 100%;
            border-radius: 50px;
            height: auto;
        }

        .LoginContainer .login {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 400px;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .login-box h2 {
            margin: 0 0 30px;
            padding: 0;
            /* color: var(--red); */
            color: var(--black);
            text-align: center;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }

        .login-box .user-box {
            position: relative;
        }

        .login-box .user-box input {
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

        .login-box .user-box label {
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

        #togglePassword {
            /* color: var(--red); */
            color: var(--black);
            cursor: pointer;
            position: absolute;
            top: 24%;
            right: 0;
        }

        .login-box form .user-box a {
            color: var(--red);
            /* color: var(--black); */
            position: relative;
            padding: 0%;
            background-color: transparent;
            text-transform: none;
            letter-spacing: 0;
            margin: 0;
            font-family: sans-serif;
            transition: all ease-in-out 0.5s;
        }

        .login-box form .user-box a:hover {
            color: var(--gray);
            border-radius: 5px;
            text-decoration: underline;
            box-shadow: 0 0;
        }

        .login-box .user-box input:focus~label,
        .login-box .user-box input:valid~label {
            top: -20px;
            left: 0;
            color: var(--gray);
            font-size: 12px;
            font-weight: bold;
        }

        .login-box form .Submitbtn {
            position: relative;
            overflow: hidden;
            transition: all ease-in-out 0.8s;
            display: inline-block;
            margin-top: 30px;
        }

        .login-box form .Submitbtn input {
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

        .login-box .Submitbtn:hover {
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

        .login-box .Submitbtn input:hover {
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

        .login-box .Submitbtn span {
            position: absolute;
            display: block;
        }

        .login-box .Submitbtn span:nth-child(1) {
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

        .login-box .Submitbtn span:nth-child(2) {
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

        .login-box .Submitbtn span:nth-child(3) {
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

        .login-box .Submitbtn span:nth-child(4) {
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

        @media only screen and (max-width: 768px) {
            header .HeaderContainer .HeaderSearch a {
            font-size: 1000px;
        }
        header .HeaderContainer .HeaderSearch {
            width: 50%;
        }
        .login-box .user-box input {
            width: 100%;
            margin-bottom: 50px;
        }
        .LoginPage {
            height: 100%;
            /* margin: 10% 0; */
        }
        .LoginContainer {
            height: 100%;
        }
        }
        
        @media only screen and (max-width: 1024px) {
            .LoginContainer {
                display: block;
                background-color: var(--white);
                border-radius: 50px;
                /* height: 80vh; */
                box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            }

            .LoginContainer .bgimg {
                display: none;
            }

            .LoginContainer .bgimg img {
                width: 100%;
                border-radius: 50px;
                height: auto;
            }

            .LoginContainer .login {
                width: 100%;
                height: 100%;
                background-image: url("../commonPages/login_img.jpg");
                background-repeat: no-repeat;
                background-position: center;
                background-size: 50% 80%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            header .HeaderContainer .HeaderSearch a {
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

        @media only screen and (max-width: 2000px) {
            .LoginContainer .bgimg img {
                width: 80%;
                border-radius: 50px;
                height: auto;
            }
        }

        .forgot{
            color: red;
        }


        #error {
            margin-top: -30px;
            color: red;
            margin-bottom: 18px;
        }

        #alreadyCus{
            color: black;
        }
    </style>
</head>

<body>

    <section class="LoginPage">
        <div class="container">
            <div class="LoginContainer">
                <div class="bgimg">
                    <img src="../commonPages/login_img.jpg" alt="">
                </div>
                <div class="login">
                    <div class="login-box">
                        <h2>Login</h2>
                        <form method="POST" action="#">
                            <div class="user-box">
                                <input type="text" name="phone" maxlength="10" value="<?php echo $phone; ?>"
                                    required="">
                                <label>Phone</label>
                            </div>
                            <div class="user-box">
                                <input type="password" id="Password" maxlength="12" name="pass"
                                    value="<?php echo $pass; ?>" required="">
                                <i class="far fa-eye" id="togglePassword"></i>
                                <label>Password</label>
                            </div>

                            <div class="user-box" id="error">
                                <?php
                                if ($_SESSION['wrong_phone']) {
                                    echo "Incorrect Password or Phone";
                                }
                                ?>
                            </div>


                            <div class="user-box">
                                <a href="" class="forgot">forgot password?</a>
                            </div>
                            <div class="Submitbtn">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <input type="submit" value="LOGIN">
                            </div>
                        </form>
                        <a id="alreadyCus" href="../customerModule/customerRegister.php">Want to Register?</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>