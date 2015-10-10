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
        <?php include("nav.php"); ?>
        






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
                    <form class="form-horizontal" id="signup" role="form">
                        <div class="form-group" form-group-lg>
                            <label for="fname" class="col-sm-2 control-label">
                                First Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="fname" name="fname" value="" placeholder="Enter First Name">
                            </div> 
                            <span class="col-sm-4 errorspan" id="fnameerror">
                                
                            </span>   
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="lname" class="col-sm-2 control-label">
                                Last Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="lname" name="lname" value=""
                                placeholder="Enter Last Name">
                            </div>
                            <span class="col-sm-4 errorspan" id="lnameerror">
                                
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="email" class="col-sm-2 control-label">
                                Email-id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value=""
                                placeholder="Enter your email-id">
                            </div>
                            <span class=" col-sm-4 errorspan" id="emailerror">
                                
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="mobile" class="col-sm-2 control-label">
                                Mobile :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="mobile" name="mobile" value=""
                                placeholder="Enter your Mobile Number">
                            </div>
                            <span class="col-sm-4 errorspan" id="mobileerror">
                                
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
                            <span class="col-sm-4 errorspan" id="password1error"></span>
                        </div>
                        <div class="form-group" form-group-sm>
                            <label for="password2" class="col-sm-2 control-label">
                                Re-enter Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control"name="password2" id="password2" placeholder="Re-enter password for verification" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password2error"></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="verify" class="col-sm-2 control-label">
                                Verification :
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="verify" class="col-sm-5" name="verify" placeholder="Enter the text in the image">
                                <img src="captcha.php" alt="verification phrase" class="col-sm-3">
                            </div>
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

        