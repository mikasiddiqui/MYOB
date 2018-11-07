<?php
	include '../dbconnect.php';
	session_start();
	if(!isset($_SESSION['login'])){
		header('location:../');
	}else{
		$email = $_SESSION['login'];
		$sth = $conn->prepare("SELECT * FROM users WHERE email='$email'");
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		
		$first_name = $result['first_name'];
		$last_name = $result['last_name'];
		
		
		$users = $conn->prepare("SELECT * FROM users");
		$users->execute();
		$userrow = $users->fetchAll(); 
		
		if(isset($_POST['checkbox'])){
			
			$allowpls = $_POST['checkbox'];
			
			$ifexistsql1 = $conn->prepare("SELECT username FROM invoice_users WHERE username = '$allowpls'");
			$ifexistsql1->execute();
			$checker1 = $ifexistsql1->fetch(PDO::FETCH_ASSOC);
			
			$ifexistsql2 = $conn->prepare("SELECT username FROM profit_users WHERE username = '$allowpls'");
			$ifexistsql2->execute();
			$checker2 = $ifexistsql2->fetch(PDO::FETCH_ASSOC);
			
			$checkrow1 = $checker1['username'];
			$checkrow2 = $checker2['username'];
			
			if ($allowpls !== $checkrow1){
			$permissionsql = $conn->prepare("INSERT INTO invoice_users (username) VALUES (:allowpls)");
			$permissionsql->execute(array(':allowpls'=>$allowpls));
			}
			if ($allowpls !== $checkrow2){
			$permissionprofit = $conn->prepare("INSERT INTO profit_users (username) VALUES (:allowpls)");
			$permissionprofit->execute(array(':allowpls'=>$allowpls));
			}
			
			header('location:index.php');
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

    <title>Rent The Trend - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="../admin/"><img src="MYOB.png" alt="MYOB Logo" width="150px" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="invoices.php">Inventory</a></li>
            <li><a href="inventory.php">Track Rentals</a></li>
            <li><a href="profit.php">Create New Listing</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Members</a></li>
            <li><a href="">MORE STUFF</a></li>
            <li><a href="">MORE STUFF</a></li>
            <li><a href="">MORE STUFF</a></li>
            <li><a href="">MORE STUFF</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Welcome <?php echo $first_name; ?>!</h1>
          <div class="row placeholders">

            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="new-invoice.php">
              <span class="glyphicon glyphicon-plus" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Create New Listing</h4>

            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="inventory.php">
              <span class="glyphicon glyphicon-barcode" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Inventory</h4>
			  

            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="profit.php">
              <span class="glyphicon glyphicon-usd" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Track Rentals</h4>
	

            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="#">
              <span class="glyphicon glyphicon-user" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Members</h4>

            </div>
          </div>

          <h2 class="sub-header">Member Permissions</h2>
          <div class="table-responsive">
            <table class="table table-striped">
			  <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Permissions</th>
                  <th>Allow</th>
                </tr>
              </thead>
			  <tbody>
			<?php
				
				foreach ($userrow as $row) {
					echo "<form method=\"post\">";
					echo "<div class=\"form-group\">";
					
					echo "<tr>";
					echo "<td>". $row['first_name'] ."</td>";
					echo "<td>". $row['last_name'] ."</td>";
					echo "<td>". $row['email'] ."</td>";
					echo "<td>";

					echo "<div style=\"padding-left:30px;\"class=\"checkbox\"><label><input type=\"checkbox\" name=\"checkbox\" value=\"".$row['username']."\"></label></div>";
	
					echo "</td>";			
					echo "<td>";
					echo "<button type=\"submit\" class=\"btn btn-default\">Allow</button>";
					echo "</div>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";

				}
			?>
            
              </tbody>
           
            </table>
          </div>
		  
        </div>
      </div>
    </div>
	
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
