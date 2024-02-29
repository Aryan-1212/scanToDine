<?php
include("../commonPages/index_header.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../indexPage/logo.ico">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Feedback</title>
    <meta charset="UTF-8">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    #Feedback {
        width: 100%;
        min-height: calc(100vh - 250px);
        height: auto;
        background-color: lightsteelblue;
    }

    #Feedback .FeedbackHeader {
        padding: 40px 0px 0px 0px;
    }

    #Feedback .FeedbackContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: auto;
        padding-top: 5%;
    }

    #Feedback .FeedbackContainer .Flex1 {
        background-color: whitesmoke;
        position: relative;
        margin: 0 0 5% 0;
        width: 48%;
        border: 2px solid whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        /* border-radius: 50px; */
    }

    #Feedback .FeedbackContainer .Img {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 100px;
    }

    #Feedback .FeedbackContainer .Img .fb-experience {
        text-align: center;
    }

    #Feedback .FeedbackContainer .Img img {
        border-radius: 500px;
    }

    #Feedback .FeedbackContainer ul li {
        list-style-type: none;
        margin: 10px 20px;
    }

    #Feedback .FeedbackContainer .Img ul li:nth-child(2) {
        margin: 0 10px;
    }

    #Feedback .FeedbackContainer img {
        height: auto;
        width: 100%;
    }

    #Feedback .FeedbackContainer .Cross .I {
        position: absolute;
        width: 350px;
        top: -10;
        right: 48%;
        bottom: 50%;
        /* right: 40%; */
    }

    #Feedback .FeedbackContainer .Cross .I img {
        width: 100%;
        height: auto;
        position: relative;
    }

    #Feedback .FeedbackContainer .Cross .I ul {
        position: absolute;
        top: 0;
        color: white;
    }

    #Feedback .FeedbackContainer .Cross .I ul li {
        margin: 5px 0;
    }

    #Feedback .FeedbackContainer .Cross button {
        padding: 0px 10px;
        border: none;
        text-align: center;
        outline: 0;
        background-color: red;
        color: white;
        font-weight: bolder;
        z-index: 3;
        position: absolute;
        top: -5px;
        right: -5px;
    }

    #Feedback .FeedbackContainer .Description p {
        padding: 0 30px;
    }

    #Feedback .no-data {
        color: red;
        font-size: xx-large;
    }

    @media only screen and (max-width: 1199px) {
        #Feedback .FeedbackContainer .Flex1 {
            width: 100%;
            margin: 25px 10px;
        }

        #Feedback .FeedbackContainer .Cross .I {
            position: absolute;
            width: 350px;
            bottom: 50%;
            right: 65%;
        }
    }

    @media only screen and (max-width: 991px) {
        #Feedback .FeedbackContainer .Cross .I {
            position: absolute;
            width: 350px;
            bottom: 50%;
            right: 53%;
        }

    }

    @media only screen and (max-width: 767px) {
        #Feedback .FeedbackContainer .Cross .I {
            position: absolute;
            width: 350px;
            top: -10;
            right: 35%;
        }

    }

    @media only screen and (max-width: 537px) {
        #Feedback .FeedbackContainer .Cross .I {
            position: absolute;
            width: 350px;
            top: -10;
            left: 0;
        }
    }

    @media only screen and (max-width: 400px) {
        #Feedback .FeedbackContainer .Cross .I {
            position: absolute;
            width: 350px;
            top: -10;
            right: 0;
        }
    }

    @media only screen and (max-width: 391px) {
        #Feedback .FeedbackContainer .Cross .I img {
            width: 81%;
            height: auto;
            position: relative;
        }

        #Feedback .FeedbackContainer .Cross .I {
            font-size: 13px;
            position: absolute;
            width: 350px;
            top: -10px;
            right: 10px;
            left: 0;
        }
    }
</style>

<body>

    <section id="Feedback">
        <div class="container">
            <div class="FeedbackHeader">
                <h2>Feedbacks</h2>
            </div>
            <div class="FeedbackContainer" id="FeedbackContainer">

                <?php
                include("../commonPages/dbConnect.php");
                $res_code = $_SESSION['res_code'];
                $queryToFetch = "select * from feedbacks where  res_code = $res_code";
                $result = mysqli_query($con, $queryToFetch);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fb_id = $row["id"];
                        $name = $row['username'];
                        $email = $row['fb_email'];
                        $subject = $row['fb_subject'];
                        $experience = $row['rating'];
                        $description = $row['fb_description'];
                        ?>
                        <div class="Flex1" id="<?php echo $fb_id; ?>">
                            <div class="Cross">
                                <button class="buttonToBeClicked closeBtn" id="<?php echo "btn-" . $fb_id; ?>">X</button>
                                <div class="I">
                                    <img src="../adminModule/feedback.png" alt="">
                                    <ul>
                                        <li class="fb-name">
                                            <?php echo $name; ?>
                                        </li>
                                        <li class="fb-email">
                                            <?php echo $email; ?>
                                        </li>
                                        <li class="fb-subject">
                                            <?php echo $subject ?>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="Img">
                                <ul>
                                    <li style="width: 100px;">
                                        <img src="../adminModule/user.jpg" alt="">
                                    </li>
                                    <li class="fb-experience">
                                        Rating -
                                        <?php echo $experience; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="Description">
                                <p>
                                    <?php echo $description; ?>
                                </p>
                            </div>
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="no-data">No Feedbacks Available.</div>
                    <?php
                }
                mysqli_close($con);
                ?>
            </div>
        </div>
    </section>

    <?php
    include("../commonPages/index_footer.html");
    ?>

</body>
<script>
    const feedbacks = document.querySelector('#FeedbackContainer');
    feedbacks.addEventListener('click', function (event) {
        if (event.target.classList.contains('closeBtn')) {
            const fbIdToDelete = event.target.parentNode.parentNode.id;
            const confirmToDelete = window.confirm("Do You really want to delete this feedback?");
            if (confirmToDelete) {
                window.location.href = `./feedbackDelete.php?fb_Id=${fbIdToDelete}`;
            }
        }
    })
</script>


</html>