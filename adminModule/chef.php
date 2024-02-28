<?php
include("../commonPages/index_header.php");
include("../commonPages/dbConnect.php");
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['is_login'])) {
    header("Location: ../indexPage/index.php");
    exit();
}

$res_code = $_SESSION['res_code'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Chef</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        input,
        span {
            width: 80%;
        }

        input {
            border: 0;
            outline: 0;
            border-bottom: 2px solid black;
            color: black;
        }

        select {
            width: 100%;
            border: 0;
            outline: 0;
            border-bottom: 2px solid black;
            color: black;
        }

        h2 {
            float: left;
        }

        body {
            background-color: lightsteelblue;
        }

        .Inventory {
            margin-bottom: 100px;
            margin-top: 30px;
            min-height: 315px;
        }

        .table-heading {
            display: flex;
            font-weight: bold;
            padding: 10px 0;
            border-bottom: 3px solid gray;
            width: 100%;
        }



        .table-cell {
            display: flex;
            flex: 1;
            justify-content: space-between;
            padding: 5px;
            width: 100%;
            gap: 30px;
            flex-direction: column;
        }

        .table-cell input,
        select {
            background-color: transparent;
        }

        .table-heading .change {
            flex: 0;
        }

        .table-container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            background-color: white;
            border: 3px solid grey;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 20px;
        }

        .table-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            width: 100%;
            padding: 10px 0;
        }

        .table-row .edit button {
            color: blue;
        }

        .table-row .remove button {
            color: red;
        }

        .table-row .change {
            flex: 0;
        }

        .table-row .change button {
            border: none;
            background-color: transparent;
        }

        .table-row .change button:hover {
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            transition-duration: 0.4s;
        }

        .table-cell:nth-child(4) {
            flex: 1.5;
        }

        #add-item {
            margin-bottom: 4%;
            float: right;
        }

        #add-category {
            margin-bottom: 4%;
            float: right;
        }

        .btn {
            margin-top: 10px;
            padding: 10px;
            background-color: #cc2828;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 1%;
        }

        .btn:hover {
            background-color: #a9f33b;
            transition-duration: 0.5s;
        }

        .form-container {
            background-color: white;
            border: 3px solid gray;
            padding: 20px;
            width: 100%;
            margin-top: 20px;
            display: none;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
        }

        #form-container2 {
            padding: 0px 200px;
        }

        #row {
            background-color: white;
        }

        .form-container .table-cell {
            display: block;
        }

        .table-row:nth-child(odd) {
            background-color: lightgray;
        }

        .table-row:nth-child(even) {
            background-color: white;
        }

        .addBtn{
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .table-row {
                flex-direction: column;
                align-items: flex-start;
            }

            input {
                width: 100%;
            }

            .table-cell {
                width: 100%;
                padding: 5px 0;
            }

            .table-heading {
                display: none;
            }

            h2 {
                width: 50%;
            }
        }

        .errorMsg,
        .no-data {
            color: red;
        }
    </style>
</head>

<body>


    <?php
    $fetch_data = "select * from users where res_code=$res_code and role='chef'";
    $data = mysqli_query($con, $fetch_data);

    $isDataAvailable = mysqli_num_rows($data);

    $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
    ?>

    <section class="Inventory">
        <div class="container">
            <div class="Inventory-container">
                <div class="con">
                    <h2>Manage Chef</h2>
                </div>
                <div class="table-container">
                    <?php
                    if ($isDataAvailable > 0) {
                        ?>

                        <div class="table-heading">
                            <div class="table-cell">Id</div>
                            <div class="table-cell">Name</div>
                            <div class="table-cell">Email</div>
                            <div class="table-cell">Phone</div>
                            <div class="table-cell">Password</div>
                        </div>

                        <?php
                        foreach ($rows as $row) {
                            ?>
                            <div class="table-row">
                            <?php echo "<div class='table-cell'>". $row['u_id'] ."</div>"; ?>
                            <?php echo "<div class='table-cell'>". $row['u_name'] ."</div>"; ?>
                            <?php echo "<div class='table-cell'>". $row['u_email'] ."</div>"; ?>
                            <?php echo "<div class='table-cell'>". $row['u_phone'] ."</div>"; ?>
                            <?php echo "<div class='table-cell'>". $row['password'] ."</div>"; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    } else {
                        ?>
                    <div class="no-data">No data Available.</div>
                    <?php
                    }
                    ?>

            </div>
        </div>

        <div class="addBtn">
            <a href="../adminModule/chefRegister.php" class="btn">Add Chef</a>
        </div>

    </section>
    <?php
    include("../commonPages/index_footer.html");
    ?>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>