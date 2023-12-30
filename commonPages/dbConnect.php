<?php
    $con = mysqli_connect("localhost", "root", "", "scantodine");
    if(!$con){
        echo "Unexpected Error Occurs!";
        ?>
            <script>
                alert("Unexpected Error Occurs!");
                </script>
        <?php
    }
?>