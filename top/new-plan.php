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
		<title>專案討論-組長功能管理</title>
	</head>
	
	<body>
	<?php include("../navbar.php");?>
		<div class="warp fccc">
			<label><h3>新增執行方案</h3></label>
			<div class="btn-group">
				<a href="plan.php?edit_id=<?=$_GET['edit_id']?>" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
			
				<form action="../api.php?id=new_plan&edit_id=<?=$_GET['edit_id']?>" method="POST" class="fccc">
					<p class="fccc">
					執行方案編號：<input type="text" name="plannum" id="plannum" required>
					
					執行方案名稱：<input type="text" name="planname" id="planname" required>
					
					執行方案說明：<input type="text" name="description" id="description" required>
					
					</p>
					<hr>
					<?php
						$face = all("SELECT * FROM `face` WHERE proid = '{$_GET['edit_id']}'");
						foreach($face as $f){
					?>
						<select name="option[]">
							<?php
								$op = all("SELECT `opinino`.`id`,`opinino`.`title`,SUM(`opstart`.`start`) FROM `opinino` JOIN `opstart` ON `opinino`.`id` = `opstart`.`opininoid` WHERE faceid = '{$f['id']}' GROUP BY `opinino`.`id` ORDER BY SUM(`opstart`.`start`) DESC ");
								foreach($op as $o){
									
							?>
							<option value="<?=$o['id']?>"><?=$o['title']?>：<?=$o['SUM(`opstart`.`start`)']?>分</option>
							<?php
								}
							?>
						</select>
					<?php
						}
					?>
					<div class="btn-group">
						<input type="button" class="btn btn-success" value="新增" id="s" onclick="sub()">
					</div>
				</form>
			</div>
		</div>
		<script>
		function sub(){
			let j = 0;
			if($("#plannum").val().replace(/\s/g,'') == '' || $("#planname").val().replace(/\s/g,'') == '' || $("#description").val().replace(/\s/g,'') == '' ){
				j++;
			}
			if(j != 0){
				alert("有資料未填寫");
			}else{
				$("#s").attr("type","submit");
				$("#s").removeAttr("onclick");
				$("#s").click();
			}
		}
		</script>
	</body>
	
</html>