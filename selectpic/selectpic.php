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
		<title>專案討論-統計管理</title>
	</head>
	
	<body>
		<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>專案討論-統計管理</h3></label>
			<hr>
			<div class="fccc">
				<a href="topthree.php" class="btn btn-large">使用者發表意見統計</a>
				<br>
				<a href="selectpro.php" class="btn btn-large">各專案意見發表總數量統計</a>
				<br>
				<a href="selectface.php" class="btn btn-large">各專案意見之各面向統計</a>
			</div>
		</div>
	</body>
	
</html>