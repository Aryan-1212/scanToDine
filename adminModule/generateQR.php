<?php
    require "../vendor/autoload.php";
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Label\Label;

    // $url = "Sample qrcode";
    $url = "http://www.instagram.com";

    $qr_code = QrCode::create($url)
                                ->setSize(500)
                                ->setMargin(40);

    $label = Label::create("This is a label")->setTextColor(new Color(186, 24, 27, 1));

    $writter = new PngWriter;
    $res = $writter->write($qr_code, null, $label);
    
    $res->saveToFile("../qr-images/testQR.png");
?>