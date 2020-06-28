<?php

    session_start();
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: index.html");
    }
    
    include( 'connection.php' );
    
    //get ID sent by GET collection
    $studentid = $_GET['id'];
    
    //query the database with student ID
    $query ="SELECT * FROM register WHERE id ='$studentid'";
    $result = mysqli_query( $conn, $query);
    
    //if result is returned
    if (mysqli_num_rows($result) >0){
        
        //we have database
        //set some variables
        while($row = mysqli_fetch_assoc($result)){
            
        $name                = $row['name'];
        $username            = $row['username'];
        $phone               = $row['phone'];
        $contact_preference  = $row['contact_preference'];
        $student_type        = $row['student_type'];
        $major               = $row['major'];
        $password            = md5($row['password']);
        $password2           = md5($row['password2']);
            
            
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
        $username            = $_POST['username'];
        $phone               = $_POST['phone'];
        $contact_preference  = $_POST['contact_preference'];
        $student_type        = $_POST['student_type'];
        $major               = $_POST['major'];
        $password            = md5($_POST['password']);
        $password2           = md5($_POST['password2']);
        
        
        //new database query and result
        $query = "UPDATE register
                    SET name='$name',
                    username='$username',
                    phone='$phone',
                    contact_preference='$contact_preference',
                    student_type='$student_type',
                    major='$major',
                    password='$password',
                    password2='$password2'
                    WHERE id ='$studentid'";
                    
        $result = mysqli_query($conn, $query);
        
        if ($result){
            
            
            //redirect to student profile page with query string
            header("Location: studentprofile.php?alert=updatesuccess");
        } else{
            
            echo "Error updating record: " .mysqli_error($conn);
        }
        
    }
  mysqli_close($conn);  
?>



<!DOCTYPE html>
<html>
<head>



<link rel="stylesheet" type="text/css" href="editstudent.css">

<title>Edit profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initail-scale=1">

</head>
<body >



<h1>Edit Profile</h1>


 <div class="container">

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>?id=<?php echo
$studentid; ?>" method="POST" class="row">
  <table>
   <tr>
    <td><strong><font color="#f4511e">Student Name :</font></strong></td>
    <td><input type="text" name="name" title="Please enter your name" 
    placeholder="Enter your first and last name" value="<?php echo $name; ?>" required></td>
   </tr>
   <tr>
    <td><strong><font color="#f4511e">Password :</font></strong></td>
    <td><input value="<?php echo $password; ?>"type="password"  minlength="8" 
    title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" 
    type="password" placeholder=" At least 8 characters long, including UPPER/lowercase & a number" 
    required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.password2.pattern = RegExp.escape(this.value);"> </td>
   </tr>
   
<tr>
    <td><strong><font color="#f4511e">Confirm Password :</font></strong></td>
    <td><input value="<?php echo $password2; ?>"type="password" title="Please enter the same Password as above"
    type="password" placeholder="Enter the same Password as above" 
    required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password2" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"> </td>
   </tr>





   <tr>
    <td><strong><font color="#f4511e">Email :</font></strong></td>
    <td><input value="<?php echo $username; ?>" type="email" name="username" title="Please enter your email" 
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
    <td><strong><font color="#f4511e">Contact Preference :</font></strong></td>
    <td>
     <input  type="radio" name="contact_preference" value="email" 
     required><strong><font 
     color="#f4511e">Email</font></strong>
     <input  type="radio" name="contact_preference" value="phone" 
     required><strong><font 
     color="#f4511e">Phone</font></strong>
    </td>
   </tr>
      <tr>
    <td><strong><font color="#f4511e">Student Type :</font></strong></td>
    <td>
     <input type="radio" name="student_type" value="Currently_Enrolled_Student" 
     required><strong><font color="#f4511e">Currently_Enrolled_Student</font></strong>

     <input type="radio" name="student_type" value="Future_UTA_Student" 
     required><strong><font color="#f4511e">Future_UTA_student</font></strong>

     <input  type="radio" name="student_type" value="Newly_Accepted_UTA_Student" 
     required><strong><font color="#f4511e">Newly_accepted_UTA_student</font></strong>

    </td>
   </tr>
      <tr>
    <td><strong><font color="#f4511e">Major :</font></strong></td>
    <td>
     <input   type="radio" name="major" value="Software_Engineering"
     required><strong><font color="#f4511e">Software_Engineering</font></strong>

     <input  type="radio" name="major" value="Computer_Engineering" 
     required><strong><font color="#f4511e">Computer_Engineering</font></strong>

     <input  type="radio" name="major" value="Computer_Science" 
     required><strong><font color="#f4511e">Computer_Science</font></strong>

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