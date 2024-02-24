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
            background-color: lightsteelblue;
        }

        .container {
            width: 40%;
            margin: 80px auto;
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
            width: auto;
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

        .password-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 5%;
            outline: none;
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
        #error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="heading">Forget Password</h2>
        <form method="post" action="" id="passwordForm">
            <div class="form-group">
                <label for="password" class="label">New Password:</label>
                <input type="password" id="password" name="password" class="password-input" placeholder="Enter.."
                    required>
                <label for="confirmPassword" class="label">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="password-input"
                    placeholder="Enter.." required>
                 <label id="error"></label>
            </div>
            <div class="form-group">
                <button type="submit" class="reset-button" name="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
<script>
    document.getElementById("passwordForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

     const password = document.getElementById("password");
     const confirmPassword = document.getElementById("confirmPassword");
     const passError = document.getElementById("error");


    if (password.value !== confirmPassword.value) {
        passError.innerHTML = "Password must be same!";
        password.style.borderColor = 'red';
        confirmPassword.style.borderColor = 'red';
        return false;
    } 
});

</script>
</html>