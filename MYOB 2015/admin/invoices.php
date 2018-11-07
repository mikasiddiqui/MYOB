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
			$invoicedb = $conn->prepare("SELECT * FROM invoices ORDER BY id DESC");
			$invoicedb->execute();
			$invoices = $invoicedb->fetchAll(); 
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

    <title>MYOB Online - Invoices</title>

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
            <li class="active"><a href="#">Invoices <span class="sr-only">(current)</span></a></li>
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
          <h1 class="page-header">Invoices</h1>
			<?php if ($count_invoice > 0){ ?>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="new-invoice.php">
              <span class="glyphicon glyphicon-plus" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Add New Invoice</h4>

            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
			  <a href="#">
              <span class="glyphicon glyphicon-share-alt" style="font-size:50px" aria-hidden="true"></span>
			  </a>
              <h4>Create Return</h4>

            </div>
          </div>
	
          <h2 class="sub-header">All Invoices</h2>
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
			<?php
					foreach ($invoices as $row) {
						echo "<tr>";
						echo "<td>". sprintf("%08d", $row['invoice_num']) ."</td>";
						echo "<td>". $row['customer'] ."</td>";
						echo "<td>".date("d/m/Y", strtotime($row['date_issued'])) ."</td>";
						echo "<td>".date("d/m/Y", strtotime($row['date_due'])) ."</td>";
						echo "<td>$". $row['total_amount'] ."</td>";
						echo "<td>$". $row['amount_due'] ."</td>";
						if ($row['status'] == 1){
							$invoice_status = 'Paid';
						}else if($row['status'] == 2){
							$invoice_status = 'Receipt Sent';
						}else if($row['status'] == 3){
							$invoice_status = 'Not Paid';
						}
						echo "<td>". $invoice_status ."</td>";
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
