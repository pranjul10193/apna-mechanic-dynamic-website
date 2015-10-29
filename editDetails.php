<?php
	session_start();
	if ((@$_SESSION['log']=="no") || (!isset($_SESSION['log']))) {
		header("Location: index.php");
		exit();
	}
?>
<!doctype html>
<html class="no-js" lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<title>Edit Your Details</title>
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
		<style type="text/css">
		.errorspan{
			color: red;
		}
		.errorclass{
			background-color: #cccccc;
		}
		</style>
	</head>
	<body data-spy="scroll" data-target="#nb" data-offset="90">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <?php include("nav.php");?>
        <?php
        	require 'mysqli_connect.php';
        	if ($_SERVER['REQUEST_METHOD']!="POST") {
        	
        	
        		$email=$_SESSION['index']['email'];
            	$mobile=$_SESSION['index']['mobile'];
            	$query="SELECT fname,lname,mobile,email FROM customer WHERE (email='$email' AND mobile='$mobile')";
            	$result=@mysqli_query($db,$query);
            	if (@mysqli_num_rows($result)==1) {
            		$_SESSION['edit']=@mysqli_fetch_array($result,MYSQLI_ASSOC);
            	}
            	else{
            		$msg="Sorry !";
            		$errordb="We are unable to display this page right now due to system error.
            		Please login again or try sometime later.";
            	}
        	}
        	else{
        		if (isset($_SESSION['edit'])) {
        			unset($_SESSION['edit']);
        		}
        		$input=array("fname","lname","mobile","email","password1","password2");
        		$error=array();
        		$_SESSION['edit']=array();

        		foreach ($input as $value) {
        			$_SESSION['edit'][$value]=$_POST[$value];
        		}
        		$_SESSION['edit']['user-phrase']=sha1($_POST['verify']);

        		if ($_SESSION['edit']['fname']=="") {
            		$error['fnameErr']="First Name required";
            	}
            	if ($_SESSION['edit']['lname']=="") {
            		$error['lnameErr']="Last Name required";
            	}
            	if ($_SESSION['edit']['email']=="") {
            		$error['emailErr']="Email required";
            	}
            	if ($_SESSION['edit']['mobile']=="") {
            		$error['mobileErr']="Mobile Number is required";
            	}
            	if ($_SESSION['edit']['password1']=="") {
                	$error['password1Err']="Password is required";
            	}
            	if ($_SESSION['edit']['password2']=="") {
                	$error['password2Err']="Password verification is required";
            	}
            	if ($_SESSION['edit']['user-phrase']!=$_SESSION['pass_phrase']) {
            		$error['verifyErr']="Please enter the text exactly as shown";
            	}
            	if(!preg_match('/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/', $_SESSION['edit']['email'])){
                    $error['emailErr']="Email is invalid.Please enter a valid email";
                }
                if (!preg_match('/(?:^[A-Z][a-z]+$)/', $_SESSION['edit']['fname'])) {
                 	$error['fnameErr']="Name is not valid. Please enter a valid name.";
                 }
                if (!preg_match('/(?:^[A-Z][a-z]+$)/', $_SESSION['edit']['lname'])) {
                 	$error['lnameErr']="Name is not valid. Please enter a valid name.";
                }
                if (!preg_match('/^[0-9]{10}$/', $_SESSION['edit']['mobile'])) {
                	$error['mobileErr']="Please enter a valid mobile number";
                }
                if (count($error)>0) {
                  	$msg="Errors!";
                  	//foreach ($input as $value) {
                  	//	if (isset(@$error[$value."Err"])) {
                  	//		unset($_SESSION['edit'][$value]);
                  	//	}
                  	//}
                  }
                else{
                	$fname=$_SESSION['edit']['fname'];
                	$lname=$_SESSION['edit']['lname'];
                	$email=$_SESSION['edit']['email'];
                	$mobile=$_SESSION['edit']['mobile'];
                	$password=sha1($_SESSION['edit']['password1']);
                	$id=$_SESSION['index']['cust_id'];

                	$query="UPDATE customer SET fname='$fname', lname='$lname', mobile='$mobile', password='$password' WHERE cust_id='$id' LIMIT 1";
                	$result=@mysqli_query($db,$query);
                	if (@mysqli_affected_rows($db)==1) {
                		$msg="Your Details have been edited successfully !";
                	}
                	else{
                		$errordb=mysqli_error($db);
                	}
                }   
        	}
            
         ?>
		<main role="main">
            <div class="container-fluid edit-page" id="edit">
                <div role="page-info" class="edit-head">
                    <h1>Edit Your Details</h1>
                    <hr>
                     <p>
                         hgjhgsdjasgdjagdhjeyrwerw  hwehjgf chghjgdjhfuugu hcsgdfjsd gchjcbhsdfj hgehds hjhhg.
                     </p>
                </div>
                <div class="container">
                    <div class="feedback">
                        <h2><?php 
                        		echo @$msg; 
                               	echo @$errordb;
                            ?>
                        </h2>
                    </div>
                    <form class="form-horizontal" id="edit-form" role="form" method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                        <div class="form-group" form-group-lg>
                            <label for="fname" class="col-sm-offset-2 col-sm-2 control-label">
                                First Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo(@$_SESSION['edit']['fname']); ?>"
                                 placeholder="Enter First Name(e.g. Radhika)">
                            </div> 
                            <span class="col-sm-4 errorspan" id="fnameerror">
                                <?php echo(@$error['fnameErr']); ?>
                            </span>   
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="lname" class="col-sm-2 col-sm-offset-2 control-label">
                                Last Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo(@$_SESSION['edit']['lname']); ?>"
                                placeholder="Enter Last Name(e.g. Mishra)">
                            </div>
                            <span class="col-sm-4 errorspan" id="lnameerror">
                                <?php echo(@$error['lnameErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="email" class="col-sm-2 col-sm-offset-2 control-label">
                                Email-id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo(@$_SESSION['edit']['email']); ?>" 
                                placeholder="Enter your valid email-id">
                            </div>
                            <span class=" col-sm-4 errorspan" id="emailerror">
                                <?php echo(@$error['emailErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="mobile" class="col-sm-2 col-sm-offset-2 control-label">
                                Mobile :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo(@$_SESSION['edit']['mobile']); ?>"
                                placeholder="Enter your Mobile Number(10 digits)">
                            </div>
                            <span class="col-sm-4 errorspan" id="mobileerror">
                                <?php echo(@$error['mobileErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="password1" class="col-sm-2 col-sm-offset-2 control-label">
                                Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control"name="password1" id="password1" placeholder="Enter a password (8-12 characters)" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password1error">
                                <?php echo(@$error['password1Err']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="password2" class="col-sm-2 col-sm-offset-2 control-label">
                                Re-enter Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control"name="password2" id="password2" placeholder="Re-enter password for verification" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password2error">
                                <?php echo(@$error['password2Err']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="verify" class="col-sm-2 col-sm-offset-2 control-label">
                                Verification :
                            </label>
                            
                            <div class="col-sm-4">
                            <input type="text" id="verify" class="form-control" name="verify" placeholder="Enter the text in the image">
                            </div>
                            <img src="captcha.php" alt="verification phrase" class="col-sm-2">
                            <span class="col-sm-2 errorspan" id="verifyerror">
                                <?php echo(@$error['verifyErr']); ?>
                            </span>
                                
                        </div>
                        <div class="form-group">
                           	<div class="col-sm-offset-5 col-sm-4">
                                
                            	<input type="submit" class="btn btn-primary col-sm-offset-2" value="submit" id="submit" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
	</body>
</html>