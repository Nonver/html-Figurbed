<?php
	require './config.php';
    $file = $_FILES["file"];
	$uid = trim($_REQUEST["id"]);
    if(!isset($file['tmp_name']) || !$file['tmp_name']) {
        echo json_encode(array('code' => 401, 'msg' => '没有文件上传'));
        return false;
    }
    if($file["error"] > 0) {
        echo json_encode(array('code' => 402, 'msg' => $file["error"]));
        return false;
    }

    $upload_path = dirname(__FILE__) . "/LongWay/" . date('Ymd/');
    $file_path   = "./LongWay/" . date('Ymd/');

    if(!is_dir($upload_path) && !mkdir($upload_path, 0777, true)){
        echo json_encode(array('code' => 403, 'msg' => '上传目录创建失败，请确认是否有权限'));
        return false;
    };

    if(move_uploaded_file($file["tmp_name"], $upload_path.$file['name'])){
		$ins = 'INSERT INTO longway(url,uid) VALUE("'.$file_path.$file['name'].'","'.$uid.'");';
		$data = mysqli_query($com,$ins);
		if($data){
			echo json_encode(array('code' => 200, 'src' => $file_path.$file['name']));
		}else{
			echo json_encode(array('code' => 404, 'msg' => '上传失败'));
		}
        
        return false;
    }else{
        echo json_encode(array('code' => 404, 'msg' => '上传失败'));
        return false;
    }
?>