<?php

    session_start();
    
    
    //if user is not logged in
    if( !$_SESSION['loggedInUser']){
        
        //send them to the login page
        header("Location: index.html");
    }
    
    require('mainadmin.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Homepage</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="adminhomepage.css" />
</head>
<body>

<h1>Welcome  <?php echo $_SESSION['loggedInUser'];?></h1>

	<div class="topnav" id="myTopnav">
  <a href="advisorhomepage.php" class="active">Menu</a>
  <a href="#advisorprofile.php">Profile</a>
  <a href="advisorregister.html">Advisor Registration</a>
  <a href="adminseeadvisor.php">Available Advisors</a>
  <a href="#Manage Students on Queue">Manage Queue</a>
   <a href="managedocuments.php">Manage Academic Documents</a>
  <!--<a href="#Contact info">Contact info</a> -->
  <a href="managemanual.php">Manage Manual documents</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

</div>

<script type="text/javascript" src="adminhomepage.js"> </script>
</body>
</html>