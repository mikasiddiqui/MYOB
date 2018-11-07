<?php
include 'dbconnect.php';
//User List
$sqluser = "SELECT * FROM users ORDER BY name ASC";
$select_user = $conn->prepare($sqluser);
$select_user->execute();
$fetchuser = $select_user->fetchAll();

if (isset($_POST['submit'])) {
	
	$task = $_POST['task'];
	$name = $_POST['name'];
	$deadline = $_POST['deadline'];
	$status = 0;
	$percentage = 0;
	$priority = $_POST['priority'];
	
	$sql = "INSERT INTO tasks (task,name,deadline,status, percentage,priority)
					VALUES (:task, :name, :deadline, :status, :percentage, :priority)";
	$connection_prepare = $conn->prepare($sql);
	
	$connection_prepare->execute(array(':task'=>$task,':name'=>$name,':deadline'=>$deadline,':status'=>$status,':percentage'=>$percentage,':priority'=>$priority));
}

?>
<!DOCTYPE html>
<!-- Mayo Corporation. -->

<html lang='en'>
<head>


<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

    <title>Set Task</title>
    <link rel="stylesheet" type="text/css" HREF="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" HREF="bootstrap/css/style.css" />
	<link rel="stylesheet" type="text/css" HREF="bootstrap/css/styles.css" />
	
	<script type="text/javascript">
		$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
	</script>        
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
              <li class="active"><a href="set_task.php"><strong>Set New Task</strong></a></li>
              <li><a href="view_tasks.php">View Tasks</a></li>
            </ul>
            <ul class="nav nav-sidebar">
              <li><a href="sentiment.php">Sentiment Viewer</a></li>
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
            Set New Task
          </h1>

          <div class="table-responsive">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" >
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="col-md-1"><label>Task: </label></td>
                  <td class="col-md-10"><input type="text" class="form-control" name="task" id="task" placeholder="Enter new task" required></td>				  
                </tr>
				<tr>
                  <td class="col-md-1"><label>Who to Assign: </label></td>
                  <td class="col-md-10"><select class="form-control" name="name" required>
				  <option value="Choose Name" disabled selected hidden>Choose Name</option>
				  <?php foreach ($fetchuser as $u){ 
						echo "<option value='".$u['name']."'>".$u['name']."</option>";
				  }
				  ?>
					</select>
				  </td>
                </tr>
                <tr>
                  <td class="col-md-1"><label>Deadline: </label></td>
                  <td class="col-md-10"><input type="datetime-local" name="deadline" required></td>
                </tr>
                <tr>
                  <td class="col-md-1"><label>Priority Level: </label></td>
                  <td class="col-md-10"><input type="number" name="priority" min="1" max="5" required></td>
                </tr>
				<tr>
                  <td class="col-md-1"></td>
                  <td class="col-md-10"><input class="btn btn-primary" type="submit" name="submit" value="Submit"></td>
                </tr>
              </tbody>
            </table>
          </form>
			<script src="/uploads/js/checkmultiple.js"></script>
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