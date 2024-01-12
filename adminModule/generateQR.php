<?php
require "../vendor/autoload.php";
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;

include('../commonPages/dbConnect.php');

$table_num = $_POST['tables_num'];
$res_code = $_POST['res_code'];

function insertQuery($con, $res_code, $num){
    $query = "insert into tables(res_id, table_num) values($res_code, $num)";
    $insertRow = mysqli_query($con, $query);
    if(!$insertRow){
        echo "<script>alert('Unexpected Error!');</script>";
    }
}

for ($num = 1; $num <= $table_num; $num++) {
    $url = " 192.168.128.135/restaurant/temp/qrTest.php?res_code=$res_code&table_num=$num";

    $qr_code = QrCode::create($url)
        ->setSize(500)
        ->setMargin(40);

    $label = Label::create("Table - $num")->setTextColor(new Color(186, 24, 27, 1));

    $writter = new PngWriter;
    $res = $writter->write($qr_code, null, $label);

    insertQuery($con, $res_code ,$num);

    $res->saveToFile("../qr-images/$res_code-qr-$num.png");
}
?>