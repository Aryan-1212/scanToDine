<?php include("../commonPages/index_header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }

  body {
    background-color: var(--whitesmoke);
  }

  :root {
    --whitesmoke: whitesmoke;
    --red: #cf3427;
    --white: white;
  }
   
  .contact {
    background-color: var(--white);
    color: black;
    padding: 2%;
    padding-top: 0%;
    padding-bottom: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 85%;
    margin: 100px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    height: auto;
    /* border: 1px solid #cf3427; */
  }

  .contactForm {
    padding-top: 2%;
    width: 100%;
    height: auto;
  }

  .head {
    background-color: #cf3427;
    margin: 0;
    padding: 10px;
    color: var(--white);
  }

  #form {
    margin-top: 5%;
    display: flex;
    flex-direction: column;
  }

  label {
    font-weight: bold;
    margin-bottom: 5px;
    text-align: left;
  }

  input,
  textarea {
    padding: 10px;
    margin-bottom: 10px;
  }

  textarea {
    resize: vertical;
  }

  #submit {
    padding: 10px 20px;
    background-color: #cf3427;
    color: var(--white);
    border: none;
  }

  #submit:hover {
    background-color: green;
    transition-duration: 1s;
  }

</style>

<body>
  <section class="contactSec">
    <div class="container">
      <div class="contact">
        <div class="contactForm">
          <div class="head">
            <h1>Contact Us</h1>
          </div>
          <p>If you have any questions or inquiries, please feel free to contact us using the form below:</p>

          <form action="#" method="post" id="form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name.." required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email.. Ex : abc@gmail.com" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" placeholder="Enter.." required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" placeholder="Enter your questions or inquiries.."
              required></textarea>

            <button type="submit" name="submit" id="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php
    include("./index_footer.html");
  ?>

</body>

</html>