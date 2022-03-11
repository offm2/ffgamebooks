<?php session_start();
	  // required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
define('PRETTY',JSON_PRETTY_PRINT);
try{
		  if(isset($_SESSION))
		{
	$mdados1=mt_rand(1,6);$mdados2=mt_rand(1,6);
	$endados1=mt_rand(1,6);$endados2=mt_rand(1,6);
	$dec="";$dec2="";
	if($mdados1+$mdados2+$_SESSION["mpericia"]>$endados1+$endados2+$_SESSION["enpericia"])
		{$_SESSION["enforca"]-=2;$dec="Win";}
	else if($mdados1+$mdados2+$_SESSION["mpericia"]<$endados1+$endados2+$_SESSION["enpericia"])
		{$_SESSION["mforca"]-=2;$dec="Lost";}
	else{$dec="Draw";}
	if($_SESSION["enforca"]<=0)
		{$dec2="Win";}
	else if($_SESSION["mforca"]<=0)
		{$dec2="Lost";}
	$mfor=$_SESSION["mforca"];$mper=$_SESSION["mpericia"];$msor=$_SESSION["msorte"];
	$enfor=$_SESSION["enforca"];$enper=$_SESSION["enpericia"];
	//fight array
	$fight_arr=array();
	$fight_arr["records"]=array();
	
			$ft_data=array(
			"mystamina"=>$mfor,
			"myskill"=>$mper,
			"myluck"=>$msor,
			"enstamina"=>$enfor,
			"enskill"=>$enper,
			"mdice1"=>$mdados1,
			"mdice2"=>$mdados2,
			"endice1"=>$endados1,
			"endice2"=>$endados2,
			"decision"=>$dec,
			"decision2"=>$dec2,
			"message"=>""
			);
			array_push($fight_arr["records"],$ft_data);
		
		   //set response code - 200 OK
	       http_response_code(200);
	       //show fighting data in json format
			echo json_encode($fight_arr,PRETTY);
		}
	  else{
		//set response code - 404 NOT Found
		http_response_code(404);
			//fight array
			$fight_arr=array();
			$fight_arr["records"]=array();	
					$ft_data=array(
					"message"=>"Could not continue fighting"
			);
			array_push($fight_arr["records"],$ft_data);
			//tell the user that the fight could not continue
			echo json_encode($fight_arr,PRETTY);
		}
	}
	catch (Exception $e){

	http_response_code(401);
		//fight array
			$fight_arr=array();
			$fight_arr["records"]=array();	
					$ft_data=array(
						"message" => "Access denied.",
						"error" => $e->getMessage()
			);
			array_push($fight_arr["records"],$ft_data);
			//tell the user that no fight could be started
			echo json_encode($fight_arr,PRETTY);
			}
	  
?>