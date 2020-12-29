<?php include("sql.php");?>
<html>
	
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/highcharts/code/highcharts.js"></script>
		<title>專案討論-首頁</title>
	</head>
	
	<body>
		<div class="warp fccc">
			<div class="hero-unit fccc">
			<label><h4>專案討論-登入</h4></label>
				<form action="api.php?id=login" method="POST" class="fccc">
					<label>帳號</label>
					<input type="text" name="user" required>
					<label>密碼</label>
					<input type="password" name="pass" required>
					<div class="btn-group">
						<input type="submit" class="btn btn-success" value="登入">
					</div>
				</form>
			</div>
		</div>
	</body>
	
</html>