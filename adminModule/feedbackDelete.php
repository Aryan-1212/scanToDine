<?php
    include("../commonPages/dbConnect.php");
    $fb_id = $_GET['fb_Id'];
    $deleteQuery = "delete from feedbacks where id=$fb_id";
    $result = mysqli_query($con, $deleteQuery);
    if($result){
        header("Location: ./feedback.php");
    }else{
        echo "Error, while deleteing feedback!";
    }
?>