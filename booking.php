<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Book a Service</title>
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
    

        	if (isset($_SESSION['verify_member']) && ($_SESSION['identity']=="guest")) {
        		if(isset($_SESSION['book'])){
        			unset($_SESSION['book']);
        		}
            	$attr="";
            	$some="";
            	$input=array("fname","email","mobile","vehicle","description");
            	$error=array();
            	foreach ($input as $value) {
            		$_SESSION['book'][$value]=$_POST[$value];
            	}
            	$_SESSION['book']['user-phrase']=sha1($_POST['verify']);
            	if ($_SESSION['book']['fname']=="") {
            		$error['fnameErr']="Name required";
            	}
            	if ($_SESSION['book']['email']=="") {
            		$error['emailErr']="Email required";
            	}
            	if ($_SESSION['book']['vehicle']=="") {
            		$error['vehicleErr']="Please select a vehicle type.";
            	}
            	if ($_SESSION['book']['mobile']=="") {
            		$error['mobileErr']="Please enter a mobile number";
            	}

            	if ($_SESSION['book']['user-phrase']!=$_SESSION['pass_phrase']) {
            		$error['verifyErr']="Please enter the text exactly as shown";
            	}
            	if(!preg_match('/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/', $_SESSION['book']['email'])){
                    $error['emailErr']="Email is invalid.Please enter a valid email";
                }
                if (!preg_match('/(?:^[A-Z][a-z]+$)/', $_SESSION['book']['fname'])) {
                 	$error['fnameErr']="Name is not valid. Please enter a valid name.";
                 }
                if (!preg_match('/^[a-zA-Z0-9!@*+-_.$]+$/', $_SESSION['book']['description'])){
                	$error['descriptionErr']="Please enter a genuine query!";
                }
                if (!preg_match('/^[0-9]{10}$/', $_SESSION['book']['mobile'])) {
                	$error['mobileErr']="Please enter a valid mobile number";
                }
                if (count($error)>0) {
                  	$msg="Errors!";
                  }
                else{
                	$fname=$_SESSION['book']['fname'];
                	$email=$_SESSION['book']['email'];
                	$mobile=$_SESSION['book']['mobile']; 
                	$vehicle=$_SESSION['book']['vehicle'];

                	$description=$_SESSION['book']['description'];
                	$query="INSERT INTO bookings (book_id, fname, email, mobile, vehicle, description, registered, regdate) VALUES ('','$fname','$email','$mobile','$vehicle','$description','no', NOW() )";
                	$result=@mysqli_query($db,$query);
                	if ($result) {
                		@mysqli_free_result($result);
        				unset($_SESSION['verify_member']);
        				unset($_SESSION['book']);
        				$msg="Thank you for booking with us. We will contact you soon.";
        				$attr="disabled";
        				$some="disabled";
        				$mob="disabled";	
            		}
        			else{
        				$msg="We couldn't take your booking due to system error. please try sometime later.";
        			}
        			@mysqli_close($db);
        		}
            }
            if (isset($_SESSION['verify_member']) && ($_SESSION['identity']=="customer")) {
            	$mob="readonly";
            	$attr="readonly";
            	$some="";
            	$check=array("vehicle","description","verify");
            	foreach ($check as $value) {
            		if (isset($_SESSION['book'][$value])) {
            			unset($_SESSION['book'][$value]);
            		}
            	}
            	$input=array("vehicle","description");
            	$error=array();
            	foreach ($input as $value) {
            		$_SESSION['book'][$value]=$_POST[$value];
            	}
        		$_SESSION['book']['user-phrase']=sha1($_POST['verify']);
        		if ($_SESSION['book']['vehicle']=="") {
            		$error['vehicleErr']="Please select a vehicle type.";
            	}
            	if(!preg_match('/^[a-zA-Z0-9!@*+-_.$]+$/', $_SESSION['book']['description'])){
                	$error['descriptionErr']="Please enter a genuine query!";
                }
                if ($_SESSION['book']['user-phrase']!=$_SESSION['pass_phrase']) {
            		$error['verifyErr']="Please enter the text exactly as shown";
            	}
            	else{
            		$fname=$_SESSION['book']['fname'];
                	$email=$_SESSION['book']['email'];
                	$mobile=$_SESSION['book']['mobile']; 
                	$vehicle=$_SESSION['book']['vehicle'];
                	$description=$_SESSION['book']['description'];
                	$query="INSERT INTO bookings (book_id, fname, email, mobile, vehicle, description, registered, regdate) VALUES ('','$fname','$email','$mobile','$vehicle','$description','yes', NOW() )";
                	$result=@mysqli_query($db,$query);
                	if ($result) {
            			
        				unset($_SESSION['verify_member']);
        				unset($_SESSION['book']);
        				$msg="Thank you for booking. we will contact you soon.";
        				$attr="disabled";
        				$some="disabled";
        				$mob="disabled";
        				
        			}
        			else{
        				$msg="We couldn't take your booking due to system error. please try sometime else.";
        			}
        			@mysqli_close($db);
        		}
            }
        	
            if (!isset($_SESSION['verify_member']) && (!isset($_SESSION['identity']))) {
            	if (isset($_SESSION['book'])) {
            		unset($_SESSION['book']);
            	}
       
                $attr="disabled";
                $some="disabled";	   
            	$error=array();
            	$_SESSION['book']['mobile']=$_POST['mobile'];
            	
            	if ($_SESSION['book']['mobile']=="") {
                	$error['mobileErr']="Mobile is required";
            	}
            	if(!preg_match('/^[0-9]{10}$/', $_SESSION['book']['mobile'])){
                    $error['mobileErr']="Mobile number is not valid";
                }

            	if (count($error)>0) {
            		$msg="Errors!";
            	}
            
            	else{
            		$mobile=$_SESSION['book']['mobile'];
            		$query="SELECT fname,email,mobile FROM customer WHERE (mobile='$mobile')";
            		$result=@mysqli_query($db,$query);
            		if (@mysqli_num_rows($result)==1) {
            			$_SESSION['book']=@mysqli_fetch_array($result,MYSQLI_ASSOC);
            			$mob="readonly";
            			$attr="readonly";
            			$some="";
            			$_SESSION['identity']="customer";	
            			$msg="Hello {$_SESSION['book']['fname']}.Please fill rest of the details.";
            			@mysqli_free_result($result);
            		}
            		else{
            			$attr="";
            			$some="";
            			$_SESSION['identity']="guest";
            			$msg="Hello Guest! Please fill in the details.";
            		}
            		$_SESSION['verify_member']="yes";
            	}
            }

        }
        else{
        	if (isset($_SESSION['book'])) {
        		unset($_SESSION['book']);
        	}
        	if (isset($_SESSION['verify_member'])) {
        		unset($_SESSION['verify_member']);
        	}
        	if(isset($_SESSION['identity'])) {
        		unset($_SESSION['identity']);
        	}
        	$attr="disabled";
        	$some="disabled";
        	$msg="First enter your mobile number and click submit";
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
                                placeholder="Enter your Mobile Number(10 digits)" <?php echo (@$mob); ?>>
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
                                 placeholder="Enter First Name(e.g. Radhika)" <?php echo (@$attr); ?>>
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
                                placeholder="Enter your valid email-id" <?php echo (@$attr); ?>>
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
                                    <input type="radio" name="vehicle" id="two-wheeler" value="two-wheeler" <?php echo (@$some); ?>>
                                </div>
                                <label for="two-wheeler" class="col-sm-1">
                                    Two-Wheeler 
                                </label>
                                <div class="col-sm-offset-3 col-sm-1">
                                    <input type="radio" name="vehicle" id="four-wheeler" value="four-wheeler" <?php echo (@$some); ?>>
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
                            value="<?php echo (@$_SESSION['book']['description']); ?>" placeholder="Not more than 50 words....!" <?php echo (@$some); ?>></textarea> 
                        	<span class="col-sm-2 errorspan" id="fnameerror">
                                <?php echo(@$error['descriptionErr']); ?>
                            </span>
                        </div>       
                        <div class="form-group">
                            <label for="verify" class="col-sm-2 col-sm-offset-2 control-label">
                                Verification :
                            </label>
                            
                            <div class="col-sm-4">
                            <input type="text" id="verify" class="form-control" name="verify" placeholder="Enter the text in the image" <?php echo (@$some); ?>>
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