<?php
	if(!isset($_SESSION)){
		session_start();
	}
	function convertState($state){
		$abbrev_list=array("MP"=>"Madhya Pradesh",
				 "CG"=>"Chhatisgarh",
				 "UP"=>"Uttar Pradesh",
				 "MH"=>"Maharashtra",
				 "AP"=>"Andhra Pradesh",
				 "HP"=>"Himachal Pradesh",
				 "RJ"=>"Rajasthan",
				 "JK"=>"Jammu & Kashmir",
				 "GJ"=>"Gujrat",
				 "WB"=>"West Bengal"
				 );
		if(array_key_exists($state, $abbrev_list)){
			print("The full name of state is {$abbrev_list[$state]}<br>\n");
		}
		else{
			print("{$state} is not a valid state abbreviation. please enter again");
		}
	}

	
?>