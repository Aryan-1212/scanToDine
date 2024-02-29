<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <style>
        .btnDiv {
            display: flex;
            justify-content: center;
            padding: 30px;
        }

        .btnDiv .btn {
            background-color: #cc2828;
            color: white;
        }

        .btn:hover {
            background-color: #a9f33b;
            transition-duration: 0.5s;
        }
    </style>
</head>

<body>
    <?php
    include("../commonPages/index_header.php");
    include('../commonPages/dbConnect.php');

    $res_code = $_SESSION['res_code'];
    $checkMenuQuery = "select * from food_items where res_id = $res_code";
    $checkMenuAvailable = mysqli_query($con, $checkMenuQuery);
    if ($checkMenuAvailable) {
        $data = mysqli_num_rows($checkMenuAvailable);
        if ($data > 0) {
            include("menu.php");
            echo "<div class='btnDiv'><button class='btn' id='btnToAdd' onclick='addItem()'>Add Item</button></div>";
        } else {
            include("menu_select1.php");
        }
    } else {
        echo "<script>alert(Unexpected Error);</script>";
    }
    ?>

    <?php
    include("../commonPages/index_footer.html");
    ?>

    <script>

        addItem = () => {
            const items = document.querySelectorAll('.iFrameItemDiv');
            const itemsArray = [];
            for (let item = 0; item < items.length; item++) {
                const id = items[item].id.substring(0, 6);
                if (!itemsArray.includes(id)) {
                    itemsArray.push(id);
                }
            }
            localStorage.setItem("addItemValues", JSON.stringify(itemsArray));
            window.location.href = "../adminModule/menu_select1.php";
        }
    </script>
</body>

</html>