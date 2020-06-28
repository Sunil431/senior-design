<?php

    session_start();
    
    //Did the user's browser send a cookie for the session?
    if( isset( $_COOKIE[ session_name() ] ) ) {
        
        //Empty the cookie
        setcookie( session_name(), '', time()-86400, '/' );
         
    }
    
    
    //clear all session variables
    session_unset();
    
    
    
    //Destroying all sessions
     session_destroy();
   
    ?>
    <?php
      
	echo '<script language="javascript">';
    echo 'alert("You have successfully logged out")';
    echo '</script>';
 	echo '<script type="text/javascript">window.location.href="index.html?";</script>';
    exit();
      
       
        
        
    
?>