<?php
include("../commonPages/dbConnect.php");
include("../commonPages/index_header.php");
// $selectedItemsjson = $_POST['selecteditems'];
// $selectedItems = json_decode($selectedItemsjson, true);
if (!isset($_SESSION)) {
  session_start();
}
// $_SESSION['selectedItems'] = $selectedItems;

?>
<?php
// if ($_POST['selecteditems']) {
?>

<script>
  // localStorage.removeItem('selected_items');
</script>
<?php
// }
?>


<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Restaurant Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="iFrameCSS.css"> -->
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    ::-webkit-scrollbar {
      display: none;
    }

    :root {
      --whitesmoke: whitesmoke;
      --red: #cf3427;
      --green: #a9f33b;
    }

    h1 {
      text-align: center;
    }

    .collapsible {
      background-color: var(--red);
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      border: 1px solid black;
    }

    .active,
    .collapsible:hover {
      background-color: var(--green);
    }

    .collapsible:after {
      content: "▼";
      color: white;
      font-weight: bold;
      float: right;
      margin-left: 5px;
    }

    .active:after {
      content: "▲";
    }


    .content {
      padding: 0 18px;
      max-height: 0;
      transition: all 1s ease-in-out;
      display: flex;
      justify-content: center;
      width: 100%;
      border-left: 1px solid black;
      border-right: 1px solid black;
      border-bottom: 1px solid black;
      padding-left: 10px;
      overflow: hidden;
    }

    .content iframe {
      overflow: hidden;
    }

    body {
      overflow-y: scroll;
    }

    .menu{
      min-height: calc(100vh - 350px);
      margin-bottom: 100px
    }

    .container {
      /* margin-bottom: 50px;  */
    }

    .iFrame-menuItem {
      display: flex;
      width: 100%;
      height: 85vh;
      flex-wrap: nowrap;
      padding: 10px;
      border: 1px solid var(--red);
      border-radius: 5px;
      background-color: var(--whitesmoke);
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
      margin-top: 1%;
    }

    .iFrame-menuDescription {
      display: flex;
      position: relative;
      width: 45%;
      flex-wrap: wrap;
      margin: 10px 30px;
    }

    .iFrame-menuDescription .iFrame-content textarea {
      width: 80%;
      height: 65%;
      margin-top: 2%;
      resize: none;
    }

    .iFrame-menuVariety {
      display: flex;
      flex-direction: column;
      width: 50%;
      border-left: 2px solid;
      padding-left: 10px;
      overflow-y: scroll;
    }

    .iFrame-menuVarietyItem {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .iFrame-addItem {
      background-color: var(--red);
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      margin-top: 1%;
    }

    .iFrame-menuVarietyItem button:hover {
      background-color: var(--hover);
    }

    .iFrame-pagination {
      display: flex;
      justify-content: space-evenly;
      margin: 20px;
    }

    .iFrame-pagination button {
      background-color: var(--red);
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }

    .iFrame-pagination .iFrame-addItem:hover,
    button:hover {
      background-color: var(--green);
      transition-duration: 0.5s;
    }

    .iFrame-content {
      width: 100%;
    }

    .iFrame-span {
      width: 200px;
    }

    .iFrame-menuVariety .iFrame-foodDes textarea {
      width: 100%;
    }

    .iFrame-menuVariety .iFrame-menuVarietyItem {
      margin-top: 1%;
    }

    .iFrame-menuVarietyItem input {
      margin-bottom: 5%;
      width: 100%;
    }

    .iFrame-foodDes {
      padding-bottom: 20px;
      border-bottom: 2px solid black;
      margin-bottom: 20px;
    }

    .Button {
      width: 100%;
      margin: 50px 0;
      display: flex;
      justify-content: center;
    }

    #submitData {
      background-color: greenyellow;
      border: 1px solid Green;
      padding: 7px 20px;
    }

    #submitData:hover {
      background-color: green;
      color: white;
      transition-duration: 0.7s;
      border: 1px solid greenyellow;
    }

    @media (max-width: 768px) {
      .iFrame-menuItem {
        flex-wrap: wrap;
        overflow-y: scroll;
      }

      h2 {
        text-align: center;
      }

      p {
        text-align: center;
      }

      .formToAppend {
        overflow: scroll;
      }

      .iFrame-content {
        border-bottom: 2px solid black;
      }

      .iFrame-menuItem {
        /* height: auto; */
      }

      .iFrameItemDiv {
        overflow-y: scroll;
      }

      .iFrame-menuDescription {
        width: 100%;
      }

      .iFrame-menuDescription .iFrame-content textarea {
        width: 80%;
        height: 50%;
      }

      .iFrame-content input {
        margin-top: 2%;
      }

      .iFrame-menuVariety {
        width: 100%;
        overflow-y: scroll;
        border: none;
      }

      .iFrame-add {
        width: 16%;
      }
    }

    @media (max-width: 365px) {
      .iFrame-menuItem {
        width: 100%;
      }

      .iFrame-add {
        width: 16%;
      }

      .iFrame-content input {
        margin-top: 1%;
      }
    }

    ::placeholder {
      text-align: center;
    }

    .iFrame-price {
      width: 100px;
    }

    .iFrame-price span {
      font-size: 22px;
      margin: 0 5px;
    }

    .iFrame-add {
      background-color: var(--red);
      color: #fff;
      border: none;
      width: 16%;
      border-radius: 100%;
      padding-left: 3px;
      padding-right: 3px;
      cursor: pointer;
      font-size: larger;
    }

    .iFrame-add:hover,
    .iFrame-addItem:hover {
      background-color: var(--green);
      transition-duration: 0.5s;
    }

    /* 
        .iFrame-priceItem input{
            width: 100%;
        } */

    .iFrame-menuDescription .img {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .iFrame-menuDescription .img img {
      width: 100%;
      height: 60vh;
    }

    .iFrame-menuVarietyItemTitle {
      display: inline-block;
      margin-right: 10px;
    }

    .iFrame-priceItemTitle {
      display: inline-block;
      margin-right: 10px;
    }

    .iFrame-foodDesTitle {
      display: inline-block;
      margin-right: 10px;
    }

    .updateType {
      display: none;
    }

    .addItem-div {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 10px 0px -10px 0px;
    }

    .addItem-btn {
      background-color: var(--red);
      padding: 2px 10px;
      border: none;
      color: white;
    }
  </style>
</head>

<body>
  <section class="menu">

    <div class="container">
      <h1>Menu</h1>

      <?php
      if (isset($_SESSION['is_error']) && $_SESSION['is_error']) {
        $is_error = $_SESSION['is_error'];
      } else {
        $is_error = false;
      }

      if ($is_error) {
        echo "<script>alert('Unexpected Error Occurs.');</script>";
        $_SESSION['is_error'] = false;
      }
      ?>

      <?php

      $res_code = $_SESSION["res_code"];
      $queryForItems = mysqli_query($con, "select distinct food_id from food_items where res_id=$res_code");
      $selectedItems = mysqli_fetch_all($queryForItems);

      foreach ($selectedItems as $val) {
        $item_index = 1;
        $val = $val[0];

        $queryForItem = mysqli_query($con, "select * from default_item where item_id=$val");
        $data = mysqli_fetch_assoc($queryForItem);
        $item_id = $data['item_id'];
        $item_name = $data['item_name'];
        $item_category = $data['category'];
        $item_extension = $data['extension'];
        ?>
        <button class="collapsible">
          <?php echo ucfirst($data['item_name']); ?>
        </button>
        <div class="content">
          <section id="iFrame-menu" style="width: 100%;">
            <div class="container">

              <div class="iFrame-menuItem">

                <div class="iFrame-menuDescription">
                  <div class="img">
                    <img
                      src="../default_items2/<?php echo $item_id . '-' . $item_name . '-' . $item_category . '.' . $item_extension; ?>"
                      alt="<?php echo $item_name; ?>" class="iFrame-menuImage">
                  </div>
                </div>
                <div class="iFrame-menuVariety">

                  <?php
                  $fetch_types_query = "select * from food_items where food_id = $item_id and res_id=$res_code";
                  $fetch_all_types = mysqli_query($con, $fetch_types_query);
                  $all_types = mysqli_fetch_all($fetch_all_types, MYSQLI_ASSOC);
                  foreach ($all_types as $type) {
                    $type_id = $type['food_type_id'];
                    $type_name = $type['type_name'];
                    $type_price = $type['type_price'];
                    $type_des = $type['type_des'];
                    ?>

                    <div class="iFrameItemDiv" id="<?php echo $item_id . "-" . $item_index; ?>">

                      <div class="iFrame-menuVarietyItem">
                        <span>
                          <div class="iFrame-menuVarietyItemTitle">
                            <?php echo ucfirst($item_name) . ' type: '; ?>
                          </div>
                          <span id="<?php echo $type_id . "-name" ?>">
                            <?php echo $type_name; ?>
                          </span>
                        </span>
                        <div class="iFrame-priceItem">
                          <span>
                            <div class="iFrame-priceItemTitle">Price: </div>
                            <span id="<?php echo $type_id . "-price" ?>">
                              <?php echo $type_price; ?>
                            </span>
                          </span>
                        </div>
                        <div class="type-edit-btn">
                          <input type="button" onclick="edit_btn(event);" id="<?php echo $type_id ?>" class="EditType"
                            value="Edit">
                          <input type="button" onclick="save_btn(event);" id="<?php echo $type_id . '-save' ?>"
                            class="updateType" value="Save">
                          <input type="button" onclick="remove_btn(event);" id="<?php echo $type_id . '-remove' ?>"
                            value="Remove">
                          <form action="menuUpdate.php" method="POST" id="updateForm">
                            <input type="hidden" id="hiddenValues" name="data">
                          </form>
                          <form action="menuRemove.php" method="POST" id="removeForm">
                            <input type="hidden" id="hiddenValues-remove" name="id">
                          </form>
                          <form action="menuAdd.php" method="POST" id="add-type">
                            <input type="hidden" name="item_id" id="add-item-id">
                            <input type="hidden" id="add-hidden-values" name="data">
                          </form>
                        </div>
                      </div>
                      <div class="iFrame-foodDes">
                        <div class="iFrame-foodDesTitle">Desc:</div>
                        <span id="<?php echo $type_id . "-des" ?>">
                          <?php echo $type_des; ?>
                        </span>
                      </div>
                    </div>

                    <?php
                  }
                  ?>
                  <div class="formToAppend" id="<?php echo 'iFrame-formToAppend-' . $item_id; ?>">
                  </div>
                  <div>
                    <input type="button" id=<?php echo $item_id; ?> class="iFrame-addItem" value="Add Item">
                  </div>
                </div>
              </div>

            </div>
          </section>
        </div>
        <?php
      }
      ?>

    </div>
    <!-- <form action="menu_entry.php" method="post" id="formToSubmit">
      <input type="hidden" id="hiddenValue" name="data">
      <div class="Button">
        <input type="button" value="Submit" id="submitData">
      </div>
    </form> -->
  </section>

    <?php
      include("../commonPages/index_footer.html");
    ?>

</body>

<script>
  edit_btn = (e) => {
    e.target.disabled = true;
    document.getElementById(`${e.target.id}-remove`).disabled = true;
    const edit_type_id = e.target.id;
    document.getElementById(`${edit_type_id}-save`).style.display = 'block';
    const edit_type_name = document.getElementById(`${edit_type_id}-name`);
    const edit_type_price = document.getElementById(`${edit_type_id}-price`);
    const edit_type_des = document.getElementById(`${edit_type_id}-des`);
    const type_name_value = edit_type_name.textContent.trim();
    const type_price_value = edit_type_price.textContent.trim();
    const type_des_value = edit_type_des.textContent.trim();

    edit_type_name.innerHTML = `<input type='text' id="${edit_type_id}-name-update" value='${type_name_value}' style='width:150px'>`;
    edit_type_price.innerHTML = `<input type='text' id="${edit_type_id}-price-update" value='${type_price_value}' style='width:50px'>`;
    edit_type_des.innerHTML = `<textarea id="${edit_type_id}-des-update">${type_des_value}</textarea>`;
  }

  save_btn = (e) => {
    const type_id = e.target.id;
    const edit_type_id = type_id.substring(0, 8);

    const updated_values = {};

    updated_values['type_id'] = edit_type_id;
    updated_values['name'] = document.getElementById(`${edit_type_id}-name-update`).value;
    updated_values['price'] = document.getElementById(`${edit_type_id}-price-update`).value;
    updated_values['des'] = document.getElementById(`${edit_type_id}-des-update`).value;

    let is_undefined = false;
    for (value in updated_values) {
      if (updated_values[value].trim() === '') {
        is_undefined = true;
      }
    }

    if (is_undefined) {
      alert("Please Enter The Valid Details!");
    } else {
      updated_values_json = JSON.stringify(updated_values);
      document.getElementById('hiddenValues').value = updated_values_json;
      document.getElementById('updateForm').submit();
    }

  }

  addItemType = (e) => {
    const add_type_id = e.target.id.replace('-add', '');
    const item_id = add_type_id.substring(0, 6);

    const add_type_name_id = add_type_id + '-type-name';
    const add_type_price_id = add_type_id + '-type-price';
    const add_type_des_id = add_type_id + '-type-des';

    const add_type = {};

    add_type['add_type_name'] = document.getElementById(add_type_name_id).value;
    add_type['add_type_price'] = document.getElementById(add_type_price_id).value;
    add_type['add_type_des'] = document.getElementById(add_type_des_id).value;

    let is_undefined = false;
    for (value in add_type) {
      if (add_type[value].trim() === '') {
        is_undefined = true;
      }
    }

    if (is_undefined) {
      alert("Please Enter The Valid Details!");
    } else {
      add_type_json = JSON.stringify(add_type);
      document.getElementById('add-item-id').value = item_id;
      document.getElementById('add-hidden-values').value = add_type_json;
      document.getElementById(`add-type`).submit();
    }
  }
  remove_btn = (e) => {
    const remove_type_id = e.target.id.substring(0, 8);
    const confirm_to_remove = confirm("Are You Sure to Remove this Food Type Permanently?");
    if (confirm_to_remove) {
      document.getElementById('hiddenValues-remove').value = remove_type_id;
      document.getElementById('removeForm').submit();
    }
  }
</script>

<script>
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }

      const isActive = this.classList.contains('active');
      if (isActive) {
        document.getElementsByTagName('iframe').style.display = 'block';
      }
      else {
        document.getElementsByTagName('iframe').style.display = 'none';
      }
    });
  }
</script>


<script>
  document.addEventListener("DOMContentLoaded", function () {

    const menuVariety = document.querySelector(".iFrame-menuVariety");
    const addItemButton = document.getElementsByClassName("iFrame-addItem");

    curIndexDic = {};
    for (let i of addItemButton) {
      i.addEventListener("click", function () {

        const addItemButtonId = i.id;

        if (!curIndexDic[addItemButtonId]) {
          curIndexDic[addItemButtonId] = 2;
        }
        else {
          curIndexDic[addItemButtonId]++;
        }

        currentIndex = curIndexDic[addItemButtonId];

        const category = document.createElement("div");
        category.className = "IframeItemDiv";
        category.id = addItemButtonId + "-" + currentIndex;
        <?php $item_index += 1; ?>

        category.innerHTML = `<div class="iFrame-menuVarietyItem">
                    <span><input type="text" class="type-input-field ${addItemButtonId}-${currentIndex}" name="name"
                        id="${addItemButtonId}-${currentIndex}-type-name" placeholder="Food item's type"></span>
                    <div class="iFrame-priceItem">
                      <input type="number" class="type-input-field ${addItemButtonId}-${currentIndex}" name="price"
                        id="${addItemButtonId}-${currentIndex}-type-price"" placeholder="Price-₹"
                        class="iFrame-price">
                    </div>
                  </div>
                  <div class="iFrame-foodDes">
                    <textarea class="type-input-field ${addItemButtonId}-${currentIndex}" name="des" id="${addItemButtonId}-${currentIndex}-type-des""
                      placeholder="Description"></textarea>
                      <div class="addItem-div">
                        <button class="addItem-btn" id="${addItemButtonId}-${currentIndex}-add" onclick="addItemType(event)">Add</button>
                      </div>
                  </div>
                  `;

        const formToAppend = "iFrame-formToAppend-" + addItemButtonId;
        document.getElementById(formToAppend).appendChild(category);
      })
    }
    submitData = document.getElementById("submitData");
    submitData.addEventListener("click", function () {
      const inputFields = document.querySelectorAll(".type-input-field");
      const itemValues = {};
      inputFields.forEach(field => {
        itemId = field.classList[1];
        if (!itemValues[itemId]) {
          itemValues[itemId] = {};
        }
        itemValues[itemId][field.name] = field.value;
      });

      itemValuesJson = JSON.stringify(itemValues);
      document.getElementById("hiddenValue").value = itemValuesJson;
      document.getElementById("formToSubmit").submit();
    });
  });
</script>

<script>



</script>

</html>