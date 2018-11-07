<?php
include 'dbconnect.php';
//Task List
$sqltask = "SELECT * FROM completed ORDER BY deadline ASC";
$select_task = $conn->prepare($sqltask);
$select_task->execute();
$fetchtask = $select_task->fetchAll();

?>
<!DOCTYPE html>
<!-- Mayo Corporation. -->

<html lang='en'>
<head>


<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

    <title>Completed Tasks</title>
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
              <li><a href="user_index.php">Overview</a></li>
              <li><a href="user_tasks.php">View Tasks</a></li>
              <li class="active"><a href="completed_tasks.php"><strong>Completed Tasks</strong></a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="suggestions.php">Comments/Suggestions</a></li>
              <li><a href="#">Surveys</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="#">Productivity Tracker</a></li>
              <li><a href="#">Other</a></li>
            </ul>
          
        </div><!--/span-->
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
		  <h1 class="page-header">
            Completed Tasks
          </h1>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
				  <th>Priority Level</th>
                  <th>Task</th>
                  <th>Deadline</th>
                  <th>Comment Status</th>
                </tr>
              </thead>
              <tbody>
				<?php foreach ($fetchtask as $task){ 
$deadline = new DateTime($task['deadline']);
$formatdeadline = date_format($deadline, 'd M Y, h:ia');
				  echo "<tr>";
					echo "<td>".$task['priority']."</td>";
					echo "<td>".$task['task']."</td>";
					echo "<td>".$formatdeadline."</td>";
					if ($task['commented'] == 0){
						
					echo "<td><a style='color:#EE7600;' href='task_comment.php'>Not Yet Commented</a></td>";
					}else if ($task['commented'] == 1){
						echo "<td style='color:#66CD00;'>Posted Comment</td>";
					}
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