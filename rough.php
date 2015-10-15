<?php
elseif (($_SESSION['attr']=="readonly") && ($_SESSION['log']!="yes")) {
            		$fname=$_SESSION['book']['fname'];
            		$email=$_SESSION['book']['email'];
            		$mobile=$_SESSION['book']['mobile'];
            		$description=$_POST['description'];
            		$vehicle=$_POST['vehicle'];
            		$query="INSERT INTO bookings (book_id, fname, email, mobile, vehicle, description, registered, regdate) VALUES ('','$fname','$email','$mobile','$vehicle','$description','yes', NOW() )";
            		$result=@mysqli_query($db,$query);
            		if ($result) {
            			$msg="We will contact you within two days from now. Thank you for booking.";
            			@mysqli_close($db);
            			unset($_SESSION['book']);
            			$_SESSION['attr']="disabled";
            			$_SESSION['some']="disabled";
            		}
            	}
        	}
        }
?>        	