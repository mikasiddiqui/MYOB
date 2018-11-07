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
		
		
		$counter = $conn->prepare("SELECT * FROM invoice_users WHERE username = '$username'");
		$counter->execute();
		$count_invoice = $counter->rowCount();
		
		if ($count_invoice > 0){
			if(isset($_POST["submit"])){

				$customer = $_POST["customer"];
				$date_issued = $_POST["date_issued"];
				$date_due = $_POST["date_due"];
				$total_amount = $_POST["total_amount"];
				$amount_due = $_POST["amount_due"];
				$status = $_POST["status"];
				
				if(!empty($_POST["invoice_number"])){
					$invoice_num = $_POST["invoice_number"];
					
				}else{
					$thing = $conn->prepare("SELECT * FROM invoices ORDER BY id DESC LIMIT 1");
					$thing->execute();
					$id_invoice = $thing->fetch(PDO::FETCH_ASSOC);
					
					$invoice_num = $id_invoice['id'] + 1;
				}
				
				$sql = "INSERT INTO invoices (invoice_num, customer, date_issued, date_due, total_amount, amount_due, status) 
						VALUES (:invoice_num, :customer, :date_issued, :date_due, :total_amount, :amount_due, :status)";
				$q = $conn->prepare($sql);
				$q->execute(array(':invoice_num'=>$invoice_num,':customer'=>$customer,':date_issued'=>$date_issued,
							':date_due'=>$date_due,':total_amount'=>$total_amount,':amount_due'=>$amount_due,
							':status'=>$status,));
				
				
				header('location:invoices.php');
			}
			
		}else{
			header('location:../admin/');
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

    <title>MYOB Online - Create Invoice</title>

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
            <li class="active"><a href="invoices.php">Invoices <span class="sr-only">(current)</span></a></li>
            <li><a href="inventory.php">Track Inventory</a></li>
            <li><a href="profit.php">Profit and Loss</a></li>
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
          <h1 class="page-header">Add New Invoice</h1>

          <div class="table-responsive">
            <table class="table table-striped">
			  <thead>
                <tr>
                  <th>Invoice Number</th>
                  <th>Customer</th>
                  <th>Date Issued</th>
                  <th>Date Due</th>
                  <th>Total Amount</th>
				  <th>Amount Due</th>
				  <th>Status</th>
                </tr>
              </thead>
			  <tbody>

				<tr>
				<form role="form" method="post">
					<td>
						<div class="form-group" style="padding-top:10px;">
			
							<input type="text" class="form-control" name="invoice_number" id="invoice_number" placeholder="Optional">
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" name="customer" id="customer" class="form-control" placeholder="Example Enterprises" required>
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" class="form-control" name="date_issued" id="date_issued" placeholder="yyyy-mm-dd" required>
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" class="form-control" name="date_due" id="date_due" placeholder="yyyy-mm-dd" required>
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="8888.88" required>
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" class="form-control" name="amount_due" id="amount_due" placeholder="8888.88" required>
						</div>
					</td>
					
					<td>
						<div class="form-group" style="padding-top:10px;">
							<input type="text" class="form-control" name="status" id="status" required>
						</div>
					</td>
				
				</tr>
              </tbody>
           
            </table>
			<button type="submit" name="submit" class="btn btn-primary">Add New Invoice</button>
			</form>
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
