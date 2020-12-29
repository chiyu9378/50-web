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
		<title>專案討論-組長功能管理</title>
	</head>
	
	<body>
		<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-組長功能管理</h3></label>
			<hr>
			<div class="hero-unit fccc">
				<table class="table">
					<tr>
						<th>專案名稱</th>
						<th>動作</th>
					</tr>
					<?php
						if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){
						$pro = all("SELECT * FROM `project`");
						foreach($pro as $p){
					?>
							<tr>
								<td><?=$p['projectname']?></td>
								<td>
									<div class="btn-group">
										<a href="plan.php?edit_id=<?=$p['id']?>" class="btn">執行方案</a>
										<a href="score.php?edit_id=<?=$p['id']?>" class="btn">評分指標</a>
									</div>
								</td>
							</tr>
					<?php
						}
						}else{
							$pro = all("SELECT * FROM `member` WHERE type='top' AND userid = '{$_SESSION['id']}'");
							foreach($pro as $m){
								$p = once("SELECT * FROM `project` WHERE id = '{$m['proid']}'");
					?>
								<tr>
									<td><?=$p['projectname']?></td>
									<td>
										<div class="btn-group">
											<a href="plan.php?edit_id=<?=$p['id']?>" class="btn">執行方案</a>
											<a href="score.php?edit_id=<?=$p['id']?>" class="btn">評分指標</a>
										</div>
									</td>
								</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
		</div>
	</body>
	
</html>