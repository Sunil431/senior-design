<?php

  include( 'connection.php' );
   include( 'emailController.php' );
    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: index.html");
    }

    

$name = $_POST['name'];
$password = md5($_POST['password']);
$username = $_POST['username'];
$phone = $_POST['phone'];
$room = $_POST['room'];


  //Grabing a data from HTML form and storing it into PHP variables 
if (!empty($name) || !empty($password) || 
!empty($username) || !empty($phone) || !empty($room)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "uta_advising";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
            $token = bin2hex(random_bytes(50));
     $SELECT = "SELECT username From advisor Where username = ? Limit 1";
     $INSERT = "INSERT INTO `advisor`(`name`, `password`, `username`, `phone`,
     `room`, `token`) VALUES ('$name', '$password', 
     '$username', '$phone', '$room', '$token')";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->bind_result($username);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
         
      
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
     // $stmt->bind_param("ssssss", $name, $password, $username, $phone, 
     // $room, $token);
      $stmt->execute();
  
      
      

        welcomeemail($username);
      
      echo '<script language="javascript">';
      echo 'alert("Advisor is registered successfully")';
      echo '</script>';
       echo '<script type="text/javascript">window.location.href="adminhomepage.php";</script>';
     
  
     }
     else {
         

      echo '<script language="javascript">';
      echo 'alert("Email is already used")';
      echo '</script>';
 echo '<script type="text/javascript">window.location.href="advisorregister.html";
 </script>';
 
     }
     $stmt->close();
     $conn->close();
    }
} else {
      echo '<script language="javascript">';
      echo 'alert("All field are required")';
      echo '</script>';
 echo '<script type="text/javascript">window.location.href="advisorregister.html";</script>';
// die();

}


//close the mysql connection
mysqli_close($conn);

?>