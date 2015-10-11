<?php 
    session_start();
    $_SESSION['script']="<script type='text/javascript' src='js/registration.js'></script>";
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/__main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Modernizr -->
<script src="js/vendor/modernizr-2.6.2.min.js"></script>
<?php include 'script.php'; ?>
<?php echo $_SESSION['script']; ?>
<!-- Respond.js for IE 8 or less only -->
<!--[if (lt IE 9) & (!IEMobile)]>
<script src="js/vendor/respond.min.js"></script>
<![endif]--> 
        <title>Registration</title>
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
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
                if (isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['input'])) {
                    unset($_SESSION['input']);
                }
            
            $_SESSION['script']="<!--<script type='text/javascript' src='js/registration.js'></script>-->";
    
            
            $input=array("fname","lname","mobile","email","password1","password2","gender");
            $_SESSION['input']=array();
            
            foreach ($input as $value) {
                $_SESSION['input'][$value]=$_POST[$value];
            }
            $_SESSION['input']['user-phrase']=sha1($_POST['verify']);
            $required=array("fname","lname","mobile","email","gender");
            $_SESSION['error']=array();
                foreach ($required as $value) {
                    if (!isset($_SESSION['input'][$value]) || $_SESSION['input'][$value]=="") {
                        $_SESSION['error'][$value."Err"]=$value." is required";
                    }
                    else {
                        
                        if (($value=='fname') && (!preg_match('/(?:^[A-Z][a-z]+$)/', $_SESSION['input'][$value]))){
                            $_SESSION['error'][$value."Err"]=$value." is invalid.";
                        }
                        if (($value=='lname') && (!preg_match('/(?:^[A-Z][a-z]+$)/', $_SESSION['input'][$value]))){
                            $_SESSION['error'][$value."Err"]=$value." is invalid.";
                        }
                        if (($value=='mobile') && (!preg_match('/^[0-9]{10}$/', $_SESSION['input'][$value]))){
                            $_SESSION['error'][$value."Err"]=$value." is not valid";
                        }
                        if (($value=="email") && (!preg_match('/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/', $_SESSION['input'][$value]))){
                            $_SESSION['error'][$value."Err"]=$value." is invalid";
                        }
                        
                    }
                }
            if ($_SESSION['input']['password1']=="") {
                $_SESSION['error']['password1Err']="Password is required";
            }
            if ($_SESSION['input']['password2']=="") {
                $_SESSION['error']['password2Err']="Password verification is required";
            }
            if (!preg_match('/^[a-zA-Z0-9!@*+-\/%.$]{8,12}$/', $_SESSION['input']['password1'])) {
                $_SESSION['error']["password1Err"]="Password is not valid";
            }
            if ($_SESSION['input']['password2']!=$_SESSION['input']['password1']) {
                $_SESSION['error']['password2Err']="Password do not match";
            }
            if ($_SESSION['input']['user-phrase']!=$_SESSION['pass_phrase']) {
                $_SESSION['error']['verifyErr']="Enter the text exactly as shown";
            }

            if(isset($_SESSION['error']) && count($_SESSION['error'])>0){
                $msg= "Errors!";
            }
            else{
                
                $fname=$_SESSION['input']['fname'];
                $lname=$_SESSION['input']['lname'];
                $mobile=$_SESSION['input']['mobile'];
                $email=$_SESSION['input']['email'];
                $password=$_SESSION['input']['password1'];
                $gender=$_SESSION['input']['gender'];
                $query="SELECT * FROM customer WHERE (mobile='$mobile')";
                $result=@mysqli_query($db,$query);
                if (@mysqli_num_rows($result)==1) {
                    $msg="You have already registered..!";
                    @mysqli_free_result($result);
                    unset($_SESSION['input']);
                    unset($_SESSION['error']);
                }
                else{
                    $query="INSERT INTO customer (cust_id, fname, lname, email, password, mobile, gender, regdate) VALUES ('', '$fname', '$lname', '$email', sha1('$password'), '$mobile', '$gender', NOW() )";
                    $result= @mysqli_query($db,$query);
                    if ($result) {

                        $msg="Thank you for registering!";
                        unset($_SESSION['input']);
                        unset($_SESSION['error']);
                    }
                    else{
                        $msg="You couldnt connect due to system error. We apologise !";
                        $error=mysqli_error($db);
                    }
                }
            }    
            mysqli_close($db);
        }        
        ?> 

        <main role="main">
            <div class="container-fluid registration-page" id="register">
                <div role="page-info" class="register-head">
                    <h1>Register</h1>
                    <hr>
                     <p>
                         hgjhgsdjasgdjagdhjeyrwerw  hwehjgf chghjgdjhfuugu hcsgdfjsd gchjcbhsdfj hgehds hjhhg.
                     </p>
                </div>
                <div class="container">
                    <div class="feedback">
                        <h2><?php echo @$msg; 
                                    echo @$error;
                            ?>
                        </h2>
                    </div>
                    <form class="form-horizontal" id="signup" role="form" method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
                        <div class="form-group" form-group-lg>
                            <label for="fname" class="col-sm-2 control-label">
                                First Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo(@$_SESSION['input']['fname']); ?>"
                                 placeholder="Enter First Name">
                            </div> 
                            <span class="col-sm-4 errorspan" id="fnameerror">
                                <?php echo(@$_SESSION['error']['fnameErr']); ?>
                            </span>   
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="lname" class="col-sm-2 control-label">
                                Last Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo(@$_SESSION['input']['lname']); ?>"
                                placeholder="Enter Last Name">
                            </div>
                            <span class="col-sm-4 errorspan" id="lnameerror">
                                <?php echo(@$_SESSION['error']['lnameErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="email" class="col-sm-2 control-label">
                                Email-id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo(@$_SESSION['input']['email']); ?>" 
                                placeholder="Enter your email-id">
                            </div>
                            <span class=" col-sm-4 errorspan" id="emailerror">
                                <?php echo(@$_SESSION['error']['emailErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="mobile" class="col-sm-2 control-label">
                                Mobile :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo(@$_SESSION['input']['mobile']); ?>"
                                placeholder="Enter your Mobile Number">
                            </div>
                            <span class="col-sm-4 errorspan" id="mobileerror">
                                <?php echo(@$_SESSION['error']['mobileErr']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group " form-group-sm>
                            <label for="gender" class="col-sm-2 control-label ">
                                Gender :
                            </label>
                            <div class="col-sm-4">
                                <div class="col-sm-1">
                                    <input type="radio" name="gender" id="male" value="male">
                                </div>
                                <label for="male" class="col-sm-1">
                                    Male 
                                </label>
                                <div class="col-sm-offset-3 col-sm-1">
                                    <input type="radio" name="gender" id="female" value="female">
                                </div>
                                <label for="female" class="col-sm-1">
                                    Female 
                                </label>
                            </div>
                            <span class="col-sm-4 errorspan" id="gendererror">
                                <p><?php echo(@$_SESSION['error']['genderErr']); ?></p>
                            </span>    
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="password1" class="col-sm-2 control-label">
                                Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control"name="password1" id="password1" placeholder="Enter a password" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password1error">
                                <?php echo(@$_SESSION['error']['password1Err']) ?>
                            </span>
                        </div>
                        <div class="form-group" form-group-sm>
                            <label for="password2" class="col-sm-2 control-label">
                                Re-enter Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control"name="password2" id="password2" placeholder="Re-enter password for verification" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password2error">
                                <?php echo(@$_SESSION['error']['password2Err']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="verify" class="col-sm-2 control-label">
                                Verification :
                            </label>
                            
                            <div class="col-sm-4">
                            <input type="text" id="verify" class="form-control" name="verify" placeholder="Enter the text in the image">
                            </div>
                            <img src="captcha.php" alt="verification phrase" class="col-sm-2">
                            <span class="col-sm-4 errorspan" id="verifyerror">
                                <?php echo(@$_SESSION['error']['verifyErr']); ?>
                            </span>
                                
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                
                            <input type="submit" class="btn btn-primary col-sm-offset-2" value="submit" id="submit" name="submit">
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>