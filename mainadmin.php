<?php

$host ="localhost";
$user="root";
$dbpassword="";
$db="uta_advising";


$conn = mysqli_connect($host, $user, $dbpassword, $db);   //connect to database

    

if(isset($_POST['Login'])){
    

	$uname=$_POST['email'];
	$password=($_POST['password']);

    // create SQL Query
	$query ="SELECT * FROM  admin WHERE email='".$uname."' AND password = '".$password."' limit 1 ";

    // store the result
	$result=mysqli_query($conn, $query);

    //verify if result is returned
	if(mysqli_num_rows($result)==1){
            
            // start the session
            session_start();
            
            //store data in SESSION variables
            $_SESSION['loggedInUser'] = $uname;
           
           
            
			echo '<script language="javascript">';

      echo 'alert("Admin \r\n You have successfully logged In")';
      echo '</script>';
 	echo '<script type="text/javascript">window.location.href="adminhomepage.php?";</script>';
			



}

		else{


	echo '<script language="javascript">';
    echo 'alert("You have entered incorrect email or password")';
      echo '</script>';
 	echo '<script type="text/javascript">window.location.href="admin.html";</script>';

		
		exit();
	}
    
    // close the mysql connection
    mysqli_close($conn);

}



?>


