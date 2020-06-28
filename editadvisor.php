<?php

    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: index.html");
    }
    
    include( 'connection.php' );
    
    //get ID sent by GET collection
    $advisorid = $_GET['id'];
    
    //query the database with advisor ID
    $query ="SELECT * FROM advisor WHERE aid ='$advisorid'";
    $result = mysqli_query( $conn, $query);
    
    

    //if result is returned
    if (mysqli_num_rows($result) >0){
        
        //we have database
        //set some variables
        while($row = mysqli_fetch_assoc($result)){
            
        $name                = $row['name'];
        $username            = $row['username'];
        $phone               = $row['phone'];
        $room                = $row['room'];
        //$password            = $row['password'];
   
        }
        
    } else {
        //no result returned
        
              echo '<script language="javascript">';
      echo 'alert("Nothing to see here")';
      echo '</script>';
 echo '<script type="text/javascript">window.location.href="registrationportal.html";</script>';
    }
    
    //if update button was submitted
    if( isset($_POST['update'])){
        
        $name                = $_POST['name'];
        $username            = $_POST['email'];
        $phone               = $_POST['phone'];
        $room                = $_POST['room'];
        //$password            = $_POST['password'];

        
        //new database query and result
        $query = "UPDATE advisor
                    SET name='$name',
                    username='$username',
                    phone='$phone',
                    room='$room'
                    WHERE aid ='$advisorid'";
                    
        $result = mysqli_query($conn, $query);
        
        if ($result){
            
     echo '<script language="javascript">';
      echo 'alert("Profile updated  successfully")';
      echo '</script>';
 	echo '<script type="text/javascript">window.location.href="advisorhomepage.php";</script>';
            
            //redirect to advisor homepage page with query string
           // header("Location: advisorhomepage.php");
        } else{
            
            echo "Error updating record: " .mysqli_error($conn);
        }
        
    }
  mysqli_close($conn);   
?>



<!DOCTYPE html>
<html>
<head>



<link rel="stylesheet" type="text/css" href="editadvisor.css">

<title>Edit profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initail-scale=1">

</head>
<body >



<h1>Edit Profile</h1>


 <div class="container">

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>?aid=<?php echo
$advisorid; ?>" method="POST" class="row">
  <table>
   <tr>
    <td><strong><font color="#f4511e">Advisor Name :</font></strong></td>
    <td><input type="text" name="name" title="Please enter your name" 
    placeholder="Enter your first and last name" value="<?php echo $name; ?>" required></td>
   </tr>
  <!--- <tr>
    <td><strong><font color="#f4511e">Password :</font></strong></td>
    <td><input value="<?php echo $password; ?>"type="password"  minlength="8" 
    title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" 
    type="password" placeholder=" At least 8 characters long, including UPPER/lowercase & a number" 
    required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.password2.pattern = RegExp.escape(this.value);"> </td>
   </tr>
   -->

   <tr>
    <td><strong><font color="#f4511e">Email :</font></strong></td>
    <td><input value="<?php echo $username; ?>" type="email" name="email" title="Please enter your email" 
    placeholder="Enter your email" required></td>
   </tr> 
   <tr>
    <td><strong><font color="#f4511e">Phone Number :</font></strong></td>
    <td>
     <input value="<?php echo $phone; ?>"type="phone" name="phone"  title="Please enter your phone number" 
     placeholder="Enter your phone number" required>
    </td>
   </tr>
   <tr>
    <td><strong><font color="#f4511e">Room :</font></strong></td>
    <td>
     <input value="<?php echo $room; ?>"type="phone" name="room"  title="Please enter your room number" 
     placeholder="Enter your room number" required>
    </td>
   </tr>

   <tr>
    <td><input name="update" type="submit" class="button" style="vertical-align:center;" value="Update"></td>
    

   </tr>
  </table>
 </form>


</div>


</body>

</html>