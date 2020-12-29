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
			<div class="btn-group">
				<a href="tryfath.php?edit_id=<?=$_GET['edit_id']?>" class="btn btn-primary">執行方案自動產生</a>
				<a href="new-plan.php?edit_id=<?=$_GET['edit_id']?>" class="btn btn-primary">新增</a>
				<a href="top.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
				<table class="table">
					<tr>
						<th>執行方案名稱</th>
						<th>動作</th>
					</tr>
					<?php
						$pro = all("SELECT * FROM `plan` WHERE proid = '{$_GET['edit_id']}'");
						foreach($pro as $p){
					?>
							<tr>
								<td><?=$p['planname']?></td>
								<td>
									<div class="btn-group">
										<a href="edit-plan.php?editid=<?=$p['id']?>&edit_id=<?=$_GET['edit_id']?>" class="btn">修改</a>
										<a href="../api.php?id=delt_plan&deltid=<?=$p['id']?>&edit_id=<?=$_GET['edit_id']?>" class="btn  btn-danger">刪除</a>
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