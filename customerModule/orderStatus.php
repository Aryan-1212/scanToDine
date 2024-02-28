<?php
if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['is_order_ongoing'])){
    header("Location: ../customerModule/order.php");
    exit();
}

$uid = $_SESSION['uid'];
$res_code = $_SESSION['res_code_for_cus'];

include("../commonPages/dbConnect.php");
include("../commonPages/redirectPage.php");

if (isset($_POST['fb-email'])) {
    $email = $_POST['fb-email'];
    $subject = $_POST['fb-subject'];
    $feedback = $_POST['fb-feedback'];

    $uNameQuery = mysqli_query($con, "select u_name from users where u_id = $uid");
    $uName = mysqli_fetch_assoc($uNameQuery)['u_name'];
    $fbInsertQuery = "insert into feedbacks(res_code, username, fb_email, fb_subject, fb_description) values($res_code, '$uName', '$email', '$subject', '$feedback')";

    if(isset($_POST['fb-rating'])){
        $rating = $_POST["fb-rating"];
        $fbInsertQuery = "insert into feedbacks(res_code, username, fb_email, fb_subject, fb_description,  rating) values($res_code, '$uName', '$email', '$subject', '$feedback', $rating)";
    }

    $fbInsert = mysqli_query($con, $fbInsertQuery);
    if(!$fbInsert){
        echo "<script>alert('Unexpected Error Occurs!');</script>";
    }

    reDirect("../customerModule/orderStatus.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body.popup-open {
            overflow: hidden;
        }

        .pop-up {
            /* position: absolute; */
            position: fixed;
            background-color: rgb(216, 216, 216);
            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
            top: 15%;
            left: 25%;
            height: 70%;
            width: 50vw;
            z-index: 3;
            padding: 20px;
            box-sizing: border-box;
            display: none;
        }

        .pop-up .close-btn {
            position: absolute;
            right: 0;
            top: 0;
        }

        .pop-up .close-btn button {
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        .pop-up .close-btn button:hover {
            box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        }

        .FeedbackPage .FeedbackContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm {
            width: 75%;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm h2 {
            text-align: center;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm button {
            display: block;
            width: 100%;
            padding: 5px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm .rating {
            text-align: center;
        }

        .star {
            cursor: pointer;
            font-size: 42px;
            color: #ccc;
            color: whitesmoke;
            transition: color 0.2s;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm .star:hover,
        .star.active {
            color: #ffcc00;
        }

        .FeedbackPage .FeedbackContainer .FeedbackForm input,
        table,
        select,
        textarea,
        button {
            padding: 5px 0px;
            width: 100%;
            resize: vertical;
        }


        .main-div {
            height: auto;
            background-color: whitesmoke;
            padding: 50px 100px;
        }

        .status-div {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            display: flex;
            flex-direction: column;
        }

        .status-div .status-head {
            height: 100px;
            background-color: #cf3427;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 100px;
        }

        .status-div .status-head .head-title {
            font-size: 35px;
        }

        .status-div .status-animate {
            height: 300px;
            background-color: white;
            display: flex;
            flex-direction: column;
            font-size: 25px;
            justify-content: center;
            align-items: center;
        }

        .status-div .status-animate-title {
            margin: 0px 30px;
            text-align: center;
        }

        .status-div .status-details {
            background-color: #cf3427;
            height: auto;
            min-height: 150px;
            display: flex;
        }

        .status {
            width: 50%;
            display: flex;
            flex-direction: column;
        }


        .status-div .status-details .order-details .details-head {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            display: flex;
            margin: 0px 10px;
            margin-top: 10px;
            text-align: center;
            background-color: whitesmoke;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            padding: 10px;
        }

        .status-div .status-details .order-details .details {
            height: -webkit-fill-available;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            margin: 0px 10px;
            margin-bottom: 10px;
            background-color: whitesmoke;
        }

        .status-div .status-details .order-details .details .detail {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            padding: 10px;
            display: flex;
            text-align: center;

        }

        .flex1 {
            flex: 1;
        }

        .flex2 {
            flex: 2;
        }


        .status-div .status-details .other-details .other-details-head {
            display: flex;
            margin: 0px 10px;
            margin-top: 10px;
            background-color: whitesmoke;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .status-div .status-details .other-details .other-details-head div {
            margin: 0px 10px;
            text-align: center;
        }

        .status-div .status-details .other-details .other-details-body {
            padding: 30px 10px;
            text-align: center;
            background-color: whitesmoke;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            margin: 10px;
            margin-top: 0px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 10px;
            height: 100%;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .status-div .status-details .other-details .other-details-body .total {
            margin: 10px 0px;
            font-size: large;
        }

        .status-div .status-details .other-details .other-details-body h3 {
            font-size: x-large;
            margin: 10px 0px;
        }

        .hr {
            height: 2px;
            margin: 1px 0px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }

        .com-code {
            color: green;
        }

        .finished {
            color: red;
        }

        .menu-btns{
            display: flex;
            font-size: 20px;
            margin-bottom: 50px;
            align-items: center;
            justify-content: space-between;
            height: 40px;
        }

        .menu-btns .btn{
            text-align: center;
            color: green;
            padding: 12px 20px;
            text-decoration: none;
            background-color: white;
            border: 1px solid green;
        }

        .menu-btns .btn:hover{
            cursor: pointer;
            background-color: green;
            color: white;
            transition-duration: 0.7s;
            box-shadow: 5px 5px 10px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        /* .bill-btn a{
            text-decoration: none;
        } */

        .bill-btn{
            margin-top: 20px;
        }

        .bill-btn a{
            height: 150px;
            font-size: 15px;
            font-weight: 500;
            padding: 8px;
            text-decoration: none;
            background-color: #cc2828;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .bill-btn a:hover {
            background-color: #a9f33b;
            color: black;
            transition-duration: 0.5s;
        }

        @media screen and (max-width: 930px) {
            .pop-up {
                width: 70vw;
                left: 15%;
            }

            .status-div .status-head {
                padding: 0px 50px;
            }

            .status-div .status-head .head-title {
                font-size: 30px;
            }

            .status-details {
                flex-direction: column;
            }

            .status {
                width: 100%;
            }

            .main-div {
                padding: 50px 50px;
            }
        }

        @media screen and (max-width: 540px) {
            .menu-btns .btn{
                padding: 3px 7px;
                font-size: 15px;
            }

            .menu-btns a{
                margin-right: 10px;
            }

            .pop-up {
                width: 90vw;
                left: 5%;
                height: 70vh;
                top: 15%;
                padding-top: 50px;
            }

            .star {
                font-size: 40px;
            }

            .FeedbackPage .FeedbackContainer .FeedbackForm {
                width: 95%;
            }

            .status-div .status-head {
                flex-direction: column;
                text-align: center;
                padding: 30px 0px;
            }

            .main-div {
                padding: 50px 20px;
            }

            .status-div .status-details .other-details .other-details-head {
                padding: 10px 10px;
                flex-direction: column;
            }

            .status-div .status-details .other-details .other-details-head div {
                margin: 5px 0px;
            }
        }
    </style>

</head>

<body>


    <div class="pop-up" id="pop-up-box">
        <div class="close-btn"><button onclick="closeBtn()">Close</button></div>
        <section class="FeedbackPage">
            <div class="container">
                <div class="FeedbackContainer">
                    <div class="FeedbackForm">
                        <h2>Feedback</h2>
                        <form action="" method="POST">
                            <table>
                                <tr>
                                    <th>Email:</th>
                                </tr>
                                <tr>
                                    <td><input type="email" name="fb-email" id="fb-email" placeholder="Write your email here" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Subject:</th>
                                </tr>
                                <tr>
                                    <td><select name="fb-subject" id="fb-subject" required>
                                            <option value="" disabled selected>Select Subject</option>
                                            <option value="General Feedback">General Feedback</option>
                                            <option value="Issues">Issues</option>
                                            <option value="Suggestions">Suggestions</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Feedback:</th>
                                </tr>
                                <tr>
                                    <td><textarea name="fb-feedback" id="fb-feedback" cols="30" rows="3"
                                            placeholder='Give us Feedback'></textarea></td>
                                </tr>
                                <tr>
                                    <th><u>Rate Us:</u></th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="rating">
                                            <span class="star" onclick="rate(1)">★</span>
                                            <span class="star" onclick="rate(2)">★</span>
                                            <span class="star" onclick="rate(3)">★</span>
                                            <span class="star" onclick="rate(4)">★</span>
                                            <span class="star" onclick="rate(5)">★</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" id="submitData">Submit</button>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="fb-rating" id="rating">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    
    <div class="main-div">
        <div class="menu-btns">
            <a href="../customerModule/order.php" class="btn">Order Again?</a>
            <div class="btn" onclick="pop_up_open()">Give Us Feedback</div>
        </div>
        <div class="status-div">
            <div class="status-head">
                <div class="head-title">
                    Order Status
                </div>
            </div>
            <div class="status-animate">
                <div class="status-animate-title">Preparing Your Order</div>
                <img src="cooking-pot.gif" height="200px" width="200px" alt="">
            </div>


            <?php
            $cus_id = $_SESSION['uid'];
            $res_code = $_SESSION['res_code_for_cus'];
            $fetchOrderDetailsQuery = "select * from orders 
                                        where cus_id = $cus_id and res_id = $res_code
                                        AND TIMESTAMPDIFF(HOUR, order_date, NOW()) <= 24
                                        ORDER BY order_status DESC;";
            $fetchOrderDetails = mysqli_query($con, $fetchOrderDetailsQuery);
            $orderDetails = mysqli_fetch_all($fetchOrderDetails, MYSQLI_ASSOC);
            foreach ($orderDetails as $order) {
                $order_id = $order['order_id'];
                $order_date = $order['order_date'];
                $table_num = $order['table_num'];
                $items_det = $order['items_det'];
                $total = $order['amount'];
                $completion_code = $order['completion_code'];
                $order_status = $order['order_status'];

                $items_det_array = json_decode($items_det, true);

                $itemDetails = array();
                $index = 1;
                foreach ($items_det_array as $itemId => $val) {
                    if (!str_contains($itemId, 'inst')) {
                        $fetchItemDetQuery = "select * from food_items where res_id = $res_code and food_type_id = $itemId;";
                        $fetchItemDet = mysqli_query($con, $fetchItemDetQuery);
                        $itemDet = mysqli_fetch_assoc($fetchItemDet);
                        $itemDetails[$index] = array("name" => $itemDet['type_name'], "qun" => $val, "note" => $items_det_array["$itemId-inst"]);
                        $index++;
                    }
                }
                ?>


                <div class="status-details">
                    <div class="order-details status">
                        <div class="details-head">
                            <div class="flex2">Order Details</div>
                            <div class="flex1">Notes</div>
                        </div>
                        <div class="details">
                            <?php
                            for ($item_no = 1; $item_no <= count($itemDetails); $item_no++) {
                                ?>
                                <div class="detail">
                                    <?php
                                    echo "<div class='flex2'>" . $itemDetails[$item_no]['qun'] . " × " . $itemDetails[$item_no]['name'] . "</div>";
                                    echo (trim(strval($itemDetails[$item_no]['note'])) == '') ? "<div class='flex1'>-</div>" : "<marquee behavior='scroll' class='flex1' direction='left' scrollamount='2'>" . $itemDetails[$item_no]['note'] . "</marquee>";
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="other-details status">
                        <div class="other-details-head">
                            <?php
                            echo "<div>Order Id- " . $order_id . "</div>";
                            echo "<div>Table No- " . $table_num . "</div>";
                            echo "<div>" . $order_date . "</div>";
                            ?>
                        </div>
                        <div class="other-details-body">
                            <?php
                            echo "<div class='total'><p>Total - ₹" . $total . "</p></div>";

                            if ($order_status == 'placed') {
                                echo "<h3 class='com-code'>Completion Code - " . $completion_code . "</h3>";
                                echo "<p>Share this code with your restaurant manager only, once you receive your order.</p>";
                            } else {
                                echo "<h3 class='finished'>Finished<h3>";
                            }
                            ?>
                            <div class="bill-btn">
                                <a href="../adminModule/bill_structure2.php?order_id=<?php echo $order_id; ?>">Download Invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr"></div>
                <?php
            }
            ?>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pop_up_box = document.getElementById("pop-up-box");
            
            const email = document.getElementById('fb-email');
            const subject = document.getElementById('fb-subject');
            const fb = document.getElementById('fb-feedback');
            // const finishOrderBtn = document.getElementById("finishOrder");

            email.addEventListener("change",()=>{
                if(!(email.value.trim() === '' || subject.value.trim() === '' || fb.value.trim() === '')){
                    document.getElementById('submitData').disabled = false;
                    document.getElementById('submitData').style.backgroundColor = 'black';
                }
            })

            pop_up_open = () => {
                pop_up_box.style.display = "block";
                document.body.classList.add("popup-open");
            }

            closeBtn = () => {
                pop_up_box.style.display = "none";
                document.body.classList.remove("popup-open");
            }

            setInterval(() => {
                pop_up_open();
            }, 1000 * (60 * 3));
        })

    </script>
    <script>
        let selectedRating = 0;

        function rate(rating) {
            document.getElementById("rating").value = rating;
            selectedRating = rating;
            resetStars();
            highlightStars(rating);
        }

        function resetStars() {
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.classList.remove('active');
            });
        }

        function highlightStars(count) {
            const stars = document.querySelectorAll('.star');
            for (let i = 0; i < count; i++) {
                stars[i].classList.add('active');
            }
        }
    </script>
</body>

</html>