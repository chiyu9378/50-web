<?php
	include("sql.php");
	switch($_GET['id']){
		case 'login':
			$user = once("SELECT * FROM `users` WHERE user = '{$_POST['user']}' AND `pass` = '{$_POST['pass']}'");
			if(empty($user)){
				$_SESSION['message'] = "帳號或密碼錯誤";
				go("index.php");
			}else{
				$_SESSION['id'] = $user['id'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['type'] = $user['type'];
				$_SESSION['message'] = "成功登入";
				if($_SESSION['type'] == "admin"){
					go("admin/admin.php");
				}else{
					go("discuss/discuss.php");
				}
			}
		break;
		case 'logout':
			session_destroy();
			$_SESSION['message'] = "成功登出";
			go("index.php");
		break;
		
		case 'admin':
			$user = all("SELECT * FROM `users` ORDER BY user {$_GET['num']}");
			echo json_encode($user);
		break;
		case 'new_user':
			$user = once("SELECT * FROM `users` WHERE user = '{$_GET['user']}'");
			if(empty($user)){
				other("INSERT INTO `users` VALUES('','{$_POST['user']}','{$_POST['pass']}','{$_POST['name']}','users')");
				$_SESSION['message'] = "成功新增使用者";
				go("admin/admin.php");
			}else{
				$_SESSION['message'] = "此帳號已存在";
				go("index.php");
			}
		break;
		case 'edit_user':
			other("UPDATE `users` SET `name` = '{$_POST['name']}', `pass` = '{$_GET['pass']}' WHERE id = '{$_GET['edit_id']}'");
			$_SESSION['message'] = "成功修改使用者";
			go("admin/admin.php");
		break;
		case 'delt_user':
			other("DELETE FROM `users` WHERE id = '{$_GET['delt_id']}'");
			$_SESSION['message'] = "成功刪除使用者";
			go("admin/admin.php");
		break;
		
		case 'new_pro':
			other("INSERT INTO `project` VALUES('','{$_POST['project']}','{$_POST['description']}','true','true','false')");
			if(isset($_POST['face'])){
				$proid = once("SELECT * FROM `project` ORDER BY id DESC LIMIT 1")['id'];
				foreach($_POST['face'] as $k => $face){
					other("INSERT INTO `face` VALUES('','{$proid}','{$face}','{$_POST['facedescription'][$k]}')");
				}
			}
			$_SESSION['message'] = "成功新增專案";
			go("project/project.php");
		break;
		case 'edit_pro':
			other("UPDATE `project` SET `projectname`='{$_POST['project']}',`description`='{$_POST['description']}' WHERE id = '{$_GET['edit_id']}'");
			if(isset($_POST['oldface'])){
				foreach($_POST['oldface'] as $k => $face){
					other("UPDATE `face` SET `face` = '{$face}', `facedescription` = '{$_POST['oldfacedescription'][$k]}' WHERE id = '{$k}'");
				}
			}
			if(isset($_POST['oldid'])){
				foreach($_POST['oldid'] as $k){
					other("DELETE FROM `face` WHERE id = '{$k}'");
				}
			}
			if(isset($_POST['face'])){
				foreach($_POST['face'] as $k => $face){
					other("INSERT INTO `face` VALUES('','{$_GET['edit_id']}','{$face}','{$_POST['facedescription'][$k]}')");
				}
			}
			$_SESSION['message'] = "成功修改專案";
			go("project/project.php");
		break;
		case 'member':
			$member = all("SELECT * FROM `member` WHERE proid = '{$_GET['edit_id']}' AND type='{$_GET['type']}'");
			echo json_encode($member);
		break;
		case 'new_member':
			$top = $_GET['top'][0];
			other("INSERT INTO `member` VALUES('','{$_GET['edit_id']}','{$top}','top')");
			foreach($_GET['bot'] as $bot){
				other("INSERT INTO `member` VALUES('','{$_GET['edit_id']}','{$bot}','bot')");
			}
			$_SESSION['message'] = "成功指定成員";
			go("project/project.php");
		break;
		case 'edit_member':
		other("DELETE FROM `member` WHERE proid = '{$_GET['edit_id']}'");
		$top = $_GET['top'][0];
			other("INSERT INTO `member` VALUES('','{$_GET['edit_id']}','{$top}','top')");
			foreach($_GET['bot'] as $bot){
				other("INSERT INTO `member` VALUES('','{$_GET['edit_id']}','{$bot}','bot')");
			}
			$_SESSION['message'] = "成功指定成員";
			go("project/project.php");
		break;
		case 'delt_pro':
			other("DELETE FROM `project` WHERE id = '{$_GET['delt_id']}'");
			$_SESSION['message'] = "成功刪除專案";
			go("project/project.php");
		break;
		case 'new_score':
			other("INSERT INTO `scroe` VALUES('','{$_GET['edit_id']}','{$_POST['score']}')");
			other("UPDATE `project` SET `avgok` = 'false' WHERE id = '{$_GET['edit_id']}'");
			go("top/score.php?edit_id={$_GET['edit_id']}");
		break;
		case 'edit_score':
			other("UPDATE `scroe` SET `score` = '{$_POST['score']}' WHERE id = '{$_GET['editid']}'");
			go("top/score.php?edit_id={$_GET['edit_id']}");
		break;
		case 'delt_score':
			other("DELETE FROM `scroe` WHERE id = '{$_GET['deltid']}'");
			go("top/score.php?edit_id={$_GET['edit_id']}");
		break;
		case 'new_plan':
			other("INSERT INTO `plan` VALUES('','{$_GET['edit_id']}','{$_POST['plannum']}','{$_POST['planname']}','{$_POST['description']}','')");
			if(isset($_POST['option'])){
				$plan = once("SELECT * FROM `plan` ORDER BY id DESC LIMIT 1")['id'];
				foreach($_POST['option'] as $k => $op){
					other("INSERT INTO `planoption` VALUES('','{$plan}','{$op}')");
				}
			}
			go("top/plan.php?edit_id={$_GET['edit_id']}");
		break;
		case 'edit_plan':
			other("UPDATE `plan` SET `plannum` = '{$_POST['plannum']}', `planname` = '{$_POST['planname']}', `description` = '{$_POST['description']}' WHERE id='{$_GET['editid']}' ");
			if(isset($_POST['option'])){
				other("DELETE FROM `planoption` WHERE planid = '{$_GET['editid']}'");
				foreach($_POST['option'] as $k => $op){
					other("INSERT INTO `planoption` VALUES('','{$_GET['editid']}','{$op}')");
				}
			}
			go("top/plan.php?edit_id={$_GET['edit_id']}");
		break;
		case 'delt_plan':
			other("DELETE FROM `plan` WHERE id = '{$_GET['deltid']}'");
			go("top/plan.php?edit_id={$_GET['edit_id']}");
		break;
		case 'pro_start':
			other("UPDATE `project` SET `prook` = 'true' WHERE id = '{$_SESSION['proid']}'");
			$_SESSION['message'] = "開始意見";
		break;
		case 'pro_stop':
			other("UPDATE `project` SET `prook` = 'false' WHERE id = '{$_SESSION['proid']}'");
			$_SESSION['message'] = "停止意見";
		break;
		case 'new_opinino':
			if(isset($_FILES['file'])){
				$file = "img/".$_FILES['file']['name'];
				$filetype = explode('/',$_FILES['file']['type'])[0];
				move_uploaded_file($_FILES['file']['tmp_name'],$file);
			}
			$data = date('Y-m-d');
			if(isset($_FILES['file'])){
				other("INSERT INTO `opinino` VALUES('','{$_SESSION['proid']}','{$_SESSION['faceid']}','{$_SESSION['id']}','{$data}','{$_POST['title']}','{$_POST['description']}','{$_SESSION['name']}','{$file}','{$filetype}')");
			}else{
				other("INSERT INTO `opinino` VALUES('','{$_SESSION['proid']}','{$_SESSION['faceid']}','{$_SESSION['id']}','{$data}','{$_POST['title']}','{$_POST['description']}','{$_SESSION['name']}','','')");
			}
			if(isset($_POST['ext'])){
				$op = once("SELECT * FROM `opinino` ORDER BY id DESC LIMIT 1")['id'];
				foreach($_POST['ext'] as $k => $title){
					other("INSERT INTO `ext` VALUES('','{$op}','{$k}','{$title}')");
				}
			}
			go("discuss/opinino.php");
		break;
		case 'op_start':
			other("INSERT INTO `opstart` VALUES('','{$_GET['opid']}','{$_SESSION['id']}','{$_POST['start']}')");
			go("discuss/opinino2.php?opid={$_GET['opid']}");
		break;
		case 'plan_start':
			other("UPDATE `project` SET `plan` = 'true' WHERE id = '{$_SESSION['proid']}'");
		break;
		case 'plan_stop':
			other("UPDATE `project` SET `plan` = 'false' WHERE id = '{$_SESSION['proid']}'");
		break;
		case 'avgok':
			other("UPDATE `project` SET `avgok` = 'true' WHERE id = '{$_SESSION['proid']}'");
		break;
		case 'planstart':
			if(isset($_POST['score'])){
				foreach($_POST['score'] as $k => $value){
					other("INSERT INTO `planstart` VALUES('','{$_SESSION['proid']}','{$_GET['planid']}','{$k}','{$_SESSION['id']}','{$value}')");
				}
			}
			go("discuss/plan.php");
		break;
		case 'three':
			$user = all("SELECT name,COUNT(*) FROM `opinino` WHERE userid != 1 GROUP BY userid  ORDER BY COUNT(*) DESC LIMIT 3");
			echo json_encode($user);
		break;
		case 'topthree':
			$user = all("SELECT name,userid,COUNT(*) FROM `opinino` WHERE userid != 1 GROUP BY userid  ORDER BY COUNT(*) DESC LIMIT 3");
			$d =[];
			$j=0;
			$a = [];
			foreach($user as $u){
				$a[] = $u['name'];
				for($i=1;$i<6;$i++){
					$y = once("SELECT COUNT(*) FROM `opstart` WHERE start = '{$i}' AND userid = '{$u['userid']}'")['COUNT(*)'];
					$d[$j][] = [
						'name'=>$i,
						'y'=>$y*1
					];
				}
				$j++;
			}
			$d[] = $a;
			echo json_encode($d);
		break;
		case 'selectpro':
			$op = all("SELECT * FROM `project`");
			$d = [];
			foreach($op as $p){
				$o = once("SELECT COUNT(*) FROM `opinino` WHERE proid = '{$p['id']}'");
				$d[] = [
					$p['projectname'],
					$o['COUNT(*)']*1
				];
			}
			echo json_encode($d);
		break;
		case 'selectface':
			$pn = once("SELECT * FROM `project`  WHERE id = '{$_GET['proid']}'");
			$p = once("SELECT COUNT(*) FROM `opinino` WHERE proid = '{$_GET['proid']}'");
			$face = all("SELECT * FROM `face` WHERE proid = '{$_GET['proid']}'");
			foreach($face as $f){
				$fs = once("SELECT * FROM `face`  WHERE id = '{$f['id']}'");
				$o = once("SELECT COUNT(*) FROM `opinino` WHERE faceid = '{$f['id']}'");
				$d[0][] = [
					'name'=>$fs['face'],
					'y'=>$o['COUNT(*)']*1,
					'color'=>color()
				];
			}
			$d[1][] = [
					'name'=>$pn['projectname'],
					'y'=>$p['COUNT(*)']*1,
					'color'=>color()
				];
				echo json_encode($d);
		break;
	}
?>