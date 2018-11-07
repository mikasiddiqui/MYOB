<?php
include 'dbconnect.php';
//Title List
$sqltitle = "SELECT * GROUP_CONCAT(title,sentiment,confidence) FROM sentiment_table
GROUP BY title LIMIT 3";
$select_title = $conn->prepare($sqltitle);
$select_title->execute();
$fetchtitle = $select_title->fetchAll();
?>
<!DOCTYPE html>
<!-- Mayo Corporation. -->

<html lang='en'>
<head>


<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

    <title>Cakebot Analyser</title>
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
              <li class="active"><a href="index.php"><strong>Overview</strong></a></li>
              <li><a href="set_task.php">Set New Task</a></li>
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
            Cakebot Analyser - Manager
          </h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <a href="set_task.php"><span class="glyphicon glyphicon-pencil" style="font-size:50px" aria-hidden="true"></span></a>
              <h4>Set Task</h4>

            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <a href="sentiment.php"><span class="glyphicon glyphicon-pencil" style="font-size:50px" aria-hidden="true"></span></a>
			<h4>Sentiment</h4>
            </div>
          </div>
          
          <hr>

          <h2 class="sub-header">Top 3 Relevant Keywords</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
				  <th>Keyword</th>
                  <th>Word Count</th>
                  <th>Sentiment</th>
                  <th>Pos to Neg ratio</th>
                </tr>
              </thead>
              <tbody>
				<?php foreach($conn->query('SELECT *,GROUP_CONCAT(TITLE) as titles, GROUP_CONCAT(sentiment) as sent  
FROM sentiment_table  
GROUP BY title ORDER BY COUNT(title) DESC LIMIT 3') as $row) { 
				  echo "<tr>";
				  $keyword_count = count(explode(",",$row['titles']));
				  $sent_array = (explode(",",$row['sent']));
				  $pos_s = 0;
				  $neg_s = 0;

					echo "<td>".$row['title']."</td>";
					
					echo "<td>".$keyword_count."</td>";
					if(count($sent_array)>1){
						foreach($sent_array as $sa){
							if($sa == 'pos'){
								$pos_s++;
							}else if($sa == 'neg'){
								$neg_s++;
							}
						}
						if($pos_s >= $neg_s){
							echo "<td style='color:#66CD00;'><strong>Positive</strong></td>";
						}else if($neg_s > $pos_s){
							echo "<td style='color:#FF0000;'><strong>Negative</strong></td>";
						}
					}else{
						if($row['sentiment'] == 'pos'){
							echo "<td style='color:#66CD00;'><strong>Positive</strong></td>";
						}else if($row['sentiment'] == 'neg'){
							echo "<td style='color:#FF0000;'><strong>Negative</strong></td>";
						}

					}
					
					if($keyword_count > 1){
						echo "<td>".$pos_s.":".$neg_s."</td>";
					}else{
						if($row['sentiment'] == 'pos'){
							echo "<td>1:0</td>";
						}else if($row['sentiment'] == 'neg'){
							echo "<td>0:1</td>";
						}

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