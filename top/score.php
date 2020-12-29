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
				<a href="#newmodal" data-target="#newmodal" data-toggle="modal" class="btn btn-primary">新增</a>
				<a href="top.php"  class="btn">返回</a>
			</div>
			<form action="../api.php?id=new_score&edit_id=<?=$_GET['edit_id']?>" method="POST">
				<div class="modal fade hide" id="newmodal">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h3>新增評分指標</h3>
					</div>
					<div class="modal-body">
						<label>評分指標</label>
						<input type="text" name="score" required>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="新增">
					</div>
				</div>
			</form>
			<hr>
			<div class="hero-unit fccc">
				<table class="table">
					<tr>
						<th>評分指標名稱</th>
						<th>動作</th>
					</tr>
					<?php
						$pro = all("SELECT * FROM `scroe` WHERE proid = '{$_GET['edit_id']}'");
						foreach($pro as $p){
					?>
							<tr>
								<td><?=$p['score']?></td>
								<td>
									<div class="btn-group">
										<a href="#modal<?=$p['id']?>" class="btn" data-target="#modal<?=$p['id']?>" data-toggle="modal">修改</a>
										
										<div class="modal fade hide" id="modal<?=$p['id']?>">
											<form action="../api.php?id=edit_score&editid=<?=$p['id']?>&edit_id=<?=$_GET['edit_id']?>" method="POST">
											<div class="modal-header">
												<button class="close" data-dismiss="modal">&times;</button>
												<h3>修改評分指標</h3>
											</div>
											<div class="modal-body">
												<label>評分指標</label>
												<input type="text" name="score" value="<?=$p['score']?>" required>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" value="修改">
											</div>
											</form>
										</div>
									
										<a href="../api.php?id=delt_score&deltid=<?=$p['id']?>e&edit_id=<?=$_GET['edit_id']?>" class="btn  btn-danger">刪除</a>
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