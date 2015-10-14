<header role="banner">
            <nav role="navigation" class="navbar navbar-fixed-top navbar-default" id="nb">
                <div class="container-fluid">   
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsed">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#mycarousel" class="navbar-brand"><img src="img/logo.png" alt="company" width="120"></a>
                </div>
                <div id="navbar-collapsed" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php#home"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="index.php#portfolio"><span class="glyphicon glyphicon-lock"></span> Portfolio</a></li>
                        
                        <li><a href="index.php#team"><span class="icon fa fa-group"></span> Team</a></li>
                        <li><a href="index.php#customers"> <span class="icon fa fa-desktop"></span> Customers</a></li>
                        <li><a href="index.php#contact"><span class="icon fa fa-envelope"></span> Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (@$_SESSION['log']=="yes"){
                            $sign_value=" Sign-Out";
                            $log_value=" Log-Out";
                            $other=" Edit Details";
                            $menu1="logout.php";
                            $menu2="editDetail.php";
                        }
                        else{
                            $sign_value=" Sign-In";
                            $log_value=" Log-In";
                            $other=" Register";
                            $menu1="login.php";
                            $menu2="registration.php";
                        }
                        echo"<li class='dropdown'>";
                            echo"<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$sign_value."<b class='caret'></b></a>";
                            echo "<ul role='menu' class='dropdown-menu'>";
                                echo "<li><a href='$menu1'><span class='icon fa fa-sign-in'></span>".$log_value."</a></li>";
                                echo "<li><a href='$menu2'><span class='icon fa fa-sign-out'></span>".$other."</a></li>";
                            echo "</ul>";
                        echo"</li>";           
                        ?>
                        <li><a href="#"><span class="icon fa fa-car"></span> Book Service</a></li>
                    </ul>
                </div>  
            </div>  
            </nav>
        </header>