<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About us - ScanToDine</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
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

    body {
      background-color: var(--whitesmoke);
    }

    .about {
      margin: 100px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .header {
      text-align: center;
      color: var(--red);
      margin-bottom: 30px;
    }

    .header h1 {
      font-size: 36px;
    }

    .header h5 {
      margin-top: 3%;
      font-size: 25px;
    }
    .header h2 {
      font-size: 25px;
    }

    .people {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      border-bottom: 1px solid black;
    }

    .peopleItem {
      width: calc(33.33% - 20px);
      margin-right: 20px;
      margin-bottom: 20px;
    }

    .people .image{
      height: 450px;
    }

    .people .image img {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 10px;
      height: 450px;
    }

    .people .info {
      text-align: center;
      padding: 20px;
    }

    .people h3 {
      font-size: 24px;
      color: var(--red);
      margin: 10px 0;
    }

    .people p {
      font-size: 16px;
      color: #555;
    }

    .fa-brands.fa-xl {
      font-size: 24px;
      color: #cf3427;
      margin: 5px;
    }

    .summary {
      margin-top: 30px;
    }

    .summary ul li {
      font-size: 20px;
      margin-bottom: 1%;
    }

    .summary ul {
      list-style-type: disc;
      padding-left: 20px;
      font-size: 18px;
      color: #333;
    }

    @media (max-width: 1024px) {
      .peopleItem {
        width: calc(50% - 20px);
      }
    }

    @media (max-width: 768px) {
      .peopleItem {
        width: calc(100% - 20px);
      }
    }
  </style>
</head>

<body>

    <?php
      include("./index_header.php");
    ?>

  <section class="aboutUs">
    <div class="about container">
      <div class="header">
        <h1>ABOUT US</h1>
        <h2>Welcome to ScanToDine, where the art of dining meets the power of technology.</h2>
        <h5>Meet our expert team members</h5>
      </div>
      <div class="people">
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/aryan.jpg" alt="Aryan Parvani"></div>
          <div class="info">
            <h3>ARYAN PARVANI</h3>
            <p>TEAM LEADER + FULL STACK DEVELOPER</p>
            <p>(Expertise in Documentation, PHP, MySQL, PYTHON, HTML, Javascript, CSS and Leadership)</p>
            <i class="fa-brands fa-facebook fa-xl"></i>
            <i class="fa-brands fa-instagram fa-xl"></i>
            <i class="fa-brands fa-linkedin fa-xl"></i>
          </div>
        </div>
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/neel.jpg" alt="Neel Parikh"></div>
          <div class="info">
            <h3>NEEL PARIKH</h3>
            <p>CONTENT CURATOR</p>
            <p>(Expertise in Content writing, Formatting, Documentation, HTML and CSS)</p>
            <i class="fa-brands fa-facebook fa-xl"></i>
            <i class="fa-brands fa-instagram fa-xl"></i>
            <i class="fa-brands fa-linkedin fa-xl"></i>
          </div>
        </div>
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/shivang.jpg" alt="Shivang Pandya"></div>
          <div class="info">
            <h3>SHIVANG PANDYA</h3>
            <p>DATA MODELER + FRONT-END DEVELOPER</p>
            <p>(Expertise in Data Models designer, HTML, CSS, Javascript, Bootstrap and Documentation)</p>
            <i class="fa-brands fa-facebook fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-instagram fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-linkedin fa-xl" style="color: #cf3427;"></i>
          </div>
        </div>
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/deep.png" alt="Deep Patel"></div>
          <div class="info">
            <h3>DEEP PATEL</h3>
            <p>FRONT-END DEVELOPER</p>
            <p>(Expertise in HTML, CSS, Javascript, PHP, Bootstrap, and React JS)</p>
            <i class="fa-brands fa-facebook fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-instagram fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-linkedin fa-xl" style="color: #cf3427;"></i>
          </div>
        </div>
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/om.png" alt="Om Patel"></div>
          <div class="info">
            <h3>OM PATEL</h3>
            <p>FIGMA DESIGNER</p>
            <p>(Expertise in Figma designing, Content writing and Documentation)</p>
            <i class="fa-brands fa-facebook fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-instagram fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-linkedin fa-xl" style="color: #cf3427;"></i>
          </div>
        </div>
        <div class="peopleItem">
          <div class="image"><img src="../commonPages-images/brijesh.png" alt="Brijesh PARNALIYA"></div>
          <div class="info">
            <h3>BRIJESH PARNALIYA</h3>
            <p>CONTENT CURATOR</p>
            <p>(Expertise in Documentation, Content writing, HTML and CSS)</p>
            <i class="fa-brands fa-facebook fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-instagram fa-xl" style="color: #cf3427;"></i>
            <i class="fa-brands fa-linkedin fa-xl" style="color: #cf3427;"></i>
          </div>
        </div>
      </div>

      <div class="summary">
        <ul>
          <li>We are a team of tech enthusiasts, food lovers, and entrepreneurs who saw an opportunity to simplify and
            enhance the restaurant experience. </li>
          <li>Our diverse team brings together expertise in software development, user
            experience design, and culinary arts to create ScanToDine.</li>
          <li>ScanToDine is a digital food ordering system that empowers restaurant owners and customers alike. For
            restaurant owners, we offer a user-friendly platform to create digital menus, manage inventory, and
            streamline their operations. For customers, we provide a convenient and contactless way to browse menus,
            place orders, and pay bills.</li>
          <li>Why Choose ScanToDine
            <ol>
              <li>Simplicity: We make dining out or ordering in a breeze, with just a few taps on your smartphone.</li>
              <li>Engagement: Our platform enhances your dining experience with interactive features, personalized
                recommendations, and easy feedback options.</li>
              <li>Efficiency: For restaurant owners, we offer tools to manage orders, inventory, and customer feedback
                efficiently.</li>
              <li>Safety: Our contactless payment and ordering options prioritize your safety and convenience.</li>
            </ol>
          </li>
          <li>We invite you to join us on this exciting journey to the future of dining. Whether you're a restaurant
            owner looking to streamline your operations or a customer seeking a more interactive and convenient dining
            experience, ScanToDine is here to serve you.</li>
        </ul>
      </div>
    </div>
  </section>

  <?php
    include("./index_footer.html");
  ?>
</body>

</html>