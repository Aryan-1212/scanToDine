<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    include('../commonPages/dbConnect.php');
    include('../commonPages/redirectPage.php');

    if (!isset($_SESSION)) {
        session_start();
    }

    $res_code = $_SESSION['res_code_for_cus'];

    function generate_unique_code($con, $res_code){
        $random = random_int(100000, 999999);
        $random_query = mysqli_query($con, "select completion_code from orders where res_id = $res_code and completion_code=$random;");
        if (mysqli_num_rows($random_query) > 0){
            return generate_unique_code($con);
        }
        else{
            return $random;
        }
    }

    if ($_POST) {

        exec("php ../notification/send.php");
        echo "<script>localStorage.clear()</script>";
        $table_num = $_SESSION['table_num'];
        date_default_timezone_set("Asia/Calcutta");
        $cid = $_SESSION['uid'];
        $date_time = date("Y-m-d h:i:s");
        $orderDet = $_POST['orderDet'];
        $amount = $_POST['totalPrice'];
        $completion_code = generate_unique_code($con, $res_code);
        $order_status = 'placed';

        $queryToInsert = "insert into orders(cus_id, order_date, table_num, res_id, items_det, amount, completion_code, order_status) values($cid, '$date_time', $table_num, $res_code, '$orderDet', $amount, $completion_code, '$order_status')";



        $insertRow = mysqli_query($con, $queryToInsert);
        reDirect("../customerModule/orderSubmit.php");
    }
    header("Location: ../customerModule/orderStatus.php");
    ?>

</body>

</html>