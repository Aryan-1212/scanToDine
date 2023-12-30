<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php
        include("../php-qr/phpqrcode/qrlib.php");
        $text = "URL-of-Menu";
        QRcode::png($text, '../qrcodes/image.png');
    ?>

    <img src="../qrcodes/image.png" alt="QRcode">
</body>
</html>