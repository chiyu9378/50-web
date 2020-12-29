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
			<label><h3>新增意見</h3></label>
			<div class="btn-group">
				<a href="opinino.php" class="btn">返回</a>
			</div>
			<hr>
			<div class="hero-unit fccc">
			
				<form action="../api.php?id=new_opinino" method="POST" class="fccc" enctype="multipart/form-data">
					<?php
						$num = once("SELECT COUNT(*) FROM `opinino` WHERE faceid = '{$_SESSION['faceid']}'")['COUNT(*)'];
					?>
					<p class="fccc">
					<span>編號：<?=sprintf('%03d',$num+1)?></span>
					<br>
					<span>發表的時間：<?=date('Y-m-d')?></span>
					<br>
					<span>發表者的使用者名稱：<?=$_SESSION['name']?></span>
					<br>
					<span>標題：<input type="text" name="title" id="title" required></span>
					<br>
					<span>說明：<input type="text" name="description" id="description" required></span>
					
					<input type="file" name="file">
					</p>
					<hr>
					<div class="span5">
					可選擇延伸意見：
					<br>
					<?php
						$face = all("SELECT * FROM `opinino` WHERE faceid = '{$_SESSION['faceid']}'");
						foreach($face as $f){
					?>
						<input type="checkbox" value="<?=$f['title']?>" name="ext[<?=$f['id']?>]"><?=$f['title']?>&emsp;
					<?php
						}
					?>
					</div>
					<div class="btn-group">
						<input type="button" class="btn btn-success" value="新增" id="s" onclick="sub()">
					</div>
				</form>
			</div>
		</div>
		<script>
		function sub(){
			let j = 0;
			if($("#title").val().replace(/\s/g,'') == '' || $("#description").val().replace(/\s/g,'') == '' ){
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