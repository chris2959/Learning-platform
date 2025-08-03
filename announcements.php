  
  <?php require('session.php') ; ?>
<?php include('db.php') ; 
 $sqlq='SELECT * FROM announcements';
 $res=mysqli_query($connection,$sqlq);
 $announcements=mysqli_fetch_all($res,MYSQLI_ASSOC);


 mysqli_free_result($res) ;
 mysqli_close($connection) ;

 
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Ανακοινώσεις</title>
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
.announcement_element{  border-top: solid;

 
 


}

  .announcement_text{
      padding-left: 90px;

  }
   
  .headers{
  color:green;

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
    <h1>Ανακοινώσεις</h1>
  </div>

  <!-- Content wrapper that holds both sidebar and content -->
  <div class="content-wrapper">
    
  <?php include('side.php') ?>

    <!-- Main content -->
    <div class="main-content">
  <?php if ($_SESSION["user"] == 'tutor'){
  echo '<div class="announcement_element">   
  <div class="headers">  <h2> <a href="announcements_m.php"> Προσθήκη νέας ανακοίνωσης   </a>    </h2>  </div>       </div> '   ;
}      ?>    
<?php   $in=0 ;       ?>      
<?php foreach($announcements as $announcement){    ?>
<?php $in=$announcement['ID'];    ;  ?>
<div class="announcement_element">   
<div class="headers">  <h2><?php 
          echo "Ανακοίνωση  $in  "; 
          if ($_SESSION["user"] == 'tutor') { 
            echo '<a href="announcements_m.php?action=modify&ID=' . $announcement['ID'] . '"> [Επεξεργασία]</a>';
            echo '<a href="announcements_m.php?action=delete&ID=' . $announcement['ID'] . '"> [Διαγραφή] </a>';
             
          }
          ?>   </h2>
   
  
 
</div> 




  <div class="announcement_text"> <p> <b> Ημερομηνία</b>: <?php 

$mysqlDate = $announcement['DATE'];
$date = new DateTime($mysqlDate);
$formattedDate = $date->format('d/m/y');  
 echo htmlspecialchars($formattedDate )?></p> 
 <p><b> Θέμα  </b>: <?php echo htmlspecialchars($announcement['SUBJECT'])?></p>
 <p> <?php echo htmlspecialchars($announcement['TEXT']) ?> </p>

</div>  

     <?php } ?>
 



 <div style="padding-left: 40pc;"> <a href="#top">Αρχή</a></div>
  </div>

</body>
</html>