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
			<label><h3>評分</h3></label>
			<div class="btn-group">
				<a href="opinino.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
				<?php 
					$p = once("SELECT * FROM `plan` WHERE id = '{$_GET['planid']}'");
				
				?>
				<label>執行方案：<?=$p['planname']?></label>
				<hr>
				<form action="../api.php?id=planstart&planid=<?=$_GET['planid']?>" method="POST" class="fccc">
					<?php
						$s = all("SELECT * FROM `scroe` WHERE proid = '{$_SESSION['proid']}'");
						foreach($s as $ss){
					?>
					<span class="fccc">
					<label>評分指標：<?=$ss['score']?></label>
					<select name="score[<?=$ss['id']?>]">
						<option value="1">1分</option>
						<option value="2">2分</option>
						<option value="3">3分</option>
						<option value="4">4分</option>
						<option value="5">5分</option>
					</select>
					</span>
					<?php
						}
					?>
					<hr>
					<div class="btn-group">
						<input type="submit" value="評分" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
		<script>
		</script>
	</body>
	
</html>