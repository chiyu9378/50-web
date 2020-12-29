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
			<label><h4>修改使用者</h4></label>
			<div class="btn-group">
				<a href="admin.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
			
			<?php
				$u = once("SELECT * FROM `users` WHERE id = '{$_GET['edit_id']}'");
			?>
				<form action="../api.php?id=edit_user&edit_id=<?=$_GET['edit_id']?>" method="POST" class="fccc">
					<label>帳號</label>
					<input type="text" name="user" value="<?=$u['user']?>" readonly>
					<label>名稱</label>
					<input type="text" name="name" value="<?=$u['name']?>" required>
					<label>密碼</label>
					<input type="text" name="pass" value="<?=$u['pass']?>" required>
					<div class="btn-group">
						<input type="submit" class="btn btn-success" value="修改">
					</div>
				</form>
			</div>
		</div>
	</body>
	
</html>