<?php
include("../commonPages/dbConnect.php");
$selectedItemsjson = $_POST['selecteditems'];
$selectedItems = json_decode($selectedItemsjson, true);

session_start();
$_SESSION['selectedItems'] = $selectedItems;

?>
<?php
if ($_POST['selecteditems']) {
  ?>

  <script>
    localStorage.removeItem('selected_items');
  </script>
  <?php
}
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

    .container {
      margin-bottom: 50px;
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

    .iFrame-menuDescription .img img {
      width: 100%;
      height: 60vh;
    }

    @media (max-width: 768px) {
      .iFrame-menuItem {
        flex-wrap: wrap;
        overflow-y: scroll;
      }

      .iFrame-menuDescription .img img {
        height: 40vh;
      }

      h2 {
        text-align: center;
      }

      p {
        text-align: center;
      }

      .formToAppend{
        overflow: scroll;
      }

      .iFrame-content {
        border-bottom: 2px solid black;
      }

      .iFrame-menuItem {
        /* height: auto; */
      }

      .iFrameItemDiv{
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

      .iFrame-menuDescription .img img {
        height: 40vh;
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

    
  </style>
</head>

<body>
  <section class="menu">

    <div class="container">
      <h1>Menu</h1>

      <?php
      foreach ($selectedItems as $val) {
        $item_index = 1;
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
                  <div class="iFrameItemDiv" id="<?php echo $item_id . "-" . $item_index; ?>">
                    <div class="iFrame-menuVarietyItem">
                      <span><input type="text" class="type-input-field <?php echo $item_id . "-" . $item_index; ?>"
                          name="name" id="<?php echo $item_id . "-" . $item_index . '-type-name' ?>"
                          placeholder="Food item's type"></span>
                      <div class="iFrame-priceItem">
                        <input type="number" class="type-input-field <?php echo $item_id . "-" . $item_index; ?>" name="price"
                          id="<?php echo $item_id . "-" . $item_index . '-type-price' ?>" placeholder="Price-₹"
                          class="iFrame-price">
                      </div>
                    </div>
                    <div class="iFrame-foodDes">
                      <textarea class="type-input-field <?php echo $item_id . "-" . $item_index; ?>" name="des"
                        id="<?php echo $item_id . "-" . $item_index . '-type-des' ?>" placeholder="Description"></textarea>
                    </div>
                  </div>
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
    <form action="menu_entry.php" method="post" id="formToSubmit">
      <input type="hidden" id="hiddenValue" name="data">
      <div class="Button">
        <input type="button" value="Submit" id="submitData">
      </div>
    </form>
  </section>



</body>

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
                  </div>`;

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