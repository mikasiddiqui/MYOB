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
		
		
		$inventorysql = $conn->prepare("SELECT * FROM track_inventory");
		$inventorysql->execute();
		$inventoryrow = $inventorysql->fetchAll(); 
		
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

    <title>MYOB Online - Track Inventory</title>

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
            <li class="active"><a href="#">Track Inventory <span class="sr-only">(current)</span></a></li>
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

          <h2 class="sub-header">Track Inventory</h2>
          <div class="table-responsive">
            <table class="table table-striped">
			  <thead>
                <tr>
                  <th>Item Number</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Quantity</th>
                </tr>
              </thead>
			  <tbody>
			<?php
				
				foreach ($inventoryrow as $row) {

					echo "<tr>";
					echo "<td>". $row['item_number'] ."</td>";
					echo "<td>". $row['name'] ."</td>";
					echo "<td>". $row['description'] ."</td>";
					echo "<td>". $row['price'] ."</td>";
					echo "<td>". $row['quantity'] ."</td>";
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
