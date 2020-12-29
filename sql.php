<?php
	session_start();
	$sql = new PDO("mysql:host=localhost;dbname=50;charset=utf8;","admin","1234");
	if(isset($_SESSION['message']) && $_SESSION['message'] != null){
		echo "<script>alert('{$_SESSION['message']}')</script>";
		$_SESSION['message'] = null;
	}
	function go($a){
		header("location:".$a);
	}
	function all($c){
		global $sql;
		return $sql->query($c)->fetchAll();
	}
	function once($c){
		global $sql;
		return $sql->query($c)->fetch();
	}
	function other($c){
		global $sql;
		return $sql->query($c);
	}
	function color(){
		$str = "0123456789ABCDEF";
		$color = "#";
		for($i=0;$i<6;$i++){
			$color .= $str[mt_rand(0,strlen($str)-1)];
		}
		return $color;
	}
	function project(){
		$member = once("SELECT COUNT(*) FROM `member` WHERE proid = '{$_SESSION['proid']}'")['COUNT(*)'];
		$scroe = once("SELECT COUNT(*) FROM `scroe` WHERE proid = '{$_SESSION['proid']}'")['COUNT(*)'];
		$plan = once("SELECT COUNT(*) FROM `plan` WHERE proid = '{$_SESSION['proid']}'")['COUNT(*)'];
		$start = once("SELECT COUNT(*) FROM `planstart` WHERE proid = '{$_SESSION['proid']}' AND userid != 1")['COUNT(*)'];
		$total = $member*$scroe*$plan;
		if($scroe == 0 || $total != $start){
			$ok = "false";
			other("UPDATE `project` SET `avgok` = 'false' WHERE proid = '{$_SESSION['proid']}'");
		}else{
			$ok = "true";
		}
		return $ok;
	}
?>