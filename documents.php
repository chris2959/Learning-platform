
<?php require('session.php') ; ?>
<?php include('db.php') ; 
$sqlq='SELECT * FROM documents';
$res=mysqli_query($connection,$sqlq);
$documents=mysqli_fetch_all($res,MYSQLI_ASSOC);


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
.documents_element{  border-top: solid;

 
 


}

  .documents_text{
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
    <h1>Έγγραφα Μαθήματος</h1>
  </div>

  <!-- Content wrapper that holds both sidebar and content -->
  <div class="content-wrapper">
    
  <?php include('side.php') ?>

    <!-- Main content -->
    <div class="main-content">

    <?php if ($_SESSION["user"] == 'tutor'){
  echo '<div class=document_element">   
  <div class="headers">  <h2> <a href="documents_m.php"> Προσθήκη νέου εγγράφου   </a>    </h2>  </div>       </div> '   ;
}        ?>
      <?php foreach($documents as $document ) {     ?>
        
        



        
     <div class="documents_element">   
    <div class="headers">  <h2> <?php echo htmlspecialchars($document['TITLE']);  echo ' '; echo(urlencode($document['ID'])  );   
   if ($_SESSION["user"] == 'tutor') { 
    echo '<a href="documents_m.php?action=delete&ID=' . urlencode($document['ID']) . '&directory=' . urlencode($document['DIRECTORY']) . '"> [Διαγραφή]</a>';
}

     ?>
</h2>
       
      
     
    </div>
      <div class="documents_text"> 
       <p>  <?php echo htmlspecialchars($document['TITLE']);  ?> </p>
         <p> <a href=" <?php echo htmlspecialchars($document['DIRECTORY']) ?>" Download>  Download </a></p> </div> </div>
  <?php }    ?> 
     
 <div style="padding-left: 40pc;"> <a href="#top">Αρχή</a></div>
  </div>

</body>
</html>