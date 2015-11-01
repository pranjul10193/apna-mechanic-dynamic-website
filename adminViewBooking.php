<?php
	session_start();
	if ((!isset($_SESSION['index']['user_level'])) && ($_SESSION['índex']['user_level']!=1)) {
		header("Location: index.php");
		exit();
	}
?>
<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<title>Admin Page</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="apple-touch-icon" href="apple-touch-icon.png">
		<!--Place favicon.ico in the root directory-->

		<link rel="stylesheet" type="text/css" href="css/__main.css">
		<script src="js/vendor/modernizer-2.8.3.min.js"></script>
		<!--Modernizer.js-->
		<script src="js/vendor/modernizer-2.6.2.min.js"></script>
		<?php include 'script.php'; ?>
		<!--Respond.js for IE 8 or less only -->
		<!--[if(lt IE 9) & (!IEMobile)]>
		<script src="js/vendor/respond.min.js"></script>
		<![endif]-->
	</head>
	<body data-spy="scroll" data-target="#nb" data-offset="90">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <?php include("nav.php");?>
        <main role="main">
            <div class="container-fluid admin-page" id="admin">
                <div role="page-info" class="admin-head">
                    <h1>Welcome Administrator</h1>
                    <hr>
                </div>
                <div class="admin-menu col-md-2">
	                <ul class="nav nav-pills nav-stacked">
	         			<li class="text-center">
	                		<a href="adminViewTable.php">View Customers <span class="icon fa fa-arrow-circle-o-right"></span></a>
	                	</li>
	                	<li class="text-center active">
	                		<a href="adminViewBooking.php">View Bookings <span class="icon fa fa-arrow-circle-o-right"></span></a>
	                	</li>
	                	<li class="text-center">
	                		<a href="#">Update Bulletin <span class="icon fa fa-arrow-circle-o-right"></span></a>
	                	</li>
	                </ul>
	            </div>
	            <div class="customer col-md-10">

	                <?php
	                	require 'mysqli_connect.php';
	                	$query="SELECT fname,email,mobile,vehicle,description,registered,DATE_FORMAT(regdate,'%M %d,%Y') AS reg,book_id FROM bookings ORDER BY reg ASC";
	                	$result=@mysqli_query($db,$query);
	                	if ($result) {
	                		echo 
	                			'<table class="table table-bordered table-striped table-hover">
		                			<thead>
		                				<tr>
		                					<th>Name</th>
		                					<th>Mobile</th>
		                					<th>Email</th>
		                					<th>Vehicle</th>
		                					<th>Description</th>
		                					<th>Registered User</th>
		                					<th>Booking Date</th>
		                				</tr>
		                			</thead>
		                			<tbody>';
		                	$count="";		
		                	while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		                		echo 
		                			'<tr>
		                				<td>'.$row['fname'].'</td>
		                				<td>'.$row['mobile'].'</td>
		                				<td>'.$row['email'].'</td>
		                				<td>'.$row['vehicle'].'</td>
		                				<td>'.$row['description'].'</td>
		                				<td>'.$row['registered'].'</td>
		                				<td>'.$row['reg'].'</td>
		                			</tr>';
		                		$count++;
		                	}
		                	@mysqli_free_result($result);
		                	echo
		                		'</tbody>
		                	</table>';		
		                	$msg="Total Bookings are ".$count;
		                }
		                else{
		                	$msg="Sorry we could not connect due to system error. Try again later.";
		                	$errordb=mysqli_error($db);
		                }
		                @mysqli_close($db);	
	                ?>
	                <div class="feedback text-center">
	                    <h3>
	                    	<?php 
	                            echo @$msg; 
	                            echo @$errordb;
	                        ?>
	                    </h3>
	                </div>
	            </div>
	        </div>
	    </main>
	</body>
</html>