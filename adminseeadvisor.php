<?php

    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: adminportal.html");
    }



    include( 'connection.php' );   
    
   $user=$_SESSION['loggedInUser'];
   
   $query ="SELECT * FROM advisor WHERE 1";
 
    $result = mysqli_query( $conn, $query );
    


?>


<!DOCTYPE html>

<html>

    <head>
    
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title> UTA CSE Advisors </title>
    
    
    
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <!--<link rel="stylesheet" type="text/css" href="advisorprofile.css"> -->
    </head>
    
    <body>
        <div class="container" >
        
<style>
h1 {
margin:10px;
color:midnightblue;
text-align: center;

font-family: fantasy;
font-size: 3em;
box-shadow: 4px 4px 5px  #888888;
}
 </style>


       <h1> UTA CSE Advisor</h1>
        
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
           <div align="center">
    <button type="button" onClick="parent.location='adminhomepage.php'"name="add" id="add" class="btn btn-danger">Homepage</button>
   </div>
   <br />
       </body> 
     </html>   
        
        
        
    