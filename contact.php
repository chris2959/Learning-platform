
<?php require('session.php')     ;
 require('db.php');

 if(isset($_POST['email'])&&isset($_POST['subject'])&&($_POST['text']))     {
    $headers= 'From '. $_POST['email'];
    $to="tutor@csd.auth.test.gr"; 
    $subject= $_POST['subject'];
    $te=($_POST['text']);
    if(mail($to,$subject,$te,$headers))
     echo'email sent';
    else echo 'something went wrong';


    

 }
 

 ?>



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

    .col{
        float: left;
  width: 75%;
  margin-top: 6px;
}


.contact_details_element{  border-top: solid;

 
 


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

  <!-- Title in the upper center -->
  <div class="header">
    <h1>Επικοινωνία</h1>
  </div>

  <!-- Content wrapper that holds both sidebar and content -->
  <div class="content-wrapper">
    
    <?php include("side.php"); ?>

    <!-- Main content -->
    <div class="main-content">
      <div class="contact_details_element">   <p> Η συγκεκριμένη ιστοσελίδα   περιέχει δύο δυνατότητες για την αποστολή e-mail στον καθηγητή:</p> <ul>

      <li>  Μέσω web φόρμας</li>
      <li>  Με χρήση e-mail διεύθυνσης</li>

      </ul> </div>  
      <div class="contact_details_element"> 

        <div class="headers">   <h2>Αποστολή e-mail μέσω web φόρμας</h2>          
      




        </div>
        <div >  <form action="contact.php" method="POST" >
            <label for="email">Αποστολέας:</label> <br> <br>
            <input type="email"    name="email" id="email"> <br> <br>
        <label for="subject"> Θέμα   </label> <br> <br>
        <input type="text" name="subject" id="subject"><br> <br>
        <label for="mail_text">Κείμενο:</label> <br> <br>
          <textarea  style="height: 100px ; width: 300px ;" name="text" id="text"> </textarea> <br> <br>
          <input style="margin : 5px" type="submit" name="submit" value="submit"  >
           
            
          </form>  </div>
         
    </div>

    <div class="contact_details_element"> <div class="headers">   <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>        
        <div> Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου  <a href="mailto:"  tutor@csd.auth.test.gr > tutor@csd.auth.test.gr </a> </div>  
      




    </div>     </div>

  </div>

</body>
</html>