<?php
session_start();  


include('db.php');  // Include database connection

// Debugging: Check if loginame is being posted
if (isset($_POST['loginame'])) {
    print_r($_POST['loginame']);
}

if (isset($_POST['loginame'], $_POST['password'])) {
    // Ensure both loginame and password are provided
    $loginame = $_POST['loginame'];
    $password = $_POST['password'];

    // Construct the SQL query
    $sqlq = "SELECT * FROM users WHERE LOGINAME='" . $loginame . "' AND PASSWORD='" . $password . "'";

    // Execute the query
    $res = mysqli_query($connection, $sqlq);
    $user = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // Debugging: Print role from the fetched data
    
    // Check if any rows are returned
    if ($res && mysqli_num_rows($res) > 0) {

        // Process the result and set the session variable
        $_SESSION["user"] = $user[0]['ROLE'];
     
        // Debugging: Check if session variable is set
        echo "Session user role: " . $_SESSION["user"];

        // Redirect to index.php after successful login
        header('Location: index.php');
        exit();  // Ensure the script stops after redirect
    } else {
        echo "No user found with the provided credentials.";
    }
} else {
    echo "Please enter both login and password.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

      
        .title {
            font-size: 50px;
            margin-bottom:4%;
            margin-top: 10%;
            
        }

        form {
           display: inline-block;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 70px;
        }

        
        label {
            font-size: 25px;
            margin-bottom: 10px;
            
        }

        input {
            width: 300px;
            padding: 10px;
            font-size: 18px;
            margin-top: 5px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="title">Πιστοποίηση</div>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Username:</label>
            <input type="email" name='loginame' id="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name='password' id="password">
        </div>
        <button type="submit" style="display:none;">Submit</button>
 
    </form>
</body>
</html>

