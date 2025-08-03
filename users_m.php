<?php 
require('session.php');
require('db.php');

// If the form is submitted with a title and text for the announcement
if (isset($_POST['name']) && isset($_POST['surname'])&&isset($_POST['loginame']) && isset($_POST['password']) &&isset($_POST['role'])  ) {
    // Sanitize the input data
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $loginame = mysqli_real_escape_string($connection, $_POST['loginame']);
    $password=  mysqli_real_escape_string($connection, $_POST['password']);
    $role = $_POST['role'] ;

   
    // If there is a date and ID to delete, we remove the old announcement
    if ( isset($_SESSION['logtodel'])) {
        
        $loginame = $_SESSION['logtodel'];
        unset($_SESSION['logtodel']);
        
       

        // Ensure loginame is sanitized if not using prepared statements
        $loginame = mysqli_real_escape_string($connection, $loginame);
        
        // Corrected SQL query with the correct column name (loginame)
        $sqlq = "DELETE FROM users WHERE LOGINAME = '$loginame'";
        mysqli_query($connection, $sqlq);
        
    }
    $sqlk = "SELECT * FROM users WHERE LOGINAME = '" . mysqli_real_escape_string($connection, $loginame) . "'";

  $res=mysqli_query($connection,$sqlk);
  $arr=mysqli_fetch_all($res,MYSQLI_ASSOC);
   if(empty($arr))
   {
    
    $sqlq = "INSERT INTO users (NAME, SURNAME, LOGINAME,PASSWORD,ROLE) VALUES ('$name', '$surname','$loginame','$password','$role' )";
    if(mysqli_query($connection,$sqlq)) header('Location:users.php')  ; }
    else echo'username already in use';
}

// If no action is specified, show the form to create a new announcement
if (!isset($_GET['action'])) {
    echo '
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
                margin-bottom: 4%;
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

            input, textarea {
                width: 300px;
                padding: 10px;
                font-size: 18px;
                margin-top: 5px;
                border: 2px solid #ccc;
                border-radius: 5px;
            }

            textarea {
                height: 100px;
                width: 800px;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="title">Δημιουργία  Χρήστη </div>
        <form action="users_m.php" method="POST">
            <div class="form-group">
                <label for="name">Όνομα:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="surname">Επίθετο:</label>
                <input type="text" name="surname" id="surname">
            </div>
           <div class="form-group">
                <label for="loginame">Όνομα χρήστη</label>
                <input type="text" name="loginame" id="loginame">
            </div>
             <div class="form-group">
                <label for="password">Κωδικός</label>
                <input type="text" name="password" id="password">
            </div>


            <div> 
               <input type="radio" name="role" value="student" id="student" />
                <label for="student">student</label>
                <input type="radio" name="role" value="tutor" id="tutor" />
               <label for="tutor">tutor</label>
            </div>
            <button type="submit">Submit</button>
        </form>
    </body>
    </html>';
} 

// If the action is to delete an announcement
else if ($_GET['action'] == 'delete') {
    // Sanitize the ID from the URL
    $loginame = mysqli_real_escape_string($connection, $_GET['loginame']);
    
    // Prepare and execute the delete query using prepared statements
    $sqlq = "DELETE FROM users WHERE LOGINAME = '" . mysqli_real_escape_string($connection, $loginame) . "'";
    if(mysqli_query($connection,$sqlq))
    header('Location:users.php');  
    
}

// If the action is to modify an announcement
else if ($_GET['action'] == 'modify') {
    // Sanitize the ID from the URL
    $loginame = mysqli_real_escape_string($connection, $_GET['loginame']);
    $sqlk = "SELECT * FROM users WHERE LOGINAME = '" . mysqli_real_escape_string($connection, $loginame) . "'"; 
   
    $res=mysqli_query($connection,$sqlk);
    $u= mysqli_fetch_all($res,MYSQLI_ASSOC);
    
     
        
        // Check if the announcement exists
        if ($u) {
            $name = htmlspecialchars($u[0]['NAME'], ENT_QUOTES, 'UTF-8');
            $surname = htmlspecialchars($u[0]['SURNAME'], ENT_QUOTES, 'UTF-8');
            $loginame = htmlspecialchars($u[0]['LOGINAME'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($u[0]['PASSWORD'], ENT_QUOTES, 'UTF-8');
            $role = htmlspecialchars($u[0]['ROLE'], ENT_QUOTES, 'UTF-8');
            
           
            $_SESSION['logtodel'] = $loginame;
            

            echo '
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
                margin-bottom: 4%;
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

            input, textarea {
                width: 300px;
                padding: 10px;
                font-size: 18px;
                margin-top: 5px;
                border: 2px solid #ccc;
                border-radius: 5px;
            }

            textarea {
                height: 100px;
                width: 800px;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="title">Δημιουργία Χρήστη </div>
        <div "flex-direction: column; display:flex">
        <form action="users_m.php" method="POST">
            <div class="form-group">
                <label for="name">Όνομα:</label>
                <input type="text" name="name" id="name" value="' . htmlspecialchars($name) . '" >
            </div>
            <div class="form-group">
                <label for="surname">Επίθετο:</label>
                <input type="text" name="surname" id="surname" value="' . htmlspecialchars($surname) . '">
            </div>
            <div class="form-group">
                <label for="loginame">Όνομα χρήστη</label>
                <input type="text" name="loginame" id="loginame" value="' . htmlspecialchars($loginame) . '">
            </div>
            <div class="form-group">
                <label for="password">Κωδικός</label>
                <input type="text" name="password" id="password" value="' . htmlspecialchars($password) . '">
            </div>

            <div> 
                <input type="radio" name="role" value="student" id="student" />
                <label for="student">student</label>
                <input type="radio" name="role" value="tutor" id="tutor" />
                <label for="tutor">tutor</label>
            </div>
            <button type="submit">Submit</button>
        </form> </div>
    </body>
</html>';
        } else {
            echo 'user not found.';
        }
    }

?>
