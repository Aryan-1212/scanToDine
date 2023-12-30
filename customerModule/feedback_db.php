<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    if (isset($_POST)) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $feedback = $_POST["feedback"];
        $experience = $_POST["experience"];
    }

    $con = mysqli_connect("localhost", "root", "", "scantodine");
    if (!$con) {
        echo "Unexpected Error!";
    }

    $feedback_insert = mysqli_query($con, "insert into feedbacks(res_code, fb_name, fb_email, fb_subject, fb_description, experience)
    values(123456, '$name', '$email', '$subject', '$feedback', '$experience')");
    if ($feedback_insert) {
        ?>
        <script>
            alert("Feedback Submitted!");
        </script>
        <h1 style="color: green; text-align: center; margin-top: 300px;">Thank You, For Your Valuable Feedback!</h1>
        <?php
    }
    ?>
</body>

</html>