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
			<label><h3>專案討論-使用者管理</h3></label>
			<div class="btn-group">
				<a href="new-user.php" class="btn btn-primary">新增</a>
				<button class="btn" onclick="num()">排序</button>
			</div>
			<hr>
			<div class="hero-unit fccc">
				<table class="table">
				</table>
			</div>
		</div>
		
		<script>
			var n = "ASC";
			function num(){
				$.get("../api.php",{id:'admin',num:n},function(d){
					$("table").html('<tr><th>使用者帳號</th><th>使用者名稱</th><th>動作</th></tr>');
					d.forEach(function(a){
						if(a.type == "admin"){
							$("table").append("<tr><td>"+a.user+"</td><td>"+a.name+"</td><td></td></tr>");
						}else{
							$("table").append("<tr><td>"+a.user+"</td><td>"+a.name+"</td><td><div class='btn-group'><a href='edit-user.php?edit_id="+a.id+"' class='btn '>修改</a><a href='../api.php?id=delt_user&delt_id="+a.id+"' class='btn btn-danger'>刪除</a></div></td></tr>");

						}
					});
				},"JSON");
				if(n == "ASC"){
					n = "DESC";
				}else{
					n = "ASC";
				}
			}
			num();
		</script>
	</body>
	
</html>