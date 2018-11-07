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
		
		$username = $result['username'];

		$counter = $conn->prepare("SELECT * FROM profit_users WHERE username = '$username'");
		$counter->execute();
		$count_profit = $counter->rowCount();
		
		if ($count_profit > 0){
		
			if(isset($_POST["submit"])){
				
				$start_date = $_POST["start_date"];
				$end_date = $_POST["end_date"];
				
				$incomesql = $conn->prepare("SELECT name, SUM(value) AS total_value FROM income WHERE (date BETWEEN '$start_date' AND '$end_date') GROUP BY name");
				$totalincome = $conn->prepare("SELECT SUM(value) AS totalval FROM income WHERE (date BETWEEN '$start_date' AND '$end_date')");
				$expensesql = $conn->prepare("SELECT name, SUM(value) AS total_value FROM less_expenses WHERE (date BETWEEN '$start_date' AND '$end_date') GROUP BY name");
			}else{
				
				$incomesql = $conn->prepare("SELECT name, SUM(value) AS total_value FROM income GROUP BY name");
				$totalincome = $conn->prepare("SELECT SUM(value) AS totalval FROM income");
				$expensesql = $conn->prepare("SELECT name, SUM(value) AS total_value FROM less_expenses GROUP BY name");
				
			}
			

			$incomesql->execute();
			$incomerow = $incomesql->fetchAll(); 
		
			$totalincome->execute();
			$totalincomerow = $totalincome->fetch(PDO::FETCH_ASSOC);
			
			$expensesql->execute();
			$expenserow = $expensesql->fetchAll(); 
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

    <title>MYOB Online - Profit and Loss</title>

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
            <li><a href="../admin/">Overview</a></li>
            <li><a href="invoices.php">Invoices</a></li>
            <li><a href="inventory.php">Track Inventory</a></li>
            <li class="active"><a href="profit.php">Profit and Loss <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Contacts</a></li>
            <li><a href="">Chart of Accounts</a></li>
            <li><a href="">Bank Accounts</a></li>
            <li><a href="">Manual Journals</a></li>
            <li><a href="">More Business Stuff</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Profit and Loss</h1>
			<?php if ($count_profit > 0){ ?>
			
			<div class="table-responsive">
            <table class="table table-striped">
			  <thead>
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                </tr>
              </thead>
			  <tbody>

				<tr>
				<form role="form" method="post">
					<td>
						<div class="form-group" style="padding-top:10px;">
			
							<input type="text" class="form-control" name="start_date" id="start_date" placeholder="yyyy-mm-dd">
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" name="end_date" id="end_date" class="form-control" placeholder="yyyy-mm-dd" required>
						</div>
					</td>
				
				</tr>
              </tbody>
           
            </table>
			<button type="submit" name="submit" class="btn btn-primary">Update</button>
			</form>
          </div>
			
			
          <div class="table-responsive">
            <table class="table table-striped">
			  <thead>
                <tr>
                  <th>Income</th>


                </tr>
              </thead>
			  <tbody>
			<?php
				if ($count_profit > 0){
				foreach ($incomerow as $row) {
					echo "<form method=\"post\">";
					echo "<div class=\"form-group\">";
					
					echo "<tr>";
					echo "<td>". $row['name'] ."</td>";
					echo "<td>$". number_format($row['total_value'], 2) ."</td>";

					echo "</tr>";

				}
				
				echo "<tr>";
				echo "<td><strong>Total</strong></td>";
				echo "<td><strong>$".number_format($totalincomerow['totalval'],2)."</strong></td>";
				echo "</tr>";
				}
			}
			?>
            
              </tbody>
           
            </table>
			<?php if ($count_profit > 0){ ?>
			<table class="table table-striped">
				<thead>
					<tr>
					<th>Less Expenses</th>
					</tr>
                </thead>
				<tbody>
				<?php
				
				foreach ($expenserow as $erow) {
					echo "<form method=\"post\">";
					echo "<div class=\"form-group\">";
					
					echo "<tr>";
					echo "<td>". $erow['name'] ."</td>";
					echo "<td>$". number_format($erow['total_value'], 2) ."</td>";

					echo "</tr>";

				}
				}else{
					echo "<h3 align=\"center\" style=\"color:#C00000\"><strong>Sorry, you do not have permission to access this page.<strong></h1>";
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
