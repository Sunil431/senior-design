<?php

    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: adminportal.html");
    }



    include( 'connection.php' );   
    
    
    $query = "SELECT * FROM  advisor";
    $result = mysqli_query( $conn, $query );
    


?>


<!DOCTYPE html>

<html>

    <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title> Advisor Information </title>
    
    
    
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="advisorcontactinformation.css">
    </head>
    
    <body>
        
       <h1>Advisor Information</h1>
       <div class="container" style="margin-top: 100px;">
        
        <?php
        
            if( mysqli_num_rows($result) > 0 ){
        
        // We have data
        // Output the data
        
        
        
        echo "<table class='table table-bordered'><tr><th>Name</th><th>Email</th><th>Phone Number</th>
        <th>Advising Room</th></tr>";
        
        while( $row = mysqli_fetch_assoc($result) ){
            
            echo"<tr>";
            
            
            echo "<td>". $row["name"] ."</td><td> ". $row["username"] ."</td><td> ".$row["phone"] 
            ."</td><td> ". $row["room"] ."</td> ";
            
            

            
            echo"</tr>";
            

            
        }
        
        echo "</table>";
        
    } else {
        
        echo "Whoops! No results.";
    }
    
    //Close connection
    
    mysqli_close($conn);
        
        ?>
        
        </div>
                </div>
     
   <div align="center">
    <button type="button" onClick="parent.location='studenthomepage.php'"name="add" id="add" class="btn btn-danger">Homepage</button>
   </div>
   <br />
   </body>
   </html>
        
        
    