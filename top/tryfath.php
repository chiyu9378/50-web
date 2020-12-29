<?php 
	include("../sql.php");
	$member = once("SELECT COUNT(*) FROM `member` WHERE proid = '{$_GET['edit_id']}'")['COUNT(*)'];
	$os = once("SELECT COUNT(*) FROM `opinino` WHERE proid = '{$_GET['edit_id']}'")['COUNT(*)'];
	$osm = all("SELECT * FROM `opinino` WHERE proid = '{$_GET['edit_id']}'");
	$nn = 0;
	foreach($osm  as $o){
		$ms = once("SELECT COUNT(*) FROM `opstart` WHERE userid != 1 AND opininoid = '{$o['id']}'")['COUNT(*)'];
		$nn = $nn+$ms*1;
		// echo $ms."<br><br>";
	}
	$tt = $member*$os;
	if($os == 0 || $tt != $nn){
		$_SESSION['message'] = "有成員未對所有意見評分完畢";
		// echo $member."<br>";
		// echo $os."<br>";
		// echo $nn."<br>";
	}else{
		$face = all("SELECT * FROM `face` WHERE proid = '{$_GET['edit_id']}'");
		$out = [];
		foreach($face as $f){
			$aa = [];
			$op = all("SELECT * FROM `opinino` JOIN `opstart` ON `opinino`.`id` = `opstart`.`opininoid` WHERE faceid = '{$f['id']}' GROUP BY `opinino`.`id` ORDER BY SUM(start) DESC LIMIT 2");
			foreach($op as $o){
				$aa[] = $o['opininoid'];
			}
			$out[] = $aa;
		}
		$chi = [];
		alphe($out,0,[]);
		function alphe($ar,$n,$ao){
			global $chi;
			foreach($ar[$n] as $cc){
				$aa = $ao;
				array_push($aa,$cc);
				if(count($aa) == count($ar)){
					$chi[] = $aa;
				}else{
					alphe($ar,$n+1,$aa);
				}
			}
		}
		$i=0;
		foreach($chi as $yu){
			$i++;
			$num = sprintf('A%03d',$i);
			$title = "執行方案".$i;
			$description = "";
			foreach($yu as $j){
				$op = once("SELECT * FROM `opinino` WHERE id = '{$j}'");
				$description .= $op['title']." ";
			}
			other("INSERT INTO `plan` VALUES('','{$_GET['edit_id']}','{$num}','{$title}','{$description}','')");
			$plan = once("SELECT * FROM `plan` ORDER BY id DESC LIMIT 1")['id'];
			foreach($yu as $k){
				other("INSERT INTO `planoption` VALUES('','{$plan}','{$k}')");
			}
		}
		$_SESSION['message'] = "自動產生執行方案成功";
	}
	go("plan.php?edit_id={$_GET['edit_id']}");
?>