

<?php
    $errors =array();
    session_start();
  include( 'connection.php' );
   include( 'emailController.php' );
  
  if (isset($_POST['forgot-password']))
    {
      
      
     
    $username =$_POST['email'];

    if(!filter_var($username, FILTER_VALIDATE_EMAIL))
    {
        
            echo '<script language="javascript">';
      echo 'alert("Email is required")';

  
            echo '</script>';
 echo '<script type="text/javascript">window.location.href="forgotpasswordstudent.php";
 </script>';
        
    }
     if (empty($username))
     {
          echo '<script language="javascript">';
      echo 'alert("Email address is invalid")';

  
            echo '</script>';
 echo '<script type="text/javascript">window.location.href="forgetpasswordstudent.php";
 </script>';
         
     }  
     
     
     if (count($errors) == 0)
        {
            
          
           
   
            
            $sql ="SELECT * FROM register WHERE username ='$username' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            $token = $user['token'];
            
            //verify if result is returned
	if(mysqli_num_rows($result)==0){
            
           
           
            
			echo '<script language="javascript">';

      echo 'alert("Error Occured!!! \nThere is no user record corresponding to this email.")';
      echo '</script>';
 	echo '<script type="text/javascript">window.location.href="forgotpasswordstudent.php";</script>';
			

			exit();

}

		else{
            
            sendPasswordResetLink($username, $token);
            
            
            header('location: password_message.php');
            //exit(0);
        }
  }
    }

?>