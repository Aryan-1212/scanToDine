<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Forget Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .container {
            width: 40%;
            margin: 150px auto;
            padding: 75px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            width:auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .email-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom:5%;
            outline:none;
        }

        .reset-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: white;
            border: 1px solid #4CAF50;
            color: #4CAF50;
        }

        .reset-button:hover {
            background-color: #4CAF50;
            color: white;
            transition-duration: 1s;
        }
        input:focus {
            box-shadow: 1px 3px 35px 1px green;
            transition-duration:0.5s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="heading">Forget Password</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email" class="label">New Password:</label>
                <input type="Password" id="email" name="email" class="email-input" placeholder="Enter.." required>
                <label for="email" class="label">Confirm Password:</label>
                <input type="Password" id="email" name="email" class="email-input" placeholder="Enter.." required>
            </div>
            <div class="form-group">
                <button type="submit" class="reset-button" name="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
</html>
