<?php require('session.php')     ;
 require('db.php') ; require('notallowed.php');

 
 
 if(isset($_POST['goals'])&& isset($_POST['files']) && !empty($_POST['date']) &&!empty ($_FILES))
 {   
    // Specify the target directory where the file will be uploaded
    $target_dir = "homework/";

    // Get the file name and its path
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    // Get file information
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if the file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        exit();
    }

    // Limit the file size (for example, 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

 

    // Try to upload the file
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    } 
  $goals=$_POST['goals'];
  $directory=$target_file;
  $files=$_POST['files'];
  $date=date("Y-m-d");
  $hdate=$_POST['date'];
  $sqlh='SELECT ID
FROM homework
WHERE ID = (SELECT MAX(ID) FROM homework);
';
 
$res=mysqli_query($connection,$sqlh);

if ($res && mysqli_num_rows($res) > 0) {
    
    $row = mysqli_fetch_assoc($res);
    
    $current_id = (int) $row['ID'];
    
    $current_id = $current_id + 1;
    echo "Next ID: $current_id";
} else {
    
 $current_id=1;
}
  echo $current_id;
  $subject='Υποβλήθηκε η εργασία '  .$current_id;
  $text= 'Η ημερομηνία παράδοσης της εργασίας είναι ' .$hdate;
  
  
  $sqlq="INSERT INTO homework(GOALS,DESCRIPTION,FILES,DEADLINE) VALUES ('$goals','$directory','$files','$hdate')";
  
  $sqlia="INSERT INTO announcements(DATE,SUBJECT,TEXT) VALUES ('$date','$subject','$text')";

  if(mysqli_query($connection,$sqlq)&&mysqli_query($connection,$sqlia)) header('Location:homework.php')     ;


}


  



 
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
    <div class="title">Δημιουργία Εγγράφου</div>
    <div style="flex-direction: column; display:flex">
    <form action="homework_m.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="goals"> Στόχοι (χωρισμένοι με κόμμα)</label>
            <input type="text" name="goals" id="goals">
        </div>
    <div class="form-group">
            <label for="fileToUpload">  Αρχείο Εκφώνησης:</label>
          <input type="file" name="fileToUpload" id="fileToUpload"> 
        </div>   
         <div class="form-group">
            <label for="files">Παραδοτέα (χωρισμένα με κόμμα) </label>
            <input type="text"   name="files" id="files"> 
        </div>
         <div class="form-group">
            <label for="date"> Προθεσμία </label>
            <input type="date"  name="date" id="date"> 
        </div>
        <button type="submit" style="width:100px; margin-left:50%;" ;">Submit</button>
 
    </form>


</body>
</html> '   ;}       


/*else if($_GET['action']=='delete'){ $id=mysqli_real_escape_string($connection,$_GET['ID']); $sqlq="DELETE FROM documents WHERE ID=$id";
    if(mysqli_query($connection,$sqlq))
    {   if (file_exists($_GET['directory'])) {
        
        unlink($_GET['director']);

    }
    else echo 'no file with this name found';
      header('Location:documents.php'); }
    }   */

    if ( isset($_GET['action']) && $_GET['action'] == 'delete') {
        // Ensure proper sanitization of the ID
        $id = mysqli_real_escape_string($connection, $_GET['ID']);
        
        // Prepare the SQL query
        $sqlq = "DELETE FROM homework WHERE ID='$id'"; // Use single quotes for $id to safely handle numbers and strings
        
        // Execute the query
        if (mysqli_query($connection, $sqlq)) {
            // Check if the file exists and delete it
            if (isset($_GET['directory']) && file_exists($_GET['directory'])) {
                unlink($_GET['directory']); // Corrected variable name to 'directory'
            } else {
                echo 'No file with this name found';
            }
            
            // Redirect after successful deletion
            header('Location: homework.php');
            exit; // Always use exit after a header redirect
        } else {
            // Error handling in case the SQL query fails
            echo 'Error deleting record: ' . mysqli_error($connection);
        }
    }
    
    



?>