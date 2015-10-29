<?php 
    session_start();
    if(@$_SESSION['log']=="yes"){
        header("Location: index.php");
        exit();
    }
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log-In</title>
        <style type="text/css">
            .errorspan{
                color: red;
            }
            .errorclass{
                 background-color: #cccccc;
            }
        </style>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/__main.css">
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
        if ($_SERVER['REQUEST_METHOD']=="POST")
        {
                if (isset($_SESSION['login'])) {
                    unset($_SESSION['login']);
                }
            
            //$script="<!--<script type='text/javascript' src='js/registration.js'></script>-->";
    
            
            $input=array("email","password1");
            $_SESSION['login']=array();
            foreach ($input as $value) {
                $_SESSION['login'][$value]=$_POST[$value];
            }
            $error=array();
            if ($_SESSION['login']['password1']=="") {
                $error['password1']="Password is required";
            }
            if ($_SESSION['login']['email']=="") {
                $error['email']="Email is required";
            }
            if(!preg_match('/^[a-z_][a-z0-9]+(?:[-._][a-z0-9]+)*@[a-z]+(?:[-._][a-z0-9]+)*\.[a-z]+$/', $_SESSION['login']['email'])){
                            $error['email']="Email is invalid.Please enter a valid email";
                        }
            if (!preg_match('/^[a-zA-Z0-9!@*+-_.$]{8,12}$/', $_SESSION['login']['password1'])) {
                $error['password1']="You can use alphabets,numbers and special characters(@,!,*,+,.,_,$) only";
            }

            if(isset($error) && count($error)>0){
                $msg= "Errors!";
            }
            else{
                $email=$_SESSION['login']['email'];
                $password=$_SESSION['login']['password1'];

                $query="SELECT * FROM customer WHERE (email='$email' AND password=sha1('$password'))";
                $result=@mysqli_query($db,$query); 
                if($result){
                    if (@mysqli_num_rows($result)==1) {
                        $_SESSION['index']=@mysqli_fetch_array($result,MYSQLI_ASSOC); 
                        $_SESSION['log']="yes";
                        unset($_SESSION['login']);
                        mysqli_close($db);
                        $url="index.php";
                        header("Location: $url");
                        exit();//cancel the rest of the script
                        
                    } 
                    else{
                        $msg="Please check the details you entered. Perhaps you need to register first !";
                    }
                    }
                
                else{
                    $msg="You could not login due to system error.Please try again later.";
                    $errordb=mysqli_error($db);
                    unset($_SESSION['login']);
                }
            }
            mysqli_close($db);
        }
        ?>
        <?php include("nav.php");?>
        <main role="main">
            <div class="container-fluid login-page" id="login">
                <div role="page-info" class="login-head">
                    <h1>Login</h1>
                    <hr>
                     <p>
                         hgjhgsdjasgdjagdhjeyrwerw  hwehjgf chghjgdjhfuugu hcsgdfjsd gchjcbhsdfj hgehds hjhhg.
                     </p>
                </div>
                <div class="container">
                    <div class="feedback">
                        <h2><?php echo @$msg; 
                                  echo @$errordb;
                            ?>
                        </h2>
                    </div>
                    <form class="form-horizontal" id="signin" role="form" method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF'])); ?>">
        
                        <div class="form-group" form-group-sm>
                            <label for="email" class="col-sm-2 col-sm-offset-2 control-label">
                                Email-id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo(@$_SESSION['login']['email']); ?>" 
                                placeholder="Enter your registered email-id">
                            </div>
                            <span class=" col-sm-4 errorspan" id="emailerror">
                                <?php echo(@$error['email']); ?>
                            </span>
                        </div>
                        <br>
                        <div class="form-group" form-group-sm>
                            <label for="password1" class="col-sm-2 col-sm-offset-2 control-label">
                                Password :
                            </label>
                            <div class="col-sm-4" >
                                <input type="password"class="form-control" name="password1" id="password1" placeholder="Enter your password" >
                            </div>
                            <span class="col-sm-4 errorspan" id="password1error">
                                <?php echo(@$error['password1']); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-4">
                                
                            <input type="submit" class="btn btn-primary col-sm-offset-2" value="login" id="log-submit" name="submit">
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>         