<?php
include 'dbconnect.php';
$id = 7;
//Product select
$sqlprod = "SELECT * FROM sentiment_table WHERE sentence_id=".$id."";
$select_prod = $conn->prepare($sqlprod);
$select_prod->execute();
$fetchprod = $select_prod->fetch(PDO::FETCH_ASSOC);

$corptitle = $fetchprod['title'];

//Corpus select
$sqlcorp = "SELECT * FROM corpus WHERE title='".$corptitle."'";
$select_corp = $conn->prepare($sqlcorp);
$select_corp->execute();
$fetchcorp = $select_corp->fetchAll();
?>
<!DOCTYPE html>
<!-- Mayo Corporation. -->

<html lang='en'>
<head>


<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

    <title>Keyword Graph</title>
    <link rel="stylesheet" type="text/css" HREF="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" HREF="bootstrap/css/style.css" />
	<link rel="stylesheet" type="text/css" HREF="bootstrap/css/styles.css" />
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#5c247b;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.php"><img src="MYOB2.png" alt="MYOB Logo" width="150px"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
          </form>
        </div>
      </div>
</nav>
	
<div class="container-fluid">
      
      <div class="row row-offcanvas row-offcanvas-left">
        
         <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation" style="background-color:#f5f5f5;">
           
            <ul class="nav nav-sidebar">
              <li><a href="index.php">Overview</a></li>
              <li><a href="set_task.php">Set New Task</a></li>
              <li><a href="view_tasks.php">View Tasks</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li class="active"><a href="sentiment.php"><strong>Sentiment Viewer</strong></a></li>
              <li><a href="#">Productivity Tracker</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="#">Other</a></li>
              <li><a href="#">Other</a></li>


            </ul>
          
        </div><!--/span-->
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
		  <h1 class="page-header">
            		<?php
		echo "Keyword: ".$fetchprod['title'];
		?>
          </h1>
<div align="center"><img src="graphing/MYOB.png" /></div>
<h2 class="sub-header">Relevant Latest Comments</h2>
<hr>
                    <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
				  <th>Keyword</th>
                  <th>Latest Comments</th>

                </tr>
              </thead>
              <tbody>
				<?php foreach ($fetchcorp as $corp){ 

				  echo "<tr>";
					echo "<td>".$corp['title']."</td>";
					echo "<td>".$corp['sentence']."</td>";
				  echo "</tr>";
			  }
			  ?>
              </tbody>
            </table>
          </div>
		  
		  
      </div><!--/row-->
	</div>
</div><!--/.container-->
	
</body>
	<footer>
		<div id="footer" align="center">
			<strong>
        		Copyright &copy; 2016 modularcake.
    		</strong>
		</div>

	</footer>
	
		<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="bootstrap/js/scripts.js"></script>
</html>