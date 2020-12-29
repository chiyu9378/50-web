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
			<label><h3>專案討論-專案管理</h3></label>
			<div class="btn-group">
				<a href="new-pro.php" class="btn btn-primary">新增</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
				<table class="table">
					<tr>
						<th>專案名稱</th>
						<th>動作</th>
					</tr>
					<?php
						$pro = all("SELECT * FROM `project`");
						foreach($pro as $p){
					?>
						<tr>
							<td><?=$p['projectname']?></td>
							<td>
								<div class="btn-group">
									<a href="edit-pro.php?edit_id=<?=$p['id']?>" class="btn">修改</a>
									<a href="edit-member.php?edit_id=<?=$p['id']?>" class="btn">指定成員</a>
									<a href="../api.php?id=delt_pro&delt_id=<?=$p['id']?>" class="btn btn-danger">刪除</a>
								</div>
							</td>
						</tr>
					<?php
						}
					?>
				</table>
			</div>
		</div>
	</body>
	
</html>