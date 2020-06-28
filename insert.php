<?php
  include( 'connection.php' );
   include( 'emailController.php' );
  session_start();
  include('session.php');
    
   
    
if (isset($_POST['submittok']))
    {

$name = $_POST['name'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);
$username = $_POST['username'];
$phone = $_POST['phone'];
$contact_preference = $_POST['contact_preference'];
$student_type = $_POST['student_type'];
$major = $_POST['major'];


  //Grabing a data from HTML form and storing it into PHP variables 
if (!empty($name) || !empty($password) || !empty($password2) || 
!empty($username) || !empty($phone) || !empty($contact_preference)||!empty($student_type) || !empty($major)) {
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
     $SELECT = "SELECT username From register Where username = ? Limit 1";
     $INSERT = "INSERT INTO `register`(`name`, `password`, `password2`, `username`, `phone`,
     `contact_preference`, `student_type`, `major`, `token`) VALUES ('$name', '$password', '$password2',
     '$username', '$phone', '$contact_preference', '$student_type', '$major','$token')";
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
      $stmt->bind_param("sssssssi", $name, $password, $password2, $username, $phone, 
      $contact_preference, $student_type, $major, $token);
      $stmt->execute();
  
   //     $to = "donotreply@usa.com"; // this is your Email address
   //  $from = $username; // this is the sender's Email address
   //  $first_name = $name;
   // // $last_name = $_POST['last_name'];
   //  $subject = "Succesfully registered";
   // // $subject2 = "Copy of your form submission";
   //  $message = $first_name . " "  . " wrote the following:" . "\n\n" . $_POST['message'];
   //  $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

   //  $headers = "From:" . $from;
   //  $headers2 = "From:" . $to;
   //  mail($to,$subject,$message,$headers);
   //  mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
   //  echo "Please check your email. Thank you ";
   //  // You can also use header('Location: thank_you.php'); to redirect to another page.
      

       welcomeemail($username);
 // $session->message("You have been registered to UTA Advising");
 //      redirect("registrationportal.html");
    
     // echo '<script language="javascript">';
     //  echo 'alert("You have been registered")';
     //  echo '</script>';
     // echo '<script type="text/javascript">window.location.href="index.html";</script>';
        header("Location:registrationportal.php?error=1");
     exit();
  
     }
     else {

         header("Location:registrationportal.php?errorr=1");
         
 //       echo '<script language="javascript">';
 //      echo 'alert("Email is already used")';
 //      echo '</script>';
 // echo '<script type="text/javascript">window.location.href="registrationportal.html";
 // // </script>';
 exit();
     }
     $stmt->close();
     $conn->close();
    }
} else {
      echo '<script language="javascript">';
      echo 'alert("All field are required")';
      echo '</script>';
 echo '<script type="text/javascript">window.location.href="registrationportal.html";</script>';
 die();

}
}


//close the mysql connection
mysqli_close($conn);

?>