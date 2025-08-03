 
 <?php require('session.php')     ;
 require('db.php') ; require('notallowed.php');
 
if(isset($_POST['title'])&& isset($_POST['text'])){
$title=$_POST['title'];
$text=$_POST['text'];
$date=date("Y-m-d");
if(isset($_SESSION['date'])&&isset($_SESSION['idtodel'])){


$date=$_SESSION['date'];
$idd=$_SESSION['idtodel'];
$sqlq='DELETE FROM announcements WHERE ID=' . $idd;
mysqli_query($connection,$sqlq);
unset($_SESSION['idtodel']);   
unset($_SESSION['date']);

}
$sqlq="INSERT INTO announcements(DATE,SUBJECT,TEXT) VALUES ('$date','$title','$text')";

  if(mysqli_query($connection,$sqlq)) header('Location:announcements.php');


}
 if (!isset($_GET['action'])) { {echo '
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
    <div class="title">Δημιουργία Ανακοίνωσης</div>
    <div  style="flex-direction: column; display:flex">
    <form action="announcements_m.php" method="POST">
        <div class="form-group">
            <label for="title">Τίτλος:</label>
            <input type="text" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="text">Κείμενο:</label>
            <textarea  style="height: 100px ; width:800px";  name="text" id="text"> </textarea>
        </div>
        <button type="submit" ;">Submit</button>
 
    </form> </div>
</body>
</html> '   ;}  
    
}else if($_GET['action']=='delete'){ $id=mysqli_real_escape_string($connection,$_GET['ID']); $sqlq="DELETE FROM announcements WHERE ID=$id";
    if(mysqli_query($connection,$sqlq))
      header('Location:announcements.php');
    }

  else if($_GET['action']=='modify'){
    $id=mysqli_real_escape_string($connection,$_GET['ID']); 
    $sqlq = 'SELECT * FROM announcements WHERE ID=' . $id;

     $res=mysqli_query($connection,$sqlq);
     $announcement=mysqli_fetch_all($res,MYSQLI_ASSOC);
     
     $subject=$announcement[0]['SUBJECT'];
     $text=$announcement[0]['TEXT'];
     
     $date= $announcement[0]['DATE'];

     $_SESSION['date']=$date;
     $_SESSION['idtodel']=$id;

     //$sqlq='DELETE FROM announcements WHERE ID=' . $id;
     //mysqli_query($connection,$sqlq);
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
    <div class="title">Επεξεργασία Ανακοίνωσης</div>
    <form action="announcements_m.php" method="POST">
        <div class="form-group">
            <label for="title" >Τίτλος:</label>
           <input type="text" name="title" value="' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '" id="title">;
        </div>
        <div class="form-group">
            <label for="text">Κείμενο:</label>
            <textarea  style="height: 100px ; width:800px";    name="text" id="text"> '.htmlspecialchars($text, ENT_QUOTES , 'UTF-8');' </textarea>
        </div>
        <button type="submit" style="display:none;">Submit</button>
 
    </form>
</body>
</html> '   ;












  }

  ?>
