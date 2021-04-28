<?php
	require "./config.php";
	$id = trim($_REQUEST["id"]);
	if (empty($id)) {
	   $result = array(
	       "result" => "100",
	       "msg" => $id,
	   );
	}else{
		$sel = "DELETE FROM longway WHERE id=".$id."";
		$daya  = mysqli_query($com,$sel);
		if ($daya) {
		    $result = array(
		        "result" => "200",
		        "msg" => "删除成功",
		    );
		}else{
			$result = array(
			    "result" => "400",
			    "msg" => "删除失败",
			);
		}
	}
	// 输出
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>