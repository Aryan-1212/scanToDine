<?php include("../commonPages/index_header.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="slick.css"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Feedback</title>
    <meta charset="UTF-8">
</head>

<style>

    ::-webkit-scrollbar{
        display: none;
    }
    #Feedback {
        width: 100%;
        height: auto;
        font-family: 'Poppins', sans-serif;
    }

    #Feedback .FeedbackContainer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: auto;
    }

    #Feedback .FeedbackContainer .Flex1 {
        background-color: whitesmoke;
        position: relative;
        margin: 5% 0;
        width: 100%;
        border: 2px solid whitesmoke;
        box-shadow: 5px 6px #888888;
        border-radius: 50px;
    }

    #Feedback .FeedbackContainer .Img {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 100px;
    }

    #Feedback .FeedbackContainer .Img .fb-experience{
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
        top: 0;
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
        position: absolute;
        top: 0;
        right: 0;
    }

    #Feedback .FeedbackContainer .Description p {
        padding: 0 30px;
    }

    @media only screen and (max-width: 1199px) {
        #Feedback .FeedbackContainer .Flex1 {
            width: 100%;
            margin: 100px 0;
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
            top: 0;
            left: 0;
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
            top: 20px;
            left: 0;
        }
    }
</style>

<body>

    <section id="Feedback">
        <div class="container">
            <div class="FeedbackContainer" id="FeedbackContainer">

            <?php
                include("../commonPages/dbConnect.php");
                $res_code = 421340;
                $queryToFetch = "select * from feedbacks where  res_code = $res_code";
                $result = mysqli_query($con, $queryToFetch);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fb_id = $row["id"];
                        $name = $row['username'];
                        $email = $row['fb_email'];
                        $subject = $row['fb_subject'];
                        $experience = $row['experience'];
                        $description = $row['fb_description'];
                        ?>
                <div class="Flex1" id="<?php echo $fb_id; ?>">
                    <div class="Cross">
                        <button class="buttonToBeClicked closeBtn" id="<?php echo "btn-".$fb_id; ?>">X</button>
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
                                <?php echo $experience; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="Description">
                        <p><?php echo $description; ?></p>
                    </div>
                </div>

                <?php 
                    }
                } else {
                    echo "No feedback available.";
                }
                mysqli_close($con);
                ?>
            </div>
        </div>
    </section>



</body>
<script>
        const feedbacks = document.querySelector('#FeedbackContainer');
        feedbacks.addEventListener('click', function(event){
            if(event.target.classList.contains('closeBtn')){
                const fbIdToDelete = event.target.parentNode.parentNode.id;
                const confirmToDelete = window.confirm("Do You really want to delete this feedback?");
                if(confirmToDelete){
                    window.location.href = `./feedbackDelete.php?fb_Id=${fbIdToDelete}`;
                }
            }
        })
</script>


</html>