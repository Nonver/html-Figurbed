<?php
	require "./config.php";
	$name = trim($_REQUEST["name"]);
	$password = trim($_REQUEST["password"]);
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
	$sel = "SELECT * FROM imgname WHERE ImgName='".$name."'";
	$num = mysqli_query($com,$sel);
	$new = mysqli_fetch_array($num,MYSQLI_ASSOC);
	if (empty($name)) {
	   $result = array(
	       "result" => "100",
	       "msg" => $name,
	   );
	}else{
		if ($new ) {
			$result = array(
			    "result" => "300",
			    "msg" => "用户名已存在",
				"dwz" => $new,
				"dww" =>$sel,
			);
		    
		}else{
			$select = "INSERT INTO imgname(ImgName,ImgPas,IP) VALUE('".$name."','".$password."','".$user_IP."')";
			$sum = mysqli_query($com,$select);
			if($sum){
				$result = array(
				    "result" => "200",
				    "msg" => "注册成功",
				);
			}else{
				$result = array(
				    "result" => "400",
				    "msg" => "注册失败",
				);
			}
			
		}
	}
	// 输出
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>