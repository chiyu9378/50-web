<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
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
			<hr>
			<div class="fccc">
				
					<?php
						if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
						$pro = all("SELECT * FROM `project`");
						foreach($pro as $p){
					?>
					<div class="well f fc span8">
						<p>專案名稱：<?=$p['projectname']?></p>
						<p>專案說明：<?=$p['description']?></p>
						<p>
						<span class="btn-group pull-right">
							<a href="face.php?proid=<?=$p['id']?>&type=top" class="btn">專案面向</a>
							<a href="plan.php?proid=<?=$p['id']?>&type=top" class="btn">執行方案</a>
						</span>
						</p>
					</div>
					<?php
						}
						}else{
							$pro = all("SELECT * FROM `member` WHERE userid = '{$_SESSION['id']}'");
							foreach($pro as $m){
								$p = once("SELECT * FROM `project` WHERE id = '{$m['proid']}'");
					?>
					<div class="well fccc span8">
						<p>專案名稱：<?=$p['projectname']?></p>
						<p>專案說明：<?=$p['description']?></p>
						<p>
						<span class="btn-group  pull-right">
							<a href="face.php?proid=<?=$p['id']?>&type=<?=$m['type']?>" class="btn">專案面向</a>
							<a href="plan.php?proid=<?=$p['id']?>&type=<?=$m['type']?>" class="btn">執行方案</a>
						</span>
						</p>
					</div>
					<?php
							}
						}
					?>
				
			</div>
		</div>
	</body>
	
</html>