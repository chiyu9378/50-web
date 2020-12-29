<?php include("../sql.php");?>
<?php
	if(isset($_SESSION['type'])){
		if($_SESSION['type'] != "admin"){
			$_SESSION['message'] = "無權限";
			go("discuss/discuss.php");
		}
	}else{
		$_SESSION['message'] = "請登入";
		go("../index.php");
	}
?>
<html>
	
	<head>
		<?php include("../head.php");?>
		<title>專案討論-使用者管理</title>
	</head>
	
	<body>
	<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h4>新增使用者</h4></label>
			<div class="btn-group">
				<a href="admin.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
			
				<form action="../api.php?id=new_user" method="POST" class="fccc">
					<label>帳號</label>
					<input type="text" name="user" required>
					<label>名稱</label>
					<input type="text" name="name" required>
					<label>密碼</label>
					<input type="text" name="pass" required>
					<div class="btn-group">
						<input type="submit" class="btn btn-success" value="新增">
					</div>
				</form>
			</div>
		</div>
	</body>
	
</html>