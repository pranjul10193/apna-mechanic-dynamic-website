<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Book a Servicing</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/__main.css">
        <style type="text/css">
            .errorspan{
                color: red;
            }
            .errorclass{
                 background-color: #cccccc;
            }
        </style>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Modernizr -->
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>
		<?php include 'script.php'; ?>
		<!-- Respond.js for IE 8 or less only -->
		<!--[if (lt IE 9) & (!IEMobile)]>
		<script src="js/vendor/respond.min.js"></script>
		<![endif]--> 
    </head>
    <body data-spy="scroll" data-target="#nb" data-offset="90">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
  
        <?php
        require 'mysqli_connect.php';

        if ($_SERVER['REQUEST_METHOD']=="POST") {
        	
            if (!isset($_SESSION['verify_member'])) {
                	
                if (isset($_SESSION['book'])) {
                    unset($_SESSION['book']);
                }   
            	$_SESSION['book']['mobile']=$_POST['mobile'];
            	$error=array();
            	$msg="First enter your mobile number and click submit";
            	if ($_SESSION['book']['mobile']=="") {
                	$error['mobileErr']="Mobile is required";
            	}
            	if(!preg_match('/^[0-9]{10}$/', $_SESSION['book']['mobile'])){
                    $error['mobileErr']="Mobile number is not valid";
                }

            	if (count($error)>0) {
            		$msg="Errors !";
            	}
            
            	else{
            		$mobile=$_SESSION['book']['mobile'];
            		$query="SELECT fname,email,mobile FROM customer WHERE (mobile='$mobile')";
            		$result=@mysqli_query($db,$query);
            		if (@mysqli_num_rows($result)==1) {
            			$_SESSION=@mysqli_fetch_array($result,MYSQLI_ASSOC);
            			$_SESSION['book']['fname']=$_SESSION['fname'];
            			$_SESSION['book']['email']=$_SESSION['email'];
            			$_SESSION['book']['mobile']=$_SESSION['mobile'];
            			$_SESSION['attr']="readonly";	

            			@mysqli_free_result($result);
            		}
            		else{
            			$_SESSION['attr']="";
            		}
            		$_SESSION['verify_member']="yes";
            	}
            }
            if (isset($_SESSION['verify_member'])) {
            	# code...
            }
        }
        else{
        	$_SESSION['attr']="disabled";
        }
        
        ?>
        <?php include("nav.php");?>
        <main role="main">
            <div class="container-fluid booking-page" id="booking">
                <div role="page-info" class="booking-head">
                    <h1>Book a Service with us</h1>
                    <hr>
                     <p>
                         hgjhgsdjasgdjagdhjeyrwerw  hwehjgf chghjgdjhfuugu hcsgdfjsd gchjcbhsdfj hgehds hjhhg.<br>
                         Registered members get an assured discount.
                     </p>
                </div>
                <div class="container">
                    <div class="feedback">
                        <h2><?php echo @$msg; 
                                  echo @$errordb;
                            ?>
                        </h2>
                    </div>
                    <form class="form-horizontal" id="booking" role="form" method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                    	<div class="form-group" form-group-sm>
                            <label for="mobile" class="col-sm-2 col-sm-offset-2 control-label">
                                Mobile :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo(@$_SESSION['book']['mobile']); ?>"
                                placeholder="Enter your Mobile Number(10 digits)">
                            </div>
                            <span class="col-sm-4 errorspan" id="mobileerror">
                                <?php echo(@$error['mobileErr']); ?>
                            </span>
                        </div>
                        <div class="form-group" form-group-lg>
                            <label for="fname" class="col-sm-offset-2 col-sm-2 control-label">
                                First Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo(@$_SESSION['book']['fname']); ?>"
                                 placeholder="Enter First Name(e.g. Radhika)">
                            </div> 
                            <span class="col-sm-4 errorspan" id="fnameerror">
                                <?php echo(@$error['fnameErr']); ?>
                            </span>   
                        </div>
                        <div class="form-group" form-group-sm>
                            <label for="email" class="col-sm-2 col-sm-offset-2 control-label">
                                Email-id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo(@$_SESSION['book']['email']); ?>" 
                                placeholder="Enter your valid email-id">
                            </div>
                            <span class=" col-sm-4 errorspan" id="emailerror">
                                <?php echo(@$error['emailErr']); ?>
                            </span>
                        </div>
                        <div class="form-group " form-group-sm>
                            <label for="vehicle" class="col-sm-2 col-sm-offset-2 control-label ">
                                Vehicle Type :
                            </label>
                            <div class="col-sm-4">
                                <div class="col-sm-1">
                                    <input type="radio" name="vehicle" id="two-wheeler" value="two-wheeler">
                                </div>
                                <label for="two-wheeler" class="col-sm-1">
                                    Two-Wheeler 
                                </label>
                                <div class="col-sm-offset-3 col-sm-1">
                                    <input type="radio" name="vehicle" id="four-wheeler" value="four-wheeler">
                                </div>
                                <label for="four-wheeler" class="col-sm-1">
                                    Four-wheeler 
                                </label>
                            </div>
                            <span class="col-sm-4 errorspan" id="vehicleerror">
                                <p><?php echo(@$error['vehicleErr']); ?></p>
                            </span>    
                        </div>
                        <br>
                        <div class="form-group" form-group-lg>
                            <label for="description" class="col-sm-offset-4 col-sm-4 control-label">
                                Describe in detail here(e.g. vehicle-model etc) :
                            </label>
                           	<br>
                            <textarea name="description" class="col-sm-offset-4 col-sm-4" rows="5" cols="4"
                            value="" placeholder="Not more than 50 words....!"></textarea> 
                        	<span class="col-sm-2 errorspan" id="fnameerror">
                                <?php echo(@$error['descriptionErr']); ?>
                            </span>
                        </div>       
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
                                
                            <input type="submit" class="btn btn-primary col-sm-offset-2" value="Book" id="submit" name="submit">
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>        