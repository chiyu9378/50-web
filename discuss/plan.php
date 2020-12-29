<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
	(isset($_GET['proid']))? ($_SESSION['proid'] = $_GET['proid']):'';
	(isset($_GET['type']))? ($_SESSION['member'] = $_GET['type']):'';
?>
<html>
	
	<head>
		<?php include("../head.php");?>
		<title>專案討論-專案討論</title>
	</head>
	
	<body>
		<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-專案討論</h3></label>
			<div class="btn-group">
			<?php
				$avg = project();
				$ps = once("SELECT * FROM `project` WHERE id = '{$_SESSION['proid']}'");
				if($_SESSION['member'] == "top" && $ps['plan'] == "false" && $ps['avgok'] == "false" && $avg == "false"){
			?>
				<button class="btn btn-primary" onclick="planstart()">開始評分</button>
			<?php
				}elseif($_SESSION['member'] == "top" && $ps['plan'] == "true" && $ps['avgok'] == "false" && $avg == "false"){
			?>
				<button class="btn btn-danger" onclick="planstop()">停止評分</button>
			<?php
				}elseif($_SESSION['member'] == "top" && $ps['plan'] == "false" && $ps['avgok'] == "false" && $avg == "true"){
			?>
				<button class="btn btn-primary" onclick="avgok()">檢視評分</button>
			<?php
				}
			?>
				<a href="discuss.php" class="btn ">返回</a>
			</div>
			<hr>
			<div class="fccc">
				
					<?php
						if($ps['avgok'] == "false"){
						$pro = all("SELECT * FROM `plan` WHERE proid = '{$_SESSION['proid']}'");
						}elseif($ps['avgok'] == "true"){
						$pro = all("SELECT `plan`.`id`,plannum,planname,description FROM `plan` JOIN `planstart` ON `plan`.`id` = `planstart`.`planid`  WHERE `plan`.`proid` = '{$_SESSION['proid']}' GROUP BY `plan`.`id` ORDER BY  AVG(`planstart`.`start`) DESC ");
						}
						foreach($pro as $p){
					?>
					<div class="well f fc span8">
						<p>執行方案編號：<?=$p['plannum']?></p>
						<p>執行方案名稱：<?=$p['planname']?></p>
						<p>執行方案說明：<?=$p['description']?></p>
						<?php
							if($ps['avgok'] == "true"){
								$start = once("SELECT AVG(start) FROM `planstart` WHERE planid = '{$p['id']}'")['AVG(start)'];
						?>
							<p>平均分數：<?=ceil($start)?></p>
						<?php
							}
						?>
						<p>
						<span class="btn-group pull-right">
							<a href="opinino3.php?planid=<?=$p['id']?>" class="btn">執行方案意見</a>
							<?php
								$score = once("SELECT COUNT(*) FROM `scroe` WHERE proid = '{$_SESSION['proid']}'")['COUNT(*)'];
								$s = once("SELECT COUNT(*) FROM `planstart` WHERE userid = '{$_SESSION['id']}' AND planid = '{$p['id']}'")['COUNT(*)'];
								if($score == 0){
							?>
								<a class="btn btn-danger" disabled>無評分指標</a>
							<?php
								}elseif($score == $s){
							?>
								<a class="btn btn-success" disabled>已評分</a>
							<?php
								}elseif($ps['plan'] == "false"){
							?>
								<a class="btn btn-danger" disabled>評分停止</a>
							<?php
								}else{
							?>
								<a href="planstart.php?planid=<?=$p['id']?>" class="btn btn-warning">評分</a>
							<?php
								}
							?>
						</span>
						</p>
					</div>
					<?php
						}
					?>
			</div>
		</div>
		<script>
		function planstart(){
			$.get("../api.php",{id:'plan_start'},function(){
				location.reload();
			});
		}
		function planstop(){
			$.get("../api.php",{id:'plan_stop'},function(){
				location.reload();
			});
		}
		function avgok(){
			$.get("../api.php",{id:'avgok'},function(){
				location.reload();
			});
		}
		</script>
	</body>
	
</html>