<?php
include("../commonPages/index_header.php");
include("../commonPages/dbConnect.php");
if (!isset($_SESSION)) {
    session_start();
}

$res_code = $_SESSION['res_code'];

if (isset($_POST["editedData"])) {
    $data = json_decode($_POST['editedData'], true);
    $id = $data['save_id'];
    $name = ($data['name']) ? $data['name'] : '-';
    $cat = ($data['cat']) ? $data['cat'] : '-';
    $quan = ($data['quan']) ? $data['quan'] : 0;
    $mes = ($data['mes']) ? $data['mes'] : '-';
    $date = date('Y-m-d');

    $editRowQuery = "update inventory set item_name='$name', item_qun=$quan, mes_unit='$mes', category='$cat', date_added='$date' where item_id=$id and res_code = $res_code";
    $editRow = mysqli_query($con, $editRowQuery);
    if (!$editRow) {
        echo "<script>alert('Unexpected Error Occures!');</script>";
    }
} elseif (isset($_POST["removeData"])) {
    $id = $_POST['removeData'];
    $removeRowQuery = ("delete from inventory where item_id=$id and res_code=$res_code");
    $removeRow = mysqli_query($con, $removeRowQuery);
    if (!$removeRow) {
        echo "<script>alert('Unexpected Error Occures!');</script>";
    }
}

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
            border-bottom: 1px solid gray;
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
            float: right;
            margin-bottom: 4%;
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

        .errorMsg, .no-data {
            color: red;
        }
    </style>
</head>

<body>


    <?php
    include('../commonPages/dbConnect.php');
    if (isset($_SESSION['is_error'])) {
        $is_error = $_SESSION['is_error'];
    } else {
        $is_error = false;
    }
    $res_code = $_SESSION['res_code'];
    $fetch_data = "select * from inventory where res_code=$res_code";
    $data = mysqli_query($con, $fetch_data);

    $isDataAvailable = mysqli_num_rows($data);

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
                if ($is_error) {
                    echo "<script>alert('There was an error while inserting record!');</script>";
                    $_SESSION['is_error'] = false;
                }

                ?>
                <div class="table-container">
                    <?php
                    if ($isDataAvailable > 0) {
                        ?>

                        <div class="table-heading">
                            <div class="table-cell">Index</div>
                            <div class="table-cell">Inventory Item</div>
                            <div class="table-cell">Category</div>
                            <div class="table-cell">Quantity</div>
                            <div class="table-cell">Last Updated date</div>
                            <div class="table-cell change">
                                <pre>              </pre>
                            </div>
                        </div>
                        <form action="#" method="POST" id="formToChange">
                            <input type="hidden" name="editedData" id="hiddenField">
                        </form>

                        <?php
                        $index = 1;
                        foreach ($rows as $row) {
                            ?>
                            <div class="table-row">
                                <?php echo "<div class='table-cell'><span> " . $index . "</span></div>" ?>
                                <?php echo "<div class='table-cell' ><span id='edit-name-" . $row['item_id'] . "'> " . $row['item_name'] . "</span></div>" ?>
                                <?php echo "<div class='table-cell' ><span id=edit-cat-" . $row['item_id'] . "> " . $row['category'] . "</span></div>" ?>
                                <?php echo "<div class='table-cell' ><span id=edit-quan-" . $row['item_id'] . "> " . $row['item_qun'] . " " . $row['mes_unit'] . "</span></div>" ?>
                                <?php echo "<div class='table-cell'><span> " . $row['date_added'] . "</span></div>" ?>

                                <?php echo "<div class='table-cell change edit' id='edit-btn-" . $row['item_id'] . "'><button class='edit-btn' id=" . $row['item_id'] . " onclick='editItem(event)'>EDIT</button></div>"; ?>

                                <?php echo "<div class='table-cell change remove' id='remove-btn-" . $row['item_id'] . "'><button class='remove-btn' id=remove-" . $row['item_id'] . " onclick='removeItem(event)'>REMOVE</button></div>"; ?>
                            </div>
                            <?php
                            $index++;
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
                            <select id="category" name="item_cat">
                                <option disabled selected>Select Category</option>
                                <option value="DAIRY ITEM">DAIRY ITEM</option>
                                <option value="VEGETARIAN">VEGETARIAN</option>
                                <option value="NON-VEGETARIAN">NON-VEGETARIAN</option>
                                <option value="EGGETARIAN">EGGETARIAN</option>
                                <option value="JAIN ITEM">JAIN ITEM</option>
                            </select>
                        </div>
                        <div class="table-cell"><input type="text" name="item_qun" placeholder="Quantity" required ></div>
                        <div class="table-cell">
                            <select id="measurements" name="mes_unit">
                                <option disabled selected>Measurement Unit</option>
                                <option value="KILOGRAM">KILOGRAM</option>
                                <option value="GRAM">GRAM</option>
                                <option value="LITRE">LITRE</option>
                                <option value="DOZEN">DOZEN</option>
                                <option value="PIECE">PIECE</option>
                            </select>
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


    editItem = (e) => {
        const edit_id = e.target.id;
        const btns = document.querySelectorAll('.edit-btn')
        for (let btn = 0; btn < btns.length; btn++) {
            btns[btn].style.color = "grey";
            btns[btn].disabled = true;
        }
        const removeBtns = document.querySelectorAll('.remove-btn');
        for (let btn = 0; btn < removeBtns.length; btn++) {
            removeBtns[btn].style.color = "grey";
            removeBtns[btn].disabled = true;
        }

        document.getElementById(`edit-btn-${edit_id}`).innerHTML = `<button id="save-btn-${edit_id}" onclick="saveEdit(event)">Save</button>`;

        const name = document.getElementById(`edit-name-${edit_id}`);
        const cat = document.getElementById(`edit-cat-${edit_id}`);
        const quan = document.getElementById(`edit-quan-${edit_id}`);

        const name_val = name.textContent.trim();
        const cat_val = cat.textContent.trim();
        const quan_val = quan.textContent.trim().split(" ");
        const quan_val_num = quan_val[0];
        const quan_val_mes = quan_val[1];

        name.innerHTML = `<input value="${name_val}" id="edited-name-${edit_id}" required>`;
        cat.innerHTML = `<div class="table-cell">
                            <select id="edited-cat-${edit_id}">
                                <option disabled>Select Category</option>
                                <option value="DAIRY ITEM" ${(cat_val.toUpperCase() === "DAIRY ITEM" ? "selected" : "")}>DAIRY ITEM</option>
                                <option value="VEGETARIAN" ${(cat_val.toUpperCase() === "VEGETARIAN" ? "selected" : "")}>VEGETARIAN</option>
                                <option value="NON-VEGETARIAN" ${(cat_val.toUpperCase() === "NON-VEGETARIAN" ? "selected" : "")}>NON-VEGETARIAN</option>
                                <option value="EGGETARIAN" ${(cat_val.toUpperCase() === "EGGETARIAN" ? "selected" : "")}>EGGETARIAN</option>
                                <option value="JAIN ITEM" ${(cat_val.toUpperCase() === "JAIN ITEM" ? "selected" : "")}>JAIN ITEM</option>
                            </select>
                        </div>`;

        quan.innerHTML = `<div class="table-cell"><input type="text" value="${quan_val_num}" id="edited-quan-${edit_id}" placeholder="Quantity" required></div>
                        <div class="table-cell">
                            <select id="edited-mes-${edit_id}">
                                <option disabled selected>Measurement Unit</option>
                                <option value="KILOGRAM" ${(quan_val_mes.toUpperCase() === "KILOGRAM" ? "selected" : "")}>KILOGRAM</option>
                                <option value="GRAM" ${(quan_val_mes.toUpperCase() === "GRAM" ? "selected" : "")}>GRAM</option>
                                <option value="LITRE" ${(quan_val_mes.toUpperCase() === "LITRE" ? "selected" : "")}>LITRE</option>
                                <option value="DOZEN" ${(quan_val_mes.toUpperCase() === "DOZEN" ? "selected" : "")}>DOZEN</option>
                                <option value="PIECE" ${(quan_val_mes.toUpperCase() === "PIECE" ? "selected" : "")}>PIECE</option>
                            </select>
                        </div>`;
    }

    saveEdit = (e) => {
        const save_btn_id = e.target.id;
        const save_id = save_btn_id.replace("save-btn-", '');
        const name = document.getElementById(`edited-name-${save_id}`).value;
        const cat = document.getElementById(`edited-cat-${save_id}`).value;
        const quan = document.getElementById(`edited-quan-${save_id}`).value;
        const mes = document.getElementById(`edited-mes-${save_id}`).value;
        const edited_items = {
            save_id, name, cat, quan, mes
        };
        const edited_items_json = JSON.stringify(edited_items);
        document.getElementById('hiddenField').value = edited_items_json;
        document.getElementById('formToChange').submit();
    }

    removeItem = (e) => {
        const confirmRemove = confirm("Do You Really Want To Remove This Item?");
        if (confirmRemove) {
            const remove_id = e.target.id;
            const id = remove_id.replace('remove-', '');
            console.log(id);
            document.getElementById('formToChange').innerHTML = `<input type='hidden' name='removeData' value='${id}' id='hiddenField'>`;
            document.getElementById('formToChange').submit();
        }
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</html>