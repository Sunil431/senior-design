
<?php  

$errors =array();
?>
<!DOCTYPE html>
<html>
<head>




<meta charset="UTF-8">

 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="forgotpasswordstudent.css">
<title>Forgot Password</title>
</head>
<body >



<h1>Password Recovery</h1>



<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form-div login">
            <form action="forget.php" method="POST">
                <h3  class="font-weight-bold"> Recover your  password</h3>
                <p>
Please enter your email address you used to sign up on this site
and we will assist you in recovering your password.
</p>
                
                <?php if(count($errors) > 0): ?>
                <div classs="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class ="form-group">
                    <input type="email" name ="email" placeholder="Enter your email" class="form-control form-control-lg" required>
                    
      </div>
      
      <div class="form-group">
      <button  type="submit" class="button" name="forgot-password" 
style="vertical-align:center;"><span>Submit</span></button>
</div>
<div>
<button class="button" type="button" onClick="parent.location='index.html'"
 style="vertical-align:center;"><span>Homepage</span></button>

           </div>
</form>
</div> 
</div>
</div>
           
      
      
 


</body>
</html>
