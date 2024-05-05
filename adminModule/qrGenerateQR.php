<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}

require "../vendor/autoload.php";
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Label;

include('../commonPages/dbConnect.php');

$table_num = $_POST['num'];
$res_code = $_POST['res_code'];

function insertQuery($con, $res_code, $num)
{
    $query = "insert into tables(res_id, table_num) values($res_code, $num)";
    $insertRow = mysqli_query($con, $query);
    if (!$insertRow) {
        echo "<script>alert('Unexpected Error!');</script>";
    }
}

$ip_add = "192.168.126.135";

for ($num = 1; $num <= $table_num; $num++) {
    $url = "$ip_add/restaurant/customerModule/order.php?res_code=$res_code&table_num=$num";

    $qr_code = QrCode::create($url)
        ->setSize(500)
        ->setMargin(40);

    $label = Label::create("Table - $num");

    $writter = new PngWriter;
    $res = $writter->write($qr_code, null, $label);

    insertQuery($con, $res_code, $num);

    $res->saveToFile("../qr-images/$res_code-qr-$num.png");
}
header("Location: ../adminModule/qrAdmin.php");
?>