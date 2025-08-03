<?php require('session.php') ; ?>
<?php include('db.php') ; 
$sqlq='SELECT * FROM homework';
$res=mysqli_query($connection,$sqlq);
$homework=mysqli_fetch_all($res,MYSQLI_ASSOC);



mysqli_free_result($res) ;
mysqli_close($connection) ;    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
 


    .header {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      
      
      left: 50%;
      transform: translateX(-50%);
      font-size: 24px; /* Adjust the font size */
      z-index: 10;
    }
.homework_element{  border-top: solid;

 
 


}

  .homework_text{
      padding-left: 90px;

  }
   
  .headers{
  color:green;

  }
    
    /* Sidebar styles */
    .sidebar {
      width: 200px;
      background-color: #ffffff;
      position: fixed;
      top: 50px; /* Moves the sidebar below the title */
      left: 0;
      height: 100%;
      color: white;
      margin-top: 50px;
      padding-top: 20px;
    }

    .sidebar a {
      display: block;
      text-align: center;
      background-color: #787c83;

      color: rgb(255, 255, 255);
      padding: 30px;
      margin: 10px;
      font-size: 16px; 
      text-decoration: none;

    }

    /* Main content area */
    .main-content {
      margin-left: 200px; /* Space for the sidebar */
      margin-top: 100px; /* Pushes content below the title */
      padding: 16px;
    }
.main-content p{font-size: 20px;}
    /* Ensure body has no margin */
    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }
    
    /* Flexbox layout for content and sidebar */
    .content-wrapper {
     
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
    }

  </style>
</head>
<body >
    <a name="top"></a>

  <!-- Title in the upper center -->
  <div class="header">
    <h1>Εργασίες</h1>
  </div>

  <!-- Content wrapper that holds both sidebar and content -->
  <div class="content-wrapper">
    
      <?php include('side.php') ?> 

   
    <div class="main-content">

     <?php if ($_SESSION["user"]=='tutor'){
        echo '<div class="homework_element"> <div class="headers">  <h2> <a href=
        "homework_m.php">   Προσθήκη νέας εργασίας </a> </h2> </div> </div> ' ; }    ?>
   <?php foreach($homework as $hwelement) 
   {  $goals=explode(',',$hwelement['GOALS']);
     $files=explode(',',$hwelement['FILES']);              
     $dateString = $hwelement['DEADLINE'];  
$timestamp = strtotime($dateString);  
$formattedDate = date('d/m/Y', $timestamp);  

    ?>

<div class="homework_element">   
    <div class="headers">  <h2>  Εργασία <?php echo $hwelement['ID'] ; 
      if ($_SESSION["user"] == 'tutor') { 
        echo '<a href="homework_m.php?action=delete&ID=' . urlencode($hwelement['ID']) . '&directory=' . urlencode($hwelement['DESCRIPTION']) . '"> [Διαγραφή]</a>';
    }
    
    ?> </h2>
       
      
     
    </div>
      <div class="homework_text"> 
      <p> Στόχοι: Οι στόχοι της εργασίας είναι
    <ol>
        <?php 
        foreach($goals as $goal) {
            // Properly apply htmlspecialchars() to escape special characters
            echo '<li>' . htmlspecialchars($goal) . '</li>' .'<br>';
        }
        ?>
    </ol>




       </p>
         <p> <i> Εκφώνηση:  </i> <br> <br> &nbsp;&nbsp;&nbsp; Κατεβάστε την εργασία από <a href="<?php echo $hwelement['DESCRIPTION']; ?>" download>εδώ</a> </p>
          <p> <i> Παραδοτέα</i>:  <ol> <?php foreach($files as $file)  echo'<li>' .htmlspecialchars($file) . '</li>'. '<br>' ?> </ol> </p> <br>
          <p>   <i><span style="color: red;">Ημερομηνία παράδοσης</span></i> : <?php echo $formattedDate ; ?></p>
    
    </div>       
<?php }  ?>





    
 <div style="padding-left: 40pc;"> <a href="#top">Αρχή</a></div>
  </div>

</body>
</html>