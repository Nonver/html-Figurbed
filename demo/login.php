<?php
	require "./config.php";
	$name = trim($_REQUEST["name"]);
	$password = trim($_REQUEST["password"]);
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
	$select = "INSERT INTO imgname_copy(ImgName,ImgPas,IP) VALUE('".$name."','".$password."','".$user_IP."')";
	if (empty($name)) {
	   $result = array(
	       "result" => "100",
	       "msg" => $name,
	   );
	}else{
		$num = mysqli_query($com,$select);
		if ($num) {
			$sel = "select * from imgname where ImgName='".$name."' and '". $password."'";
			$daya  = mysqli_query($com,$sel);
			$new = mysqli_fetch_array($daya,MYSQLI_ASSOC);
		    $result = array(
		        "result" => "200",
		        "msg" => "登录成功",
				"dwz" => $new
		    );
		}else{
			$result = array(
			    "result" => "400",
			    "msg" => "登录失败",
			);
		}
	}
	// 输出
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>