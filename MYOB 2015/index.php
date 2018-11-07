<?php
	session_start();
	
	include 'dbconnect.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$email = addslashes($_POST['email']);
		$password = md5(addslashes($_POST['password']));
	
		$sth = $conn->prepare("SELECT id FROM users WHERE email='$email' and password='$password'");
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$count = $sth->rowCount(); 
		
		if($count == 1){
			$_SESSION['login'] = $email;
			header("location:admin/");
		}
	}

	
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Rent The Trend</title>

    <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">


  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
		<div align="center"><a href="index.php"><img src="MYOB.png" alt="MYOB Logo" width="150px" /></a></div>
		<p>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>
