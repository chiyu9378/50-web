<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
	(isset($_GET['planid']))? ($_SESSION['planid'] = $_GET['planid']):'';
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
				<a href="plan.php" class="btn ">返回</a>
			</div>
			<hr>
			<div class="fccc">
				
					<?php
						$pro = all("SELECT * FROM `planoption` WHERE planid = '{$_SESSION['planid']}'");
						foreach($pro as $ps){
							$p = once("SELECT * FROM `opinino` WHERE id = '{$ps['opid']}'");
					?>
					<div class="well f fc span8">
						<p>意見名稱：<?=$p['title']?></p>
						<p>意見說明：<?=$p['description']?></p>
						<p>
						<span class="btn-group pull-right">
							<a href="opinino2.php?opid=<?=$p['id']?>" class="btn">檢視意見</a>
						</span>
						</p>
					</div>
					<?php
						}
					?>
			</div>
		</div>
	</body>
	
</html>