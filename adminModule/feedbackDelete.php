<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}

include("../commonPages/dbConnect.php");
$fb_id = $_GET['fb_Id'];
$deleteQuery = "delete from feedbacks where id=$fb_id";
$result = mysqli_query($con, $deleteQuery);
if ($result) {
    header("Location: ./feedback.php");
} else {
    echo "Error, while deleteing feedback!";
}
?>