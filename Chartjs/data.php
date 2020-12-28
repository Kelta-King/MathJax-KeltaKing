<?php

	include "SimpleXLSX/SimpleXLSX.php";
	if ( $xlsx = SimpleXLSX::parse('book1.xlsx') ) {
    
		$i = 0;
		
		$numbers = array();
		$names = array();
		$heights = array();
		$marks = array();
		
		foreach ($xlsx->rows() as $elt) {
			
			if($i == 0){
				
			}
			else{
				
				$numbers[$i] = $elt[0];
				$names[$i] = $elt[1];
				$heights[$i] = $elt[2];
				$marks[$i] = $elt[3];
		
			}
			$i++;
			
		}
		
		$str = "";
		$i = 0;
		forEach($numbers as $number){
			
			if($i == (count($numbers)-1)){
				
				$str .= $number;
				
			}
			else{
				
				$str .= $number."#";
				
			}
			
			$i++;
			
		}
		
		$str .= "&";
		
		$i = 0;
		forEach($names as $name){
			
			if($i == (count($names)-1)){
				
				$str .= $name;
				
			}
			else{
				
				$str .= $name."#";
				
			}
			
			$i++;
			
		}
		
		$str .= "&";
		
		$i = 0;
		forEach($heights as $height){
			
			if($i == (count($heights)-1)){
				
				$str .= $height;
				
			}
			else{
				
				$str .= $height."#";
				
			}
			
			$i++;
			
		}
		
		$str .= "&";
		
		$i = 0;
		forEach($marks as $mark){
			
			if($i == (count($marks)-1)){
				
				$str .= $mark;
				
			}
			else{
				
				$str .= $mark."#";
				
			}
			
			$i++;
			
		}
		
		echo $str;

	} 
	else {
		echo SimpleXLSX::parseError();
	}

?>