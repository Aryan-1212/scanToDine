<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>VERIFY OTP</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .container {
            width: 40%;
            margin: 150px auto;
            padding: 75px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            width:auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 65px;
            color: #333;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        
        .reset-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: white;
            border: 1px solid #4CAF50;
            color: #4CAF50;
        }

        .reset-button:hover {
            background-color: #4CAF50;
            color: white;
            transition-duration: 1s;
        } 
        .otp-container {
            text-align: center;
            width:100%;
            margin-bottom:35px;
        }

        .otp-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline:none;
            font-size: 18px;

        }
        .otp-input:focus {
            box-shadow: 1px 3px 35px 1px green;
            transition-duration:0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="heading">Verify OTP</h2>
        <form method="post" action="">
            <div class="form-group">
                <div class="otp-container">
                   <label class="label">Enter OTP:</label>
                   <input type="text" name="code" class="otp-input" placeholder="Enter..">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="reset-button" name="verify">Verify</button>
            </div>
        </form>    
        <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "forgetpassword";
include("../commonPages/dbConnect.php");




if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['verify'])) {
        $verificationCode = $_POST['code'];

        $sql = "SELECT email, code FROM verification_codes WHERE code = '$verificationCode'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
            
            echo '<p>Verification successful for ' . $email . '</p>';
            $sql = "DELETE FROM verification_codes WHERE code = '$verificationCode'";
            $result = $con->query($sql);
            header("Location: reset_password.php?email=" . urlencode($email));
            exit();
        } else {
            echo '<p>Invalid OTP. Please try again.</p>';
        }
    }
}

$con->close();
?>

    </div>
</body>    
</html>