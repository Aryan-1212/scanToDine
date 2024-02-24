<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Forget Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: lightsteelblue;
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
            width: auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .email-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
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
    </style>
</head>

<body>
    <div class="container">
        <h2 class="heading">Forget Password</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email" class="label">Email, of which you want to change the password:</label>
                <input type="email" id="email" name="email" class="email-input" placeholder="Registered Email ID"
                    required>
            </div>
            <div class="form-group">
                <button type="submit" class="reset-button" name="submit">Send Verification Code</button>
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
        
        include("../../commonPages/dbConnect.php");

        // $con = new mysqli($servername, $username, $password, $dbname);
        

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $_SESSION['change_pass_email'] = $email;

                $isEmailRegistered = mysqli_query($con, "select * from users where u_email='$email' and role='manager'");
                if(mysqli_num_rows($isEmailRegistered)==0){
                    echo "<script>alert('Check your email, it is not registered!');</script>";
                    exit();
                }

                // Validate the email (you can use filter_var or other validation methods).
        
                // Generate a random verification code.
                $verificationCode = mt_rand(1000, 9999);

                // Store verification code in the database
                $sql = "INSERT INTO verification_codes (email, code) VALUES ('$email', '$verificationCode')";
                if ($con->query($sql) === TRUE) {
                    require '../../PHPMailer/PHPMailer/src/Exception.php';
                    require '../../PHPMailer/PHPMailer/src/PHPMailer.php';
                    require '../../PHPMailer/PHPMailer/src/SMTP.php';

                    $mail = new PHPMailer(true);
                    try {
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'scantodine007@gmail.com';
                        $mail->Password = 'ioqm oiaq kgll fyuk';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        //Recipients
                        $mail->setFrom('scantodine007@gmail.com', 'ScanToDine TEAM');
                        $mail->addAddress($email);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Verification Code for Password Reset';
                        $mail->Body = '<h2>Your verification code is: </h2><br><h1>' . $verificationCode . '</h1>';

                        $mail->send();

                        echo '<p>Verification code sent to ' . $email . '</p>';
                        header("Location: verify.php");
                        exit();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            }
        }

        $con->close();
        ?>
    </div>
</body>

</html>