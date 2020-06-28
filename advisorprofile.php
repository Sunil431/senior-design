<?php

    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: adminportal.html");
    }



    include( 'connection.php' );   
    
   $user=$_SESSION['loggedInUser'];
   
   $query ="SELECT * FROM advisor WHERE username='$user'";
 
    $result = mysqli_query( $conn, $query );
    


?>


<!DOCTYPE html>

<html>

    <head>
    
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title> My Profile </title>
    
    
    
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <link rel="stylesheet" type="text/css" href="advisorprofile.css">
    </head>
    
    <body>
        <div class="container" >
       <h1> My Profile</h1>
        
        <?php
        
            if( mysqli_num_rows($result) > 0 ){
        
        // We have data
        // Output the data
        
        
        
        echo "<table class='table table-bordered'><tr><th>Name</th><th>Email</th><th>Phone Number</th>
        <th>Advising Room</th><th>Edit</th></tr>";
        
        while( $row = mysqli_fetch_assoc($result) ){
            
            echo"<tr>";
            
            
            echo "<td>". $row["name"] ."</td><td> ". $row["username"] ."</td><td> ".$row["phone"] 
            ."</td><td> ". $row["room"] ."</td> ";
            
            
            echo '<td><a href="editadvisor.php?id=' .$row['aid']. '"type="button" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-edit"></span>
            </a></td>';
            
            
            
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
        
        
    