<?php
include 'dbconnect.php';

if (isset($_POST['submit'])) {
	
	if(isset($_POST['check'])){
	$checkbox = $_POST['check'];
	
	for($i=0; $i<sizeof($checkbox);$i++){
	$sql = "INSERT INTO progress (value)
					VALUES (:value)";
	$connection_prepare = $conn->prepare($sql);
	
	$connection_prepare->execute(array(':value'=>$checkbox[$i]));
}}
}

?>
<!DOCTYPE html>
<!-- Mayo Corporation. -->

<html lang='en'>
<head>


<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

    <title>Checklist</title>
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
              <li class="active"><a href="user_tasks.php"><strong>View Tasks</strong></a></li>
              <li><a href="completed_tasks.php">Completed Tasks</a></li>
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
            Checklist
          </h1>

          <div class="table-responsive">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" >
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="col-md-2"><label>Compile all research: </label></td>
                  <td class="col-md-10"><input type="checkbox" name="check[]" value="1" /></td>				  
                </tr>
                <tr>
                  <td class="col-md-2"><label>Complete first draft: </label></td>
                  <td class="col-md-10"><input type="checkbox" name="check[]" value="2" /></td>				  
                </tr>
                <tr>
                  <td class="col-md-2"><label>Complete second draft: </label></td>
                  <td class="col-md-10"><input type="checkbox" name="check[]" value="3" /></td>				  
                </tr>
                <tr>
                  <td class="col-md-2"><label>Complete third draft: </label></td>
                  <td class="col-md-10"><input type="checkbox" name="check[]" value="4" /></td>				  
                </tr>
                <tr>
                  <td class="col-md-2"><label>Complete final paper: </label></td>
                  <td class="col-md-10"><input type="checkbox" name="check[]" value="5" /></td>				  
                </tr>
				<tr>
                  <td class="col-md-2"></td>
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