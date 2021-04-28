<?php
	require "./config.php";
	$uid = trim($_REQUEST["uid"]);
	$page = trim($_REQUEST["page"])-1;
	$top = $page*10;
	
	$select = "select id,url,timeImg from longway WHERE uid='". $uid ."' ORDER BY id DESC LIMIT ".$top.",10";
	if (empty($uid)) {
	   $result = array(
	       "result" => "100",
	       "msg" => $uid,
		   "s"=>$page,
	   );
	}else{
		$num = mysqli_query($com,$select);
		$new = mysqli_fetch_all($num,MYSQLI_ASSOC);
		$sum = mysqli_query($com,"select COUNT(*) as totla FROM longway");
		$sumNew = mysqli_fetch_all($sum,MYSQLI_ASSOC);
		if ($num) {
			
		    $result = array(
		        "result" => "200",
		        "msg" => "查询成功",
				"dwz" => $new,
				"totla" => $sumNew,
				"page" => $page,
		    );
		}else{
			$result = array(
			    "result" => "400",
			    "msg" => "查询失败",
				"dwz" => $select,
			);
		}
	}
	// 输出
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>