<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: ../commonPages/login.php");
    }
    include("../commonPages/index_header.php");
    include("../commonPages/dbConnect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Profile Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar{
            display: none;
        }

        header {
            /* background-color: #e74c3c; */
            color: #e74c3c;
            text-align: center;
            padding: 20px;
        }

        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .profile-image {
            margin-bottom: 20px;
        }

        .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid #ecf0f1;
        }

        .profile-info {
            margin-top: 20px;
            text-align: left;
        }

        .profile-info div {
            margin-bottom: 10px;
            /* padding: 10px; */
            padding: 10px 50px;
            background-color: #ecf0f1;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
        }

        .profile-info strong {
            display: block;
            margin-bottom: 5px;
        }

        .logout-btn {
            margin-top: 30px;
        }

        .logout-btn .log-out-btn {
            padding: 12px 24px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .logout-btn .log-out-btn:hover {
            background-color: #c0392b;
        }

        @media screen and (max-width: 480px){
            .profile-info div {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>PROFILE</h1>
    </header>

    <?php
        
        $u_id = $_SESSION['u_id'];

        $fetch_query = "select * from users where u_id=$u_id";
        $result = mysqli_query($con, $fetch_query);
        $data = mysqli_fetch_assoc($result);
        ?>

    <div class="profile-container">
        <div class="profile-image">
            <img src="user-logo.png" alt="User Profile">
        </div>

        <div class="profile-info">
            <div>
                <strong>Name-</strong>
                <span><?php echo $data['u_name'] ?> <i class="fas fa-user"></i></span>
            </div>
            <div>
                <strong>Email-</strong>
                <span><?php echo $data['u_email'] ?> <i class="fas fa-envelope"></i></span>
            </div>
            <div>
                <strong>Phone-</strong>
                <span><?php echo $data['u_phone'] ?> <i class="fas fa-phone"></i></span>
            </div>
            <div>
                <strong>Restaurant Code-</strong>
                <span><?php echo $data['res_code'] ?> <i class="fas fa-key"></i></span>
            </div>
        </div>

        <div class="logout-btn">
            <form action="#" method="POST">
                <input type="hidden" name="logout" value="logout">
                <input type="submit" class="log-out-btn" value="Logout">
            </form>
        </div>
    </div>
</body>
</html>
