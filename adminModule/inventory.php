<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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

        ::-webkit-scrollbar{
            display: none;
        }

        input,
        span {
            width: 100%;
        }

        input {
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

        .Inventory-container {
            margin-top: 30px;
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
            width: 20%;
            gap: 30px;
            flex-direction: column;
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
            border-bottom: 1px solid gray;
            padding: 10px 0;
        }

        .table-cell:nth-child(4) {
            flex: 1.5;
        }
        
        #add-item {
            float: right;
            margin-bottom: 4%;
        }

        
        .btn{
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
        #row{
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
            h2{
                width: 50%;
            }
        }

        .errorMsg{
            color: red;
        }
    </style>
</head>

<body>

    
    <?php
        include('../commonPages/dbConnect.php');
        if($_SESSION['is_error']){
            $is_error = $_SESSION['is_error'];
        }else{
            $is_error = false;
        }
        $fetch_data = "select * from inventory where res_code=547902";
        $data = mysqli_query($con, $fetch_data);
        $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
        ?>

    <section class="Inventory">
        <div class="container">
            <div class="Inventory-container">
                <div class="con">
                    <h2>Inventory Management</h2>
                    <button class="btn" id="add-item">Add Item</button><br>
                </div><br>
                <div class="form-container" id="form-container">
                    
                    </div><br>
                    
                    <?php
                    if($is_error){
                        echo "<script>alert('There was an error while inserting record!');</script>";
                        $_SESSION['is_error'] = false;
                    }
                ?>

                <div class="table-container">
                    <div class="table-heading">
                        <div class="table-cell">Index</div>
                        <div class="table-cell">Inventory Item</div>
                        <div class="table-cell">Category</div>
                        <div class="table-cell">Quantity</div>
                        <div class="table-cell">Last Updated date</div>
                    </div>

                    <?php
                        $index = 1;
                        foreach($rows as $row){
                            ?>
                            <div class="table-row">
                                <?php echo "<div class='table-cell'><span> ". $index ."</span></div>"?>
                                <?php echo "<div class='table-cell'><span> ". $row['item_name'] ."</span></div>"?>
                                <?php echo "<div class='table-cell'><span> ". $row['category'] ."</span></div>"?>
                                <?php echo "<div class='table-cell'><span> ". $row['item_qun'] ." ". $row['mes_unit'] ."</span></div>"?>
                                <?php echo "<div class='table-cell'><span> ". $row['date_added'] ."</span></div>"?>
                            </div>
                    <?php
                        $index++;
                        }
                    ?>
                </div>

            </div>
        </div>
    </section>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addItemButton = document.getElementById("add-item");
        const formContainer = document.getElementById("form-container");

        let isFormAdded = false;

        addItemButton.addEventListener("click", function () {
            if (!isFormAdded) {
                const newRowHTML = `
                    <form action='inventory_add.php' method='POST'>
                    <div class="table-row" id="row">
                        <div class="table-cell"><input type="text" placeholder="Inventory Item" name="item_name" required ></div>
                        <div class="table-cell">
                            <input list="category" placeholder="Category.." name="item_cat" required>
                            <datalist id="category">
                                <option value="DAIRY ITEM"></option>
                                <option value="VEGETARIAN"></option>
                                <option value="NON-VEGETARIAN"></option>
                                <option value="EGGETARIAN"></option>
                                <option value="JAIN ITEM"></option>
                            </datalist>
                        </div>
                        <div class="table-cell"><input type="text" name="item_qun" placeholder="Quantity" required ></div>
                        <div class="table-cell">
                            <input list="measurements" name="mes_unit" placeholder="Measurement Unit" required>
                            <datalist id="measurements">
                                <option value="KILOGRAM"></option>
                                <option value="GRAM"></option>
                                <option value="LITRE"></option>
                                <option value="DOZEN"></option>
                            </datalist>
                        </div>
                    </div><br>    
                    <input type="submit" class="btn" style=" width:10%; ">
                  </form>
                `;
                formContainer.insertAdjacentHTML("beforeend", newRowHTML);
                formContainer.style.display = 'block';
                isFormAdded = true;
            } else {
                formContainer.innerHTML = '';
                formContainer.style.display = 'none';
                isFormAdded = false;
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>