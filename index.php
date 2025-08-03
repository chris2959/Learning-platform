<?php require('session.php')  ?>
<!DOCTYPE html>
<html lang="en">
<head>  <title> Αρχική Σελίδα </title>
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

  <!-- Title in the upper center -->
  <div class="header">
    <h1>Αρχική Σελίδα</h1>
  </div>

  <!-- Content wrapper that holds both sidebar and content -->
  <div class="content-wrapper">
    
    <!-- Sidebar -->
    <?php include('side.php'); ?>

    <!-- Main content -->
    <div class="main-content">
    <div> 
      <p> 
      <?php if($_SESSION['user']=='tutor') echo "<a href='users.php'>Χρήστες </a>" ;  ?>  
      <br>
      <br>
      Καλωσήρθατε! Αυτή η ιστοσελίδα αποτελεί μια εργασία για εκμάθηση δημιουργίας εκπαιδευτικού περιβάλλοντος για ένα μάθημα.</p>
    <p> Στην πλαϊνή μπάρα υπάρχουν κουμπιά που οδηγούν στις σελίδες: Ανακοινώσεις :  περιέχει ανακοινώσεις σχετικές με το μάθημα ,
       Επικοινωνία: δίνει τη δυνατότητα επικοινωνίας με τον καθηγητή του μαθήματος  , Έγγραφα Μαθήματος: έγγραφα μαθήματος που μπορούν να κατεβάασουν
    οι μαθητές, Εργασίες: χώρος όπου οι μαθητές μπορούν να κατεβάσουν τις εκφωνήσεις εργασιών.

      </p>
     
    </div>
       <div> <img src="https://www.csd.auth.gr/wp-content/themes/csd/images/logo.png" width="700" height="200"></div>  
    </div>

  </div>

</body>
</html>